<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($editionID = null)
    {
        if($editionID == null) return $this->redirect(['controller' => 'editions', 'action' => 'index']);
        $files = $this->paginate($this->Files->findByEditionid($editionID));

        $this->set(compact('files'));
        $this->set(compact('editionID'));
    }

    /**
     * View method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $editionID = null)
    {
        if($editionID == null) return $this->redirect(['controller' => 'editions', 'action' => 'index']);
        $file = $this->Files->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('file'));
        $this->set(compact('editionID'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($editionID = null)
    {
        if($editionID == null) return $this->redirect(['controller' => 'editions', 'action' => 'index']);
        $file = $this->Files->newEmptyEntity();
        if ($this->request->is('post')) {
            $file = $this->Files->patchEntity($file, $this->request->getData());

            if(!$file->getErrors){
                $attachment = $this->request->getData('path');
    
                $name = $attachment->getClientFilename();
    
                $targetPath = WWW_ROOT.'img'.DS.$name;
    
                if($name) $attachment->moveTo($targetPath);
    
                $file->name = $name;
            }

            $file->editionId = $editionID;

            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index', $editionID]);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $this->set(compact('file'));
        $this->set(compact('editionID'));
    }

    /**
     * Edit method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $editionID = null)
    {
        if($editionID == null) return $this->redirect(['controller' => 'editions', 'action' => 'index']);
        $file = $this->Files->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            
            if(!$file->getErrors){
                $attachment = $this->request->getData('path');
    
                $name = $attachment->getClientFilename();
    
                $targetPath = WWW_ROOT.'img'.DS.$name;
    
                if($name) $attachment->moveTo($targetPath);
    
                $file->name = $name;
            }
           
            $file->editionId = $editionID;

            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index', $editionID]);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $this->set(compact('file'));
        $this->set(compact('editionID'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $editionID = null)
    {
        if($editionID == null) return $this->redirect(['controller' => 'editions', 'action' => 'index']);
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);
        if ($this->Files->delete($file)) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $editionID]);
    }
}
