<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Deadlines Controller
 *
 * @property \App\Model\Table\DeadlinesTable $Deadlines
 * @method \App\Model\Entity\Deadline[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeadlinesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $deadlines = $this->paginate($this->Deadlines);

        $this->set(compact('deadlines'));
    }

    /**
     * View method
     *
     * @param string|null $id Deadline id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $deadline = $this->Deadlines->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('deadline'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deadline = $this->Deadlines->newEmptyEntity();
        if ($this->request->is('post')) {
            $deadline = $this->Deadlines->patchEntity($deadline, $this->request->getData());
            if ($this->Deadlines->save($deadline)) {
                $this->Flash->success(__('The deadline has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deadline could not be saved. Please, try again.'));
        }
        $this->set(compact('deadline'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Deadline id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $deadline = $this->Deadlines->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deadline = $this->Deadlines->patchEntity($deadline, $this->request->getData());
            if ($this->Deadlines->save($deadline)) {
                $this->Flash->success(__('The deadline has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deadline could not be saved. Please, try again.'));
        }
        $this->set(compact('deadline'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Deadline id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deadline = $this->Deadlines->get($id);
        if ($this->Deadlines->delete($deadline)) {
            $this->Flash->success(__('The deadline has been deleted.'));
        } else {
            $this->Flash->error(__('The deadline could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
