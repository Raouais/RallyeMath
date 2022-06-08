<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Edition;
use Authorization\Exception\ForbiddenException;

/**
 * Editions Controller
 *
 * @property \App\Model\Table\EditionsTable $Editions
 * @method \App\Model\Entity\Edition[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EditionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $editions = $this->paginate($this->Editions);
        $isAdmin = $this->Authentication->getResult()->getData()->isAdmin == 1;
        // $this->Authorization->authorize($editions,'index');
        $this->set(compact('editions'));
        $this->set(compact('isAdmin'));
    }

    /**
     * View method
     *
     * @param string|null $id Edition id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $edition = $this->Editions->get($id, [
            'contain' => [],
        ]);

        $this->authorire($edition);

        $deadline = $this->getTableLocator()->get('Deadlines');
        $deadlines = $deadline->find()->
                select(['title','startdate','enddate'])->
                where(['deadlines.editionId'=> $id]);
        $deadlines = $this->paginate($deadlines, ['limit' => '1']);

        $image = $this->getTableLocator()->get('Files');
        $images = $image->find()->
                select(['name'])->
                where(['files.editionId'=> $id]);
        $images = $this->paginate($images, ['limit' => '1']);

        $this->set(compact('edition'));
        $this->set(compact('deadlines'));
        $this->set(compact('images'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $edition = $this->Editions->newEmptyEntity();

        $this->authorire($edition);
        if ($this->request->is('post')) {
            $edition = $this->Editions->patchEntity($edition, $this->request->getData());
            if ($this->Editions->save($edition)) {
                $this->Flash->success(__('The edition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The edition could not be saved. Please, try again.'));
        }
        $this->set(compact('edition'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Edition id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $edition = $this->Editions->get($id, [
            'contain' => [],
        ]);
       
        $this->authorire($edition);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $edition = $this->Editions->patchEntity($edition, $this->request->getData());
            if ($this->Editions->save($edition)) {
                $this->Flash->success(__('The edition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The edition could not be saved. Please, try again.'));
        }
        $this->set(compact('edition'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Edition id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $edition = $this->Editions->get($id);

        $this->authorire($edition);

        if ($this->Editions->delete($edition)) {
            $this->Flash->success(__('The edition has been deleted.'));
        } else {
            $this->Flash->error(__('The edition could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    private function authorire(Edition $edition){
        try{
            $this->Authorization->authorize($edition);
        } catch(ForbiddenException $e){
            $this->Flash->error("Vous n'avez pas l'autorisation.");
            return $this->redirect(['controller' => 'Editions', 'action' => 'index']);
        }
    }

}
