<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Deadline;
use Authorization\Exception\ForbiddenException;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;

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
    public function index($editionID = null)
    {

        $this->Authorization->skipAuthorization();
        if($editionID == null) return $this->redirect(['controller' => 'editions', 'action' => 'index']);

        $deadlines = $this->paginate($this->Deadlines->findByEditionid($editionID),  ['limit' => '3']);

        $isAdmin = $this->getUser()->isAdmin;
        $this->set(compact('isAdmin'));
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
        if($editionID == null) return $this->redirect(['controller' => 'editions', 'action' => 'index']);

        $deadline = $this->Deadlines->get($id, [
            'contain' => [],
        ]);
        if(!$this->authorire($deadline)) return $this->redirect(['action' => 'index']);

        $isAdmin = $this->getUser()->isAdmin;
        $this->set(compact('isAdmin'));
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
        if($editionID == null) return $this->redirect(['controller' => 'editions', 'action' => 'index']);

        $deadline = $this->Deadlines->newEmptyEntity();
        if(!$this->authorire($deadline)) return $this->redirect(['action' => 'index']);
        if ($this->request->is('post')) {
            $deadline = $this->Deadlines->patchEntity($deadline, $this->request->getData());
            $deadline->editionId = $editionID;
            $startDate = new FrozenTime($this->request->getData('startdate'));
            $endDate = new FrozenTime($this->request->getData('enddate'));
            if($this->isDeadlineValidInsertion($editionID,$startDate,$endDate)){
                if ($this->Deadlines->save($deadline)) {
                    $this->Flash->success(__("L'échéance a été ajoutée avec succès."));
                    return $this->redirect(['action' => 'index', $editionID]);
                }
                $this->Flash->error(__("L'échéance n'a pu être ajoutée. Veuillez réessayer."));
            }
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
        if($editionID == null) return $this->redirect(['controller' => 'editions', 'action' => 'index']);

        $deadline = $this->Deadlines->get($id, [
            'contain' => [],
        ]);
        if(!$this->authorire($deadline)) return $this->redirect(['action' => 'index']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deadline = $this->Deadlines->patchEntity($deadline, $this->request->getData());
            $deadline->editionId = $editionID;
            $startDate = new FrozenTime($this->request->getData('startdate'));
            $endDate = new FrozenTime($this->request->getData('enddate'));
            if($this->isDeadlineValidEditing($editionID,$startDate,$endDate)){
                if ($this->Deadlines->save($deadline)) {
                    $this->Flash->success(__("L'échéance a été modifiée avec succès."));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__("L'échéance n'a pu être modifiée. Veuillez réessayer."));
            }
        }
        $this->set(compact('deadline'));
        $this->set(compact('editionID'));
    }


    private function isCurrentDeadlinesLimited($editionID){
        $deadlines = $this->paginate($this->Deadlines->findByEditionid($editionID));
        $hasLimit = false;
        if(!empty($deadlines)){
            foreach($deadlines as $dl){
                if($dl->isLimit){
                    $hasLimit = true;
                    break;
                }
            }
        }
        if($hasLimit) $this->Flash->error(__("Il y a déjà une dernière échéance limite."));
        return $hasLimit;
    }

    private function date_sort($a,$b){
        return $a < $b;
    }

    /**
     * $dstart > $dend ok -> false
     * 
     * 
     * s'il y a qu'une échéance alors $dstart > $deadline->startdate ok -> true 
     * s'il y a plusieurs échéances - Trier les échéances par ordre croissant 
     *                              - tester ($dstart > $dates[$i] && $dstart < $dates[$i + 1] && $dend < $dates[$i + 1]) ok -> true
     * sinon false
     */
    private function isDeadlineValidEditing($editionID, $dstart, $dend){
        if($dstart > $dend){
            $this->Flash->error(__("La date de départ doit être plus grande que la date de fin."));
            return false;
        }

        if($this->isCurrentDeadlinesLimited($editionID)) return false;  

        $deadlines = $this->paginate($this->Deadlines->findByEditionid($editionID));
        $dates = [];
        $isDateBetween = false;
        if(!empty($deadlines)){
            foreach($deadlines as $dl){
                $dates[] = $dl->startdate;
                $dates[] = $dl->enddate;
            }
            if(sizeof($dates) > 2){
                usort($dates, [DeadlinesController::class, "date_sort"]);
                for($i = 1; $i + 1 < sizeof($dates); $i+=2){
                    if($dstart > $dates[$i] && $dstart < $dates[$i + 1] && $dend < $dates[$i + 1]){
                        $isDateBetween = true;
                        break;
                    }
                }
            } else if($dstart > $dates[1]){
                    return true;
            } else {
                $this->Flash->error(__("L'échéance doit être comprise entre deux échéances ou
                                            \n être plus grandes que les échéanches actuelles."));
                return false;
            }
            if($isDateBetween) return true; 
        }
        return true;
        
    }

    private function isDeadlineValidInsertion($editionID, $dstart, $dend){
        $timeNow = FrozenTime::now();
        if($dstart > $dend){
            $this->Flash->error(__("La date de départ doit être plus grande que la date de fin."));
            return false;
        }
        
        if($dstart < $timeNow){
            $this->Flash->error(__("La date de départ doit être plus grande que la date de maintenant."));
            return false;
        }

        if($this->isCurrentDeadlinesLimited($editionID)) return false;  

        return !$this->isCurrentEditionDeadlineBigger($editionID, $dstart) && !$this->hasActualEdition();
    }

    private function isCurrentEditionDeadlineBigger($editionID, $dstart){
        $hasCurrentEditionDeadlineBigger = false;
        $deadlines = $this->paginate($this->Deadlines->findByEditionid($editionID));
        if(!empty($deadlines)){
            foreach($deadlines as $dl){
                if($dl->startdate > $dstart){
                    $hasCurrentEditionDeadlineBigger = true;
                    break;
                }
            }
        }
        if($hasCurrentEditionDeadlineBigger){
            $this->Flash->error(__("Dans l'édition actuel, il y a une échéance plus grande que celle que vous voulez créer."));
        } else {
            return false;
        }
        return true; 
    }

    private function hasActualEdition(){
        $timeNow = FrozenTime::now();
        $editionsTable = $this->getTableLocator()->get('Editions');
        $editions = $editionsTable->find('all');
        $hasAnotherCurrentEditionDeadline = false;
        foreach($editions as $edition){
            $deadlines = $this->paginate($this->Deadlines->findByEditionid($edition->id));
            if(!empty($deadlines)){
                foreach($deadlines as $dl){
                    if($dl->startdate >= $timeNow || $dl->enddate > $timeNow){
                        $hasAnotherCurrentEditionDeadline = true;
                        break;
                    }
                }
            }
            if($hasAnotherCurrentEditionDeadline){
                $this->Flash->error(__("Vous devez attentre que les échéances de l'édition actuel soit finie pour créer des nouvelles échéances."));
                break;
            }
        }
        return $hasAnotherCurrentEditionDeadline;
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
        if($editionID == null) return $this->redirect(['controller' => 'editions', 'action' => 'index']);

        $this->request->allowMethod(['post', 'delete']);
        $deadline = $this->Deadlines->get($id);
        if(!$this->authorire($deadline)) return $this->redirect(['action' => 'index']);
        if ($this->Deadlines->delete($deadline)) {
            $this->Flash->success(__("L'échéance a été supprimée avec succès."));
        } else {
            $this->Flash->error(__("L'échéance n'a pas pu être supprimée. Veuillez réessayer."));
        }

        return $this->redirect(['action' => 'index', $editionID]);
    }

    private function authorire(Deadline $d){
        try{
            $this->Authorization->authorize($d);
            return true;
        } catch(ForbiddenException $e){
            $this->Flash->error("Vous n'avez pas l'autorisation.");
            return false;
        }
    }

    private function getUser(){
        return $this->Authentication->getResult()->getData();
    }
}
