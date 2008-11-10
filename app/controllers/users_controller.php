<?php
class UsersController extends AppController {
    var $name = 'Users';    
		var $helpers = array("Bbcode");
		
		function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->deny("*");
			$this->Auth->allow(array("logout"));
		}
 
    /**
     *  The AuthComponent provides the needed functionality
     *  for login, so you can leave this function blank.
     */
    function login() {
    }

    function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    function view($id = null) {
      if ($id == null) { $this->cakeError('error404'); }
      $this->set('user', $this->User->read('',$id));
    }
}

?>