<?
class AppController extends Controller {  
	var $components = array('Auth',"RememberMe");
	var $helpers = array("html","form","javascript","text","site","Bbcode","number","time"); // FIXME: Move helpers to individual controllers to optimize stuff
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
		$this->RememberMe->check();
		if ($this->User->isAuthorized($this->Auth->user(),$this->params["controller"],"admin")) {
			$this->set("admin_mode",true);
		}
	}
	
}