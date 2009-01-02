<?php

class DownloadsController extends AppController {
	var $name = 'Downloads';
  # var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
		$this->Auth->mapActions(array("read"=>array("get")));
	}

	function get($id=null) {
		$this->layout = 'ajax';
		$this->view = 'Media';
		if ($id == null) return false;
	  # FIXME: Proper downloading...
		$params = array(
	              'id' => 'tikibileet.jpg',
	              'name' => 'tikibileet',
	              'download' => false, # true
	              'extension' => 'jpg',
	              'path' => 'webroot'. DS .'files' . DS);
	  $this->set($params);
	}
	
	function add($id = null) {
		if (!empty($this->data)) {
			if($this->Download->save($this->data)) {
				$this->Session->setFlash("Download was added.");
				$this->redirect("/games/queue");
			}
		}
		$this->set("game_id",$id);
		$this->set("game_submitters",$this->Download->User->find('list')); # FIXME: should only list users with relevant access level? (That'd be set in the model assocations...)
		
		$this->set("games",$this->Download->Game->find("list"));
		$this->set("DL_TYPE",$this->Download->TYPE);
		$this->set("PLATFORM",$this->Download->PLATFORM);
	}
	
	function edit($id=null) { # interview/edit allows to edit all news.
		if ($id == null) { $this->redirect("/"); }
		if (!empty($this->data)) {
			if($this->Download->save($this->data)) {
		  	//Set a session flash message and redirect.
		    $this->Session->setFlash("Download saved!");
		    # $this->redirect('/games/queue');
			}
		}
		$this->data = $this->Download->find("first",array("conditions"=>array("file_id"=>$id)));
		$this->set("game_submitters",$this->Download->User->find('list')); # FIXME: should only list users with relevant access level? (That'd be set in the model assocations...)
		$this->set("games",$this->Download->Game->find("list"));
		$this->set("DL_TYPE",$this->Download->TYPE);
		$this->set("PLATFORM",$this->Download->PLATFORM);
	}
	
	function delete($id=null) { # interview/delete allows to delete all news.
		if ($id == null) { $this->redirect("/"); }
		$download = $this->Download->find("first",array("conditions"=>array("file_id"=>$id)));
		if (!empty($download)) {
			$this->Download->del($id);
			$this->flash('The download with id '.$id.' has been deleted.', '/games/queue');
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/");
		}
		
	}
	
}

?>