<?php

class WorldNewsController extends AppController {
	var $name = 'WorldNews';
	# var $scaffold;
	var $paginate = array(
      'limit' => 25,
      'order' => array('wnews_date' => 'desc'),
			# 'recursive' => 1
	    );
	var $helpers = array("Time","cache");
	var $uses = array("WorldNews","User");
	var $cacheAction = array("view/"=>"+1 day","index"=>"+1 day");
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}
	
	function index() {
		$this->set("wnews",$this->paginate("WorldNews"));
	}
	
	function admin() {
		$this->set("wnews",$this->paginate("WorldNews"));
	}
	
	function view($id = null) {
		if ($id == null) { $this->cakeError("error404"); }
		$wnews = $this->WorldNews->findByWnews_id($id);
		if (empty($wnews)) { $this->cakeError("error404"); }
		$this->set("wnews",$wnews);
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->data["WorldNews"]["wnews_date"] = date("Y-m-d H:i:s");
			if($this->WorldNews->save($this->data)) {
				$this->Session->setFlash("World News added.");
				$this->redirect("/world_news");
			}
		}
		$this->set("user_id",$this->Auth->user("user_id"));
	}
	
	function edit($id=null) { # news/edit allows to edit all news.
		if ($id == null) { $this->redirect("/world_news"); }
		if (!empty($this->data)) {
			# $this->data["WorldNews"]["last_edit_time"] = date("Y-m-d H:i:s");
			if($this->WorldNews->save($this->data)) {
		  	//Set a session flash message and redirect.
		    $this->Session->setFlash("World News Saved!");
		    $this->redirect('/world_news');
			}
		}
		$this->data = $this->WorldNews->find("first",array("conditions"=>array("wnews_id"=>$id)));
		$this->set("user_id",$this->Auth->user("user_id"));
		$this->set("users",$this->WorldNews->User->find('list')); # FIXME: should only list users with relevant access level?
	}
	
	function delete($id=null) { # news/delete allows to delete all news.
		if ($id == null) { $this->redirect("/world_news"); }
		$wnews = $this->WorldNews->find("first",array("conditions"=>array("wnews_id"=>$id)));
		if (!empty($wnews)) {
			$this->WorldNews->del($id);
			$this->flash('The world news item with id '.$id.' has been deleted.', '/world_news');
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/world_news");
		}
		
	}
}

?>