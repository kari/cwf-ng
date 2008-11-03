<?
class AppController extends Controller {  
	var $components = array('Auth');
	
	function beforeFilter() {
		Security::setHash("md5"); # phpbb2 uses md5
		$this->Auth->allow("*"); # FIXME: for added security, deny all.
		$this->Auth->logoutRedirect = "/";
	  $this->Auth->fields = array(
	  	'username' => 'username', # phpbb2 db-fields
	    'password' => 'user_password'
	    );
		$this->Auth->userScope = array('User.user_active' => '1'); # only allow activated (non-banned) users
	}
}