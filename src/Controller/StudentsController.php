<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Student;
use Authorization\Exception\ForbiddenException;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($schoolID = null)
    {
        $this->Authorization->skipAuthorization();
        $isAdmin = $this->getUser()->isAdmin;
        
        $table = $this->getTableLocator()->get('Schools');
        $schools = $table->find('all');
        
        if($schoolID == null){
            try{
                $schoolID = $this->getSchool()->id;
                $students = $this->paginate($this->Students->findBySchoolid($schoolID));
            }catch(RecordNotFoundException $e){
                if($isAdmin){
                    $students = $this->paginate($this->Students);
                } else {
                    $this->Flash->error(__("Vous devez créer une école avant de créer des élèves."));
                    return $this->redirect(['controller' => 'pages', 'action' => 'home']);
                }
            }
        }

        $this->set(compact('schools'));
        $this->set(compact('isAdmin'));
        $this->set(compact('students'));
        $this->set(compact('schoolID'));
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $schoolID = null)
    {
        $student = $this->Students->get($id, [
            'contain' => [],
        ]);
        if(!$this->authorize($student)) return $this->redirect(['controller' => 'Schools', 'action' => 'index']);
        
        try{
            $schoolName = $this->getSchool()->name;
        } catch(RecordNotFoundException $e){
            $schoolName = ($this->getTableLocator()->get('Schools'))->findById($student->schoolId)->firstOrFail()->name;
        }

        $schoolID = $student->schoolId;
        $isAdmin = $this->getUser()->isAdmin;
        $this->set(compact('isAdmin'));
        $this->set(compact('schoolName'));
        $this->set(compact('schoolID'));
        $this->set(compact('student'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($schoolID = null)
    {
        $student = $this->Students->newEmptyEntity();
        if(!$this->authorize($student)) return $this->redirect(['controller' => 'Schools', 'action' => 'index']);

        if ($this->request->is('post')) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            $student->schoolId = $schoolID;
            if ($this->Students->save($student)) {
                $this->Flash->success(__("L'étudiant a été ajouté avec succès."));
                return $this->redirect(['action' => 'index', $schoolID]);
            }
            $this->Flash->error(__("L'étudiant n'a pas pu être ajouté. Veuillez réessayer"));
        }
        $this->set(compact('student'));
        $this->set(compact('schoolID'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $schoolID = null)
    {
        $student = $this->Students->get($id, [
            'contain' => [],
        ]);
        if(!$this->authorize($student)) return $this->redirect(['controller' => 'Schools', 'action' => 'index']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            $student->schoolId = $schoolID;
            if ($this->Students->save($student)) {
                $this->Flash->success(__("L'étudiant a été modifié avec succès."));

                return $this->redirect(['action' => 'index', $schoolID]);
            }
            $this->Flash->error(__("L'étudiant n'a pu être modifié. Veuillez réessayer s'il vous plaît."));
        }
        $this->set(compact('student'));
        $this->set(compact('schoolID'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $schoolID = null)
    {
        $student = $this->Students->get($id);
        if(!$this->authorize($student)) return $this->redirect(['controller' => 'Schools', 'action' => 'index']);
        $this->request->allowMethod(['post', 'delete']);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__("L'étudiant à été supprimé."));
        } else {
            $this->Flash->error(__("L'étudiant n'a pu être supprimé. Veuillez réessayer s'il vous plaît."));
        }

        return $this->redirect(['action' => 'index', $schoolID]);
    }

    
    private function getSchool(){
        return (($this->getTableLocator()->get('Schools'))->findByUserid($this->getUser()->id))->firstOrFail();
    }
    
    private function getUser(){
        return $this->Authentication->getResult()->getData();
    }

    private function authorize(Student $student){
        try{
            $this->Authorization->authorize($student);
            return true;
        } catch(ForbiddenException $e){
            $this->Flash->error("Vous n'avez pas l'autorisation.");
            return false;
        }
    }
}
