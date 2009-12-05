<?php
class UsersController extends AppController {
    var $name = 'Users';    
		var $helpers = array("Bbcode","Cache");
		
		var $cacheAction = array("view/"=>"+1 day");
		
		function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->allow(array("logout","view","signup","piggyback"));
		}
 
    /**
     *  The AuthComponent provides the needed functionality
     *  for login, so you can leave this function blank.
     */
    function login() {
			# $this->Session->setFlash($this->data)
			/* if (!$this->Auth->user()) {  
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
			
			unset($this->data['User']['remember_me']);
			$this->redirect($this->Auth->redirect()); */
    }

    function logout() {
			# $this->RememberMe->delete();
			$this->redirect($this->Auth->logout());
    }

		/* A test to see if we can piggyback on a phpbb cookie */
		function piggyback() {
			$this->layout = "ajax";
			
			/* Fetch cookie. */
			if (!empty($_COOKIE["CWmysql_data"]) && !empty($_COOKIE["CWmysql_sid"])) {
				/* Cookie exists, so let's get autologin info */
				$phbbp_cookie = unserialize(stripslashes($_COOKIE["CWmysql_data"]));
				$authloginid = $phpbb_cookie["authloginid"];
				$authloginkey = md5($authloginid);
				$authuserid = $phpbb_cookie["userid"];
				$session = $_COOKIE["CWmysql_sid"]; # We could also check that a valid session exists, but do/should we care?
				
				/* Can we find a session key for this user? */
				$query = 'SELECT * FROM phpbb_users AS u, phpbb_sessions_keys AS k WHERE u.user_id = "' . $auth_cookie["userid"] . '" AND u.user_active = 1 AND u.user_id = k.user_id AND k.key_id = "'.$authloginkey.'"';
				$result = $this->User->query($query);
				
				if (!empty($result)) {
					/* We did find a valid session key, let's try to login */
					$user = $this->User->find("first",array("conditions"=>array("user_id"=>$authuserid,'User.user_active' => '1'),"fields" => array("username","user_password")));
					if (!$this->Auth->login($user)) {
						echo "We could not login.";
						/* We probably need to redirect to phpbb's login thing. */
					} else {
						echo "We could login. Fun times.";
						/* CakePHP AuthComponent should now have logged us in. We're god to go */
					}
				} else {
					echo "No valid session key found.";
				}
			} else {
				echo "No cookie. Cookie monster is sad.";
			}

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

		function signup() {
			$this->redirect("http://".Configure::read("Forum.url")."/profile.php?mode=register"); #FIXME: before release
		}
}

?>