<?php
declare(strict_types=1);

namespace App\Controller;

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
        $students = $this->paginate($this->Students->findBySchoolid($schoolID));

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

        $this->set(compact('student'));
        $this->set(compact('schoolID'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($schoolID = null)
    {
        $student = $this->Students->newEmptyEntity();
        if ($this->request->is('post')) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            $student->schoolId = $schoolID;
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['action' => 'index', $schoolID]);
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            $student->schoolId = $schoolID;
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['action' => 'index', $schoolID]);
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
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
        $this->request->allowMethod(['post', 'delete']);
        $student = $this->Students->get($id);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__('The student has been deleted.'));
        } else {
            $this->Flash->error(__('The student could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $schoolID]);
    }
}
