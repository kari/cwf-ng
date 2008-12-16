<?php

class InterviewsController extends AppController {
	var $name = 'Interviews';
  # var $scaffold;
	var $helpers = array("cache");
	var $cacheAction = array("index"=>"+1 day","view/"=>"+1 day");

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}
	
	function index() {
		$this->set("interviews",$this->Interview->find("all"));
	}
	
	function view($id=null) {
		if (!isset($id)) $this->cakeError("error404");
		$interview = $this->Interview->find("first",array("conditions"=>array("interview_id"=>$id)));
		if (empty($interview)) $this->cakeError("error404");
		$this->set("interview",$interview);
	}
	
	function add() {
		if (!empty($this->data)) {
			if($this->Interview->save($this->data)) {
				$this->Session->setFlash("Interview was added.");
				$this->redirect("/interviews");
			}
		}
				$this->set("games",$this->Interview->Game->find("list",array("conditions"=>array("download_status"=>0))));
		$this->set("user_id",$this->Auth->user("user_id"));
		$this->set("developers",$this->Interview->Publisher->find("list"));
	}
	
	function edit($id=null) { # interview/edit allows to edit all news.
		if ($id == null) { $this->redirect("/interviews"); }
		if (!empty($this->data)) {
			if($this->Interview->save($this->data)) {
		  	//Set a session flash message and redirect.
		    $this->Session->setFlash("Interview saved!");
		    $this->redirect('/interviews');
			}
		}
		$this->data = $this->Interview->find("first",array("conditions"=>array("interview_id"=>$id)));
		# $this->set("user_id",$this->Auth->user("user_id"));
		$this->set("interviewers",$this->Interview->Interviewer->find('list')); # FIXME: should only list users with relevant access level? (That'd be set in the model assocations...)
		$this->set("games",$this->Interview->Game->find("list",array("conditions"=>array("download_status"=>0))));
		$this->set("developers",$this->Interview->Publisher->find("list"));
		
	}
	
	function delete($id=null) { # interview/delete allows to delete all news.
		if ($id == null) { $this->redirect("/interviews"); }
		$interview = $this->Interview->find("first",array("conditions"=>array("interview_id"=>$id)));
		if (!empty($interview)) {
			$this->Interview->del($id);
			$this->flash('The interview with id '.$id.' has been deleted.', '/interviews');
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/interviews");
		}
		
	}
}

?>