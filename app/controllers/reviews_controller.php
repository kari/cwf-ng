<?php

class ReviewsController extends AppController {
	var $name = 'Reviews';
  var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}
	
	function index() {
		$this->set("reviews",$this->Review->find("all",array("conditions"=>array("review_rating >="=>0))));
	}
}

?>