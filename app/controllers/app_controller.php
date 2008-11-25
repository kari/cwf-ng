<?
class AppController extends Controller {  
	var $components = array('Auth');
	var $helpers = array("html","form","javascript","text","site","Bbcode","number");
	# var $uses = "User";
	
	function beforeFilter() {
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
	}
	
}