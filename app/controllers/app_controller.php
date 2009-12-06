<?php
class AppController extends Controller {  
	var $components = array('Auth'); # ,"RememberMe");
	var $helpers = array("html","form","javascript","text","site","Bbcode","number","time"); # FIXME: Move helpers to individual controllers to optimize stuff
	var $uses = array("User");
	
	function beforeFilter() {
		setlocale(LC_CTYPE,array("en_GB.UTF-8","en_US.UTF-8","da_DK.UTF-8","fi_FI.UTF-8"));
		Security::setHash("md5"); # phpbb2 uses md5
		
		# Access to actions is denied by default, controllers MUST allow public actions in beforeFilter()
		$this->Auth->deny("*");
		$this->Auth->authorize = array("model"=>"User");
		# FIXME: User should be always update (if possible) something created by him. Some cases even delete.
		# Workaround: update/delete action only applies to own. admin access also others. admin/controller/action for such actions?
		
		$this->Auth->logoutRedirect = "/";
	  $this->Auth->fields = array(
	  	'username' => 'username', # phpbb2 db-fields
	    'password' => 'user_password'
	    );
		$this->Auth->userScope = array('User.user_active' => '1'); # only allow activated (non-banned) users
		
		# $this->RememberMe->check(); # FIXME: Remove rememberme
		
		# If user is not logged in according to AuthComponent, check 
		# if phpBB cookie exists, fetch user's password from database and 
		# do a manual login.		
		if (!$this->Auth->user()) {
			if (!empty($_COOKIE["CWmysql_data"]) && !empty($_COOKIE["CWmysql_sid"])) {
				/* Cookie exists, so let's get autologin info */
				$phpbb_cookie = unserialize(stripslashes($_COOKIE["CWmysql_data"])); # NB: stripslashes require if some php-setting is on (as it is on surftown) that adds slashes to the data. 
				$authloginid = $phpbb_cookie["autologinid"];
				$authuserid = $phpbb_cookie["userid"];
				$session = $_COOKIE["CWmysql_sid"]; # We could also check that a valid session exists, but do/should we care?
				
				/* Does the cookie actually have any info we can use? */
				if (!empty($authuserid) && !empty($authloginid)) {
					$authloginkey = md5($authloginid);
					/* Can we find a session key for this user? */
					$query = 'SELECT * FROM phpbb_users AS u, phpbb_sessions_keys AS k WHERE u.user_id = "' . $authuserid . '" AND u.user_active = 1 AND u.user_id = k.user_id AND k.key_id = "'.$authloginkey.'"';
					$result = $this->User->query($query);
				
					if (!empty($result)) {
						/* We did find a valid session key, let's try to login */
						$user = $this->User->find("first",array("conditions"=>array("user_id"=>$authuserid,'User.user_active' => '1'),"fields" => array($this->Auth->fields["username"],$this->Auth->fields["password"])));
						if (!$this->Auth->login($user)) {
							# $this->Session->setFlash("We could not login you.");
							/* We probably need to redirect to phpbb's login thing. */
						} else {
							# $this->Session->setFlash("We could login you in. Fun times.");
							/* CakePHP AuthComponent should now have logged us in. We're god to go */
						}
					} else {
						# $this->Session->setFlash("No valid session key found.");
					}
				} else {
					# $this->Session->setFlash("Not logged in or auto-login disabled.");
				}
			} else {
				# $this->Session->setFlash("No cookie. You must be new around here.");
			}
		} 

		
		$controller = str_replace("_","",$this->params["controller"]); # FIXME: There's probably a function for formatting the controller name more robustly.
		if ($this->User->isAuthorized($this->Auth->user(),$controller,"admin")) { # FIXME: Controller name here is not set by the same function as with authorization. Works, though.
			$this->set("admin_mode",true);
		}
	}
	
}