<?php

class ScreenshotsController extends AppController {
	var $name = 'Screenshots';
  var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}
}

?>