<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Registration;
use Authorization\Exception\ForbiddenException;
use InvalidArgumentException;

/**
 * Registrations Controller
 *
 * @property \App\Model\Table\RegistrationsTable $Registrations
 * @method \App\Model\Entity\Registration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistrationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($editionID = null)
    {
        $this->Authorization->skipAuthorization();
        $edition = $this->getTableLocator()->get('Editions');

        if($this->getUser()->isAdmin){
            $registrations = $this->paginate($this->Registrations->findByEditionid($editionID));
        } else {
            $registrations = $this->paginate($this->Registrations->findByUserid($this->getUser()->id));
        }
        
        $editionName = $edition->findById($editionID)->firstOrFail()->title;
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
    public function view($id = null, $editionID = null)
    {
        $registration = $this->Registrations->get($id, [
            'contain' => [],
        ]);
        $this->authorize($registration);

        $edition = $this->getTableLocator()->get('Editions');
        $editionName = $edition->findById($editionID)->firstOrFail()->title;

        $schools = $this->getTableLocator()->get('Schools');
        $school = $schools->findById($registration->schoolId)->firstOrFail();

        $students = $this->getTableLocator()->get('Students');
        $students = $this->paginate($students->findBySchoolid($registration->schoolId));

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

        $edition = $this->getTableLocator()->get('Editions');
        $editionName = $edition->findById($editionID)->firstOrFail()->title;

        $schools = $this->getTableLocator()->get('Schools');
        $school = $schools->findByUserid($this->getUser()->id)->firstOrFail();

        $students = $this->getTableLocator()->get('Students');
        $students = $students->findBySchoolid($school->id);

        $registration = $this->Registrations->newEmptyEntity();

        $this->authorize($registration);

        if ($this->request->is('post')) {

            $registration = $this->Registrations->patchEntity($registration, $this->request->getData());
            
            $registration->userId = $this->getUser()->id;
            $registration->schoolId = $school->id;
            $registration->editionId = $editionID;

            if ($this->Registrations->save($registration)) {
                $this->updateStudent($this->request->getData('students'),$registration->id);
                $this->Flash->success(__('The registration has been saved.'));
                return $this->redirect(['action' => 'index', $editionID]);
            }
            $this->Flash->error(__('The registration could not be saved. Please, try again.'));
        }
        $this->set(compact('editionID'));
        $this->set(compact('students'));
        $this->set(compact('editionName'));
        $this->set(compact('registration'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registration = $this->Registrations->patchEntity($registration, $this->request->getData());
            $registration->userId = $this->getUser()->id;
            if ($this->Registrations->save($registration)) {
                if(!$this->getUser()->isAdmin && !empty($this->request->getData('students'))){
                    $this->updateStudent($this->request->getData('students'),$registration->id);
                }
                $this->Flash->success(__('The registration has been saved.'));

                return $this->redirect(['action' => 'index', $editionID]);
            }
            $this->Flash->error(__('The registration could not be saved. Please, try again.'));
        }
        
        $isAdmin = $this->getUser()->isAdmin;
        $this->set(compact('isAdmin'));
        $this->set(compact('editionID'));
        $this->set(compact('students'));
        $this->set(compact('editionName'));
        $this->set(compact('registration'));
    }

    private function updateStudent($studentsIdSelected, $registrationId){

        $schools = $this->getTableLocator()->get('Schools');
        $school = $schools->findByUserid($this->getUser()->id)->firstOrFail();

        $table = $this->getTableLocator()->get('Students');
        $students = $table->findBySchoolid($school->id);

        foreach($students as $student){
            foreach($studentsIdSelected as $idStudentSelected){
                if($student->id == $idStudentSelected){
                    $table->updateAll(['registrationId' => $registrationId], ['id' => $student->id]);
                }
            }
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
            return $this->redirect(['controller' => 'Registrations', 'action' => 'index']);
        } 
    }

    private function getUser(){
        return $this->Authentication->getResult()->getData();
    }
}
