<?php

class InterviewsController extends AppController {
	var $name = 'Interviews';
  var $scaffold;
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
}

?>