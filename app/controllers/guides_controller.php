<?php

class GuidesController extends AppController {
	var $name = 'Guides';
  var $scaffold;
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
}

?>