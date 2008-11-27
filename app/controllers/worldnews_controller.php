<?php

class WorldNewsController extends AppController {
	var $name = 'WorldNews';
	var $scaffold;
	var $paginate = array(
      'limit' => 25,
      'order' => array('wnews_date' => 'desc'),
			# 'recursive' => 1
	    );
	var $helpers = array("Time");
	var $uses = array("WorldNews","User");
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}
		
}

?>