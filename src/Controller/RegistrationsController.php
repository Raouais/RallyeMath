<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Registration;
use Authorization\Exception\ForbiddenException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\I18n\FrozenTime;

/**
 * Registrations Controller
 *
 * @property \App\Model\Table\RegistrationsTable $Registrations
 * @method \App\Model\Entity\Registration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistrationsController extends AppController
{



    public function all(){


        $this->Authorization->skipAuthorization();
        $editionsTable = $this->getTableLocator()->get('Editions');
        $editions = $editionsTable->find('all');

        if($this->getUser()->isAdmin){
            $registrations = $this->paginate($this->Registrations);
        } else {
            $registrations = $this->paginate($this->Registrations->findByUserid($this->getUser()->id));
        }        

        $isAdmin = $this->getUser()->isAdmin;
        $this->set(compact('isAdmin'));
        $this->set(compact('editions'));
        $this->set(compact('registrations'));
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($editionID = null)
    {
        $this->Authorization->skipAuthorization();
        $isAdmin = $this->getUser()->isAdmin;

        $editionsTable = $this->getTableLocator()->get('Editions');

        if($editionID == null && $isAdmin){
            $editions = $editionsTable->find('all');
            $this->set(compact('editions'));
        } else if($editionID == null) {
            $this->Flash->error(__("Erreur URL. Veuillez ne pas accéder aux pages depuis l'URL."));
            return $this->redirect(['controller' => 'Editions', 'action' => 'index']);
        }
        
        if($this->getUser()->isAdmin){
            $registrations = $this->paginate($this->Registrations);
        } else {
            $registrations = $this->paginate($this->Registrations->findByEditionid($editionID));
            $editionName = $editionsTable->findById($editionID)->firstOrFail()->title;
        }

        $this->set(compact('isAdmin'));
        $this->set(compact('registrations'));
        $this->set(compact('editionID'));
        $this->set(compact('editionName'));
    }

    /**
     * View method
     *
     * @param string|null $id Registration id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $registration = $this->Registrations->get($id, [
            'contain' => [],
        ]);
        $this->authorize($registration);

        $edition = $this->getTableLocator()->get('Editions');
        $editionName = $edition->findById($registration->editionId)->firstOrFail()->title;

        $students = $this->getTableLocator()->get('Students');
        $students = $this->paginate($students->find()->
                        select(['lastname','firstname','id'])->
                        where(['Students.schoolId' => $registration->schoolId, 'Students.registrationId' => $registration->id]));

        $school = ($this->getTableLocator()->get('Schools'))->findById($registration->schoolId)->firstOrFail();
        $this->set(compact('editionID'));
        $this->set(compact('students'));
        $this->set(compact('school'));
        $this->set(compact('editionName'));
        $this->set(compact('registration'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($editionID = null)
    {
        $registration = $this->Registrations->newEmptyEntity();
        $this->authorize($registration);

        if($this->getUser()->isAdmin) return $this->redirect(['action' => 'all']);

        $editionsTable = $this->getTableLocator()->get('Editions');

        if($editionID == null) {
            $this->Flash->error(__("Erreur URL. Veuillez ne pas accèder aux pages depuis l'URL."));
            return $this->redirect(['controller' => 'Editions', 'action' => 'index']);
        }
        
        $this->editionDealinesAuthorize($editionID);

        $edition = $this->getTableLocator()->get('Editions');
        $editionName = $edition->findById($editionID)->firstOrFail()->title;

        try{
            $school = $this->getSchool();
        } catch(RecordNotFoundException $e){
            if(!$this->getUser()->isAdmin){
                $this->Flash->error(__("Vous devez créer une école avant de s'inscrire à une édition."));
                return $this->redirect(['controller' => 'Schools', 'action' => 'index']);
            }
        }

        $students = $this->getTableLocator()->get('Students');
        $students = $students->find()->
                        select(['lastname','firstname','id'])->
                        where(['Students.schoolId' => $school->id, 'Students.registrationId is ' => null]);

        if(sizeof($this->paginate($students)) == 0){
            $this->Flash->error(__("Aucun élève disponible pour une inscription."));
            return $this->redirect(['action' => 'index', $editionID]);
        }

        if ($this->request->is('post')) {

            $registration = $this->Registrations->patchEntity($registration, $this->request->getData());
            
            $registration->userId = $this->getUser()->id;
            $registration->schoolId = $school->id;
            $registration->editionId = $editionID;

            if ($this->isEditionConditionOk($this->request->getData('students'),$editionID) && $this->Registrations->save($registration)) {
                $this->updateStudent($this->request->getData('students'),$registration);
                $this->Flash->success(__("L'inscription a été ajoutée avec succès."));
                return $this->redirect(['action' => 'index', $editionID]);
            }
            $this->Flash->error(__("L'inscription n'a pas pu être ajoutée."));
        }
        $this->set(compact('editionID'));
        $this->set(compact('students'));
        $this->set(compact('editionName'));
        $this->set(compact('registration'));
    }

    private function editionDealinesAuthorize($editionID){
        $dealinesTable = $this->getTableLocator()->get('Deadlines');
        $deadlines = $this->paginate($dealinesTable->findByEditionid($editionID));
        $time = FrozenTime::now();

        $limitDeadline = null;
        $firstDeadline = null;

        foreach($deadlines as $d){
            if($d->isLimit){
                $limitDeadline = $d;
            }
        }

        foreach($deadlines as $d){
            $pivot = $d;
            foreach($deadlines as $e){
                if($d < $e && $d < $pivot){
                    $firstDeadline = $d;
                }
            }
        }

        if($firstDeadline != null && $firstDeadline > $time){
            $this->Flash->success(__("L'édition commence seulement le ". $firstDeadline));
            return $this->redirect(['action' => 'index', $editionID]);
        } elseif($limitDeadline != null && $limitDeadline < $time) {
            $this->Flash->success(__("L'édition s'est terminée le ". $limitDeadline));
            return $this->redirect(['action' => 'index', $editionID]);
        } elseif(sizeof($deadlines) == 0){
            $this->Flash->success(__("L'édition n'a pas encore de date "));
            return $this->redirect(['action' => 'index', $editionID]);
        }

    }
    /**
     * Edit method
     *
     * @param string|null $id Registration id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $editionID = null)
    {
        $edition = $this->getTableLocator()->get('Editions');
        $editionName = $edition->findById($editionID)->firstOrFail()->title;
        $registration = $this->Registrations->get($id, [
            'contain' => [],
        ]);
        $schools = $this->getTableLocator()->get('Schools');
        $school = $schools->findById($registration->schoolId)->firstOrFail();

        $students = $this->getTableLocator()->get('Students');
        $students = $students->findBySchoolid($registration->schoolId);

        $this->authorize($registration);

        $isAdmin = $this->getUser()->isAdmin;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $registration = $this->Registrations->patchEntity($registration, $this->request->getData());
            if(!$isAdmin){
                $registration->userId = $this->getUser()->id;
            }
            if($this->isEditionConditionOk($this->request->getData('students'),$editionID) && $this->Registrations->save($registration)) {
                if(!$isAdmin){
                    $this->updateStudent($this->request->getData('students'),$registration);
                }
                $this->Flash->success(__("L'inscription a été modifiée avec succès."));

                if($isAdmin){
                    return $this->redirect(['action' => 'all']);
                } else {
                    return $this->redirect(['action' => 'index', $editionID]);
                }
            }
            $this->Flash->error(__("L'inscription n'a pas pu être modifiée."));
        }
        
        $this->set(compact('editionID'));
        $this->set(compact('isAdmin'));
        $this->set(compact('students'));
        $this->set(compact('editionName'));
        $this->set(compact('registration'));
    }

    private function isEditionConditionOk($studentsIdSelected, $editionID){
        if($this->getUser()->isAdmin) return true;
        $table = $this->getTableLocator()->get('Editions');
        $edition = $table->findById($editionID)->firstOrFail();
        if(!empty($studentsIdSelected)){
            if(sizeof($studentsIdSelected) >= $edition->nbStudentMin && sizeof($studentsIdSelected) <= $edition->nbStudentMax){
                return true;
            } else {
                $this->Flash->error(__("L'édition ".$edition->title." requiert au minimum ". $edition->nbStudentMin." participants."));
                return false;
            }
        } 
        $this->Flash->error(__("Vous devez choisir au minimum ". $edition->nbStudentMin. " élèves."));
        return false;
        
    }

    private function updateStudent($studentsIdSelected, $registration){

        $table = $this->getTableLocator()->get('Students');
        $myStudents = $this->paginate($table->findBySchoolid($registration->schoolId));

        $IsSelected = false; 
        foreach($myStudents as $student){
            foreach($studentsIdSelected as $studentId){
                if($student->id == $studentId){
                    $IsSelected = true;
                }
            }

            if($IsSelected){
                $table->updateAll(['registrationId' => $registration->id], ['id' => $student->id]);
            } else {
                if($student->registrationId == $registration->is_dir){
                    $table->updateAll(['registrationId' => null], ['id' => $student->id]);
                }
            }
            $IsSelected = false;
        }

    }
    /**
     * Delete method
     *
     * @param string|null $id Registration id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $editionID = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registration = $this->Registrations->get($id);
        $this->authorize($registration);
        if ($this->Registrations->delete($registration)) {
            $this->Flash->success(__('The registration has been deleted.'));
        } else {
            $this->Flash->error(__('The registration could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $editionID]);
    }

    private function authorize(Registration $r){
        try{
            $this->Authorization->authorize($r);                
        } catch(ForbiddenException $e){
            $this->Flash->error("Vous n'avez pas l'autorisation.");
            return $this->redirect(['controller' => 'Registrations', 'action' => 'all']);
        } 
    }

    private function getSchool(){
        return (($this->getTableLocator()->get('Schools'))->findByUserid($this->getUser()->id))->firstOrFail();
    }

    private function getUser(){
        return $this->Authentication->getResult()->getData();
    }
}
