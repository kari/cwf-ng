<?php

class PublishersController extends AppController {
	var $name = 'Publishers';
  var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("view"));
	}

  function view($id = null) {
    $this->set('publisher', $this->Publisher->read('',$id));
  }
  
}
?>