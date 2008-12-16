<?php

class GuidesController extends AppController {
	var $name = 'Guides';
  # var $scaffold;
	var $helpers = array("cache");
	var $cacheAction = array("index"=>"+1 day","view/"=>"+1 day");

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}
	
	function index() {
		$this->set("guides",$this->Guide->find("all"));
	}
	
	function view($id=null) {
		if (!isset($id)) $this->cakeError("error404");
		$guide = $this->Guide->find("first",array("conditions"=>array("id"=>$id)));
		if (empty($guide)) $this->cakeError("error404");
		$this->set("guide",$guide);
	}
	
	function add() {
		if (!empty($this->data)) {
			if($this->Guide->save($this->data)) {
				$this->Session->setFlash("Guide was added.");
				$this->redirect("/guides");
			}
		}
				$this->set("games",$this->Guide->Game->find("list",array("conditions"=>array("download_status"=>0))));
		$this->set("user_id",$this->Auth->user("user_id"));
	}
	
	function edit($id=null) { # guides/edit allows to edit all news.
		if ($id == null) { $this->redirect("/guides"); }
		if (!empty($this->data)) {
			if($this->Guide->save($this->data)) {
		  	//Set a session flash message and redirect.
		    $this->Session->setFlash("Guide saved!");
		    $this->redirect('/guides');
			}
		}
		$this->data = $this->Guide->find("first",array("conditions"=>array("id"=>$id)));
		# $this->set("user_id",$this->Auth->user("user_id"));
		$this->set("users",$this->Guide->User->find('list')); # FIXME: should only list users with relevant access level? (That'd be set in the model assocations...)
		$this->set("games",$this->Guide->Game->find("list",array("conditions"=>array("download_status"=>0))));
		
	}
	
	function delete($id=null) { # guides/delete allows to delete all news.
		if ($id == null) { $this->redirect("/guides"); }
		$guide = $this->Guide->find("first",array("conditions"=>array("id"=>$id)));
		if (!empty($guide)) {
			$this->Guide->del($id);
			$this->flash('The guide with id '.$id.' has been deleted.', '/guides');
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/guides");
		}
		
	}
}

?>