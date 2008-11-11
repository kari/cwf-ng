<?php

class DownloadsController extends AppController {
	var $name = 'Downloads';
  var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}

	function get($id=null) {
		$this->layout = 'ajax';
		$this->view = 'Media';
		if ($id == null) return false;
	  $params = array(
	              'id' => 'tikibileet.jpg',
	              'name' => 'tikibileet',
	              'download' => false, # true
	              'extension' => 'jpg',
	              'path' => 'webroot'. DS .'files' . DS);
	  $this->set($params);
	}
}

?>