<?php

class CommentsController extends AppController {
	var $name = 'Comments';
  var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view","add")); # FIXME: No comments/index in production.
	}
	
	function queue() {
		
	}

/*	
	function add() {
		# if user registered, skip validation queue (validated => true)
	}
	
	function delete() {
		
	}
*/
}

?>