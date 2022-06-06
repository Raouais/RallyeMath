<?php
declare(strict_types=1);

namespace App\Controller;

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
        $editions = $this->paginate($this->Editions);

        $this->set(compact('editions'));
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

        $deadline = $this->getTableLocator()->get('Deadlines');
        $deadlines = $deadline->find()->
                select(['title','startdate','enddate'])->
                where(['deadlines.editionId'=> $id]);
        $deadlines = $this->paginate($deadlines, ['limit' => '1']);

        $this->set(compact('edition'));
        $this->set(compact('deadlines'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $edition = $this->Editions->newEmptyEntity();
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
        if ($this->Editions->delete($edition)) {
            $this->Flash->success(__('The edition has been deleted.'));
        } else {
            $this->Flash->error(__('The edition could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
