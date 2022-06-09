<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\School;
use Authorization\Exception\ForbiddenException;

/**
 * Schools Controller
 *
 * @property \App\Model\Table\SchoolsTable $Schools
 * @method \App\Model\Entity\School[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SchoolsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $schools = $this->paginate($this->Schools->findByUserid($this->Authentication->getResult()->getData()->id));
        $this->set(compact('schools'));
    }

    /**
     * View method
     *
     * @param string|null $id School id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $school = $this->Schools->get($id, [
            'contain' => [],
        ]);
        $this->authorize($school);
        $this->set(compact('school'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $school = $this->Schools->newEmptyEntity();
        $this->authorize($school);
        if ($this->request->is('post')) {
            $school = $this->Schools->patchEntity($school, $this->request->getData());
            $school->userId = $this->getUser()->id;
            if ($this->Schools->save($school)) {
                $this->Flash->success(__("L'école a été ajoutée avec succès."));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("L'école n'a pas pu être ajoutée. Veuillez réessayer s'il vous plaît."));
        }
        $this->set(compact('school'));
    }

    /**
     * Edit method
     *
     * @param string|null $id School id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $school = $this->Schools->get($id, [
            'contain' => [],
        ]);
        $this->authorize($school);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $school = $this->Schools->patchEntity($school, $this->request->getData());
            if ($this->Schools->save($school)) {
                $this->Flash->success(__("L'école a été modifiée avec succès."));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("L'école n'a pu être modifiée. Veuillez réessayer s'il vous plaît."));
        }
        $this->set(compact('school'));
    }

    /**
     * Delete method
     *
     * @param string|null $id School id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $school = $this->Schools->get($id);
        $this->authorize($school);
        if ($this->Schools->delete($school)) {
            $this->Flash->success(__("L'école a été supprimée avec succès."));
        } else {
            $this->Flash->error(__("L'école n'a pas pu être supprimée. Veuillez réessayer s'il vous plaît."));
        }

        return $this->redirect(['action' => 'index']);
    }

    private function authorize(School $s){
        try{
            $this->Authorization->authorize($s);
        } catch(ForbiddenException $e){
            $this->Flash->error("Vous n'avez pas l'autorisation.");
            return $this->redirect(['controller' => 'Schools', 'action' => 'index']);
        }
    }
    
    private function getUser(){
        return $this->Authentication->getResult()->getData();
    }
}
