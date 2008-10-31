<?php
class UsersController extends AppController {
    var $name = 'Users';    

		var $components = array('Auth');
		var $helpers = array("Bbcode");
		
		function _beforeFilter() {
						Security::setHash("md5");
		        $this->Auth->fields = array(
		            'username' => 'username', 
		            'password' => 'user_password'
		            );
						$this->Auth->userScope = array('User.user_active' => '1');
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