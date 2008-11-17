<?php

class CommentsController extends AppController {
	var $name = 'Comments';
  var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view")); # FIXME: No comments/index in production.
	}
}

?>