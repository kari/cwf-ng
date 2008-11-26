<?php

class InterviewsController extends AppController {
	var $name = 'Interviews';
  var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}
	
	function index() {
		$this->set("interviews",$this->Interview->find("all"));
	}
}

?>