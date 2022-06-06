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
    public function index($editionID)
    {
        $editionID == null ? $this->redirect(['controller' => 'editions', 'action' => 'index']) : false;

        $deadlines = $this->paginate($this->Deadlines->findByEditionid($editionID),  ['limit' => '3']);

        $this->set(compact('deadlines'));
        $this->set(compact('editionID'));
    }

    /**
     * View method
     *
     * @param string|null $id Deadline id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $editionID = null)
    {
        $editionID == null ? $this->redirect(['controller' => 'editions', 'action' => 'index']) : false;

        $deadline = $this->Deadlines->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('deadline'));
        $this->set(compact('editionID'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($editionID = null)
    {
        $editionID == null ? $this->redirect(['controller' => 'editions', 'action' => 'index']) : false;

        $deadline = $this->Deadlines->newEmptyEntity();
        if ($this->request->is('post')) {
            $deadline = $this->Deadlines->patchEntity($deadline, $this->request->getData());
            $deadline->editionId = $editionID;
            if ($this->Deadlines->save($deadline)) {
                $this->Flash->success(__('The deadline has been saved.'));

                return $this->redirect(['action' => 'index', $editionID]);
            }
            $this->Flash->error(__('The deadline could not be saved. Please, try again.'));
        }
        $this->set(compact('deadline'));
        $this->set(compact('editionID'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Deadline id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $editionID = null)
    {
        $editionID == null ? $this->redirect(['controller' => 'editions', 'action' => 'index']) : false;

        $deadline = $this->Deadlines->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deadline = $this->Deadlines->patchEntity($deadline, $this->request->getData());
            $deadline->editionId = $editionID;
            if ($this->Deadlines->save($deadline)) {
                $this->Flash->success(__('The deadline has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deadline could not be saved. Please, try again.'));
        }
        $this->set(compact('deadline'));
        $this->set(compact('editionID'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Deadline id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $editionID = null)
    {
        $editionID == null ? $this->redirect(['controller' => 'editions', 'action' => 'index']) : false;

        $this->request->allowMethod(['post', 'delete']);
        $deadline = $this->Deadlines->get($id);
        if ($this->Deadlines->delete($deadline)) {
            $this->Flash->success(__('The deadline has been deleted.'));
        } else {
            $this->Flash->error(__('The deadline could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $editionID]);
    }

}
