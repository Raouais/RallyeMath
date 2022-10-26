<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Signature;
use Authorization\Exception\ForbiddenException;

/**
 * Signatures Controller
 *
 * @property \App\Model\Table\SignaturesTable $Signatures
 * @method \App\Model\Entity\Signature[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SignaturesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $signatures = $this->paginate($this->Signatures);

        $this->set(compact('signatures'));
    }

    /**
     * View method
     *
     * @param string|null $id Signature id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $signature = $this->Signatures->get($id, [
            'contain' => [],
        ]);
        if(!$this->authorize($signature)) return $this->redirect(['controller' => 'signatures', 'action' => 'index']);

        $this->set(compact('signature'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $signature = $this->Signatures->newEmptyEntity();
        if(!$this->authorize($signature)) return $this->redirect(['controller' => 'signatures', 'action' => 'index']);
        if ($this->request->is('post')) {
            $signature = $this->Signatures->patchEntity($signature, $this->request->getData());
            if ($this->Signatures->save($signature)) {
                $this->Flash->success(__('The signature has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The signature could not be saved. Please, try again.'));
        }
        $this->set(compact('signature'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Signature id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $signature = $this->Signatures->get($id, [
            'contain' => [],
        ]);
        if(!$this->authorize($signature)) return $this->redirect(['controller' => 'signatures', 'action' => 'index']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $signature = $this->Signatures->patchEntity($signature, $this->request->getData());
            if ($this->Signatures->save($signature)) {
                $this->Flash->success(__('The signature has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The signature could not be saved. Please, try again.'));
        }
        $this->set(compact('signature'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Signature id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $signature = $this->Signatures->get($id);
        if(!$this->authorize($signature)) return $this->redirect(['controller' => 'signatures', 'action' => 'index']);
        if ($this->Signatures->delete($signature)) {
            $this->Flash->success(__('The signature has been deleted.'));
        } else {
            $this->Flash->error(__('The signature could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    private function authorize(Signature $user){
        try{
            $this->Authorization->authorize($user);
            return true;
        } catch(ForbiddenException $e){
            $this->Flash->error("Vous n'avez pas l'autorisation.");
            return false;
        }
    }
}
