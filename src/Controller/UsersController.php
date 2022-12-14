<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\User;
use Cake\Auth\DefaultPasswordHasher;
use Authorization\Exception\ForbiddenException;
use Cake\Event\EventInterface;
use Cake\Mailer\Email;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        if($this->getUser()->isAdmin){
            $users = $this->paginate($this->Users, ["limit" => 10]);
        } else {
            $users = $this->paginate($this->Users->findById($this->getUser()->id), ["limit" => 10]);
        }
        $isAdmin = $this->getUser()->isAdmin;

        $this->set(compact('isAdmin'));
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if(!$this->authorize($user)) return $this->redirect(['controller' => 'Schools', 'action' => 'index']);
        $isAdmin = $this->getUser()->isAdmin;
        $this->set(compact('isAdmin'));
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();

        if(!$this->Authentication->getResult()->isValid()){
            $this->Authorization->skipAuthorization();
        } else {
            if(!$this->authorize($user)) return $this->redirect(['controller' => 'Schools', 'action' => 'index']);
            $isAdmin = $this->getUser()->isAdmin;
            $this->set(compact('isAdmin'));
        }

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if(!$this->Authentication->getResult()->isValid()){
                $user->isAdmin = 0;
            }

            if($this->request->getData('others') != null){
                $user->civility = $this->request->getData('others');
            }
            
            if(!$this->emailRegex($this->request->getData('email'))){
                $this->Flash->error(__("Vous devez entrer un mail qui fini par hers.be"));
            } else if($this->request->getData('password_confirm') !== $this->request->getData('password')){
                $this->Flash->error(__('Les mots de passes doivent ??tre identiques.'));
            } else if ($this->Users->save($user)) {
                $this->sendEmail($user->email);
                $this->Flash->success(__("L'utilisateur a ??t?? ajout?? avec succ??s"));
                if($this->Authentication->getResult()->isValid()){
                    return $this->redirect(['controller' => 'pages', 'action' => 'home']);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("L'utilisateur n'a pas pu ??tre ajout??. Veuillez r??essayer s'il vous pla??t."));
        }

        $this->set(compact('user'));
    }

    private function emailRegex($userEmail){
        $pattern = "/hers.be$/i";
        return preg_match($pattern, $userEmail) == 1; 
    }

    private function sendEmail($userEmail){
        $email = new Email('default');
        $email->setFrom(["rallye.math@hers.be" => 'Site RallyMath'])
                ->setTo($userEmail)
                ->setSubject("Votre compte sur RallyeMath")
                ->send("Bienvenue sur RallyeMath ! Votre compte a bien ??t?? enregistr??");
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if(!$this->authorize($user)) return $this->redirect(['controller' => 'Schools', 'action' => 'index']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            $currentPassword = $this->request->getData('password_current');

            
            if($this->request->getData('others') != null){
                $user->civility = $this->request->getData('others');
            }

            if($currentPassword == null || !(new DefaultPasswordHasher())->check($currentPassword,$this->getUser()->password)){
                $this->Flash->info(__("Le mot de passe actuel n'est pas valide."));
            } else if(!empty($this->request->getData('password_confirm')) && $this->request->getData('password_confirm') !== $this->request->getData('password')){
                $this->Flash->error(__('Les mots de passes doivent ??tre identiques.'));
            } else if ($this->Users->save($user)) {
                $this->Flash->success(__("L'utilisateur a ??t?? modifi?? avec succ??s"));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("'L'utilisateur n'a pas pu ??tre modifi??. Veuillez r??essayer s'il vous pla??t.'"));
        }
        $isAdmin = $this->getUser()->isAdmin;
        $this->set(compact('isAdmin'));
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        
        if(!$this->authorize($user)) return $this->redirect(['controller' => 'Schools', 'action' => 'index']);
        
        if($user->isAdmin && $user->id == $this->getUser()->id){
            $this->Flash->error(__("Vous ne pouvez pas suppimer votre propre compte administrateur."));
        } else {
            if($this->Users->delete($user)) {
                if($this->getUser()->id == $user->id){
                    $this->logout();
                }
                $this->Flash->success(__("L'utilisateur a ??t?? supprim?? avec succ??s."));
            } else {
                $this->Flash->error(__("L'utilisateur n'a pas pu ??tre supprim??"));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(EventInterface $event){
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login']);
        $this->Authentication->addUnauthenticatedActions([
            'login',
            'add',
            'logout'
        ]);
    }

    public function login(){
        
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['get', 'post']);
        
        // $this->Authorization->skipAuthorization();
        /**
         * @var \Authentication\Authenticator\ResultInterface
         */
        $result = $this->Authentication->getResult();

        if($result->isValid()){
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'pages',
                'action' => 'home'
            ]);
            return $this->redirect($redirect);
        } else if($this->request->is('post')){
            $this->Flash->error('Connexion ??chou??e.');
        }
    }

    public function logout(){
        // $this->Authorization->skipAuthorization();
        /**
         * @var \Authentication\Authenticator\ResultInterface
         */

        $this->Authorization->skipAuthorization();
        $result = $this->Authentication->getResult();
        if($result->isValid()){
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    private function getUser(){
        return $this->Authentication->getResult()->getData();
    }

    private function authorize(User $user){
        try{
            $this->Authorization->authorize($user);
            return true;
        } catch(ForbiddenException $e){
            $this->Flash->error("Vous n'avez pas l'autorisation.");
            return false;
        }
    }

}