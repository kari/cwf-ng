<?php
class UsersController extends AppController {
    var $name = 'Users';    
		var $helpers = array("Bbcode","Cache");
		
		var $cacheAction = array("view/"=>"+1 day");
		
		function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->allow("logout");
		}
 
    /**
     *  The AuthComponent provides the needed functionality
     *  for login, so you can leave this function blank.
     */
    function login() {
			if (!$this->Auth->user()) {  
				return;  
			}
			
      if (empty($this->data)) {
				$this->redirect($this->Auth->redirect()); 
			}
       
      if (empty($this->data['User']['remember_me'])) { 
				$this->RememberMe->delete(); 
			} else { 
				$this->RememberMe->remember($this->data['User']['username'],$this->data['User']['user_password']); 
			}
			
			unset($this->data['User']['remember_me']); $this->redirect($this->Auth->redirect());
    }

    function logout() {
			$this->RememberMe->delete();
			$this->redirect($this->Auth->logout());
    }
    
    function view($id = null) {
		# FIXME: view decide if $id is a number (primary key) or slug (zyx) and work accordingly.
      if ($id == null) { $this->cakeError('error404'); }
			$this->User->recursive = 1; # FIXME: It'd be nice to limit this just to Group
			$user = $this->User->find("first",array("conditions"=>array("user_id"=>$id,'User.user_active' => '1')));
			if (empty($user)) { $this->cakeError("error404"); }
			$this->set('user', $user);
			$this->data["cached_user_id"] = $id;
    }
}

?>