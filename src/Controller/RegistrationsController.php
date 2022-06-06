<?php
declare(strict_types=1);

namespace App\Controller;

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
        $edition = $this->getTableLocator()->get('Editions');
        $editionName = $edition->findById($editionID)->firstOrFail()->title;
        $registrations = $this->paginate($this->Registrations->findByEditionid($editionID));

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

        $edition = $this->getTableLocator()->get('Editions');
        $editionName = $edition->findById($editionID)->firstOrFail()->title;

        $this->set(compact('editionID'));
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
        $registration = $this->Registrations->newEmptyEntity();
        if ($this->request->is('post')) {

            var_dump($this->request->getData('students'));
            var_dump($this->request->getData('schools'));
            $registration = $this->Registrations->patchEntity($registration, $this->request->getData());
            if ($this->Registrations->save($registration)) {
                $this->Flash->success(__('The registration has been saved.'));

                return $this->redirect(['action' => 'index', $editionID]);
            }
            $this->Flash->error(__('The registration could not be saved. Please, try again.'));
        }
        $this->set(compact('editionID'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registration = $this->Registrations->patchEntity($registration, $this->request->getData());
            if ($this->Registrations->save($registration)) {
                $this->Flash->success(__('The registration has been saved.'));

                return $this->redirect(['action' => 'index', $editionID]);
            }
            $this->Flash->error(__('The registration could not be saved. Please, try again.'));
        }
        $this->set(compact('editionID'));
        $this->set(compact('editionName'));
        $this->set(compact('registration'));
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
        if ($this->Registrations->delete($registration)) {
            $this->Flash->success(__('The registration has been deleted.'));
        } else {
            $this->Flash->error(__('The registration could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $editionID]);
    }
}
