<?php
class UsersController extends AppController {
    var $name = 'Users';    
		var $helpers = array("Bbcode");
		
		function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->allow("logout");
		}
 
    /**
     *  The AuthComponent provides the needed functionality
     *  for login, so you can leave this function blank.
     */
    function login() {
			# TODO: there should be Remember Me-functionality
    }

    function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    function view($id = null) {
		# FIXME: view decide if $id is a number (primary key) or slug (zyx) and work accordingly.
      if ($id == null) { $this->cakeError('error404'); }
			$this->User->recursive = 1; # FIXME: It'd be nice to limit this just to Group
      $this->set('user', $this->User->find("first",array("conditions"=>array("user_id"=>$id))));
			# $this->set("groups",$this->User->Group->find("all"));
    }
}

?>