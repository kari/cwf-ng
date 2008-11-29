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
	
	function view($id = null) {
		if ($id == null) { $this->cakeError("error404"); }
		$review = $this->Review->find("first",array("conditions"=>array("review_rating >="=>0,"review_id"=>$id)));
		if (empty($review)) { $this->cakeError("error404"); }
		$this->set("review",$review);
	}
}

?>