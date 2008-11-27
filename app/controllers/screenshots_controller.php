<?php

class ScreenshotsController extends AppController {
	var $name = 'Screenshots';
  var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view","show"));
	}
}
	function show($img = null) {
		# view = show DB-entry, show (public) = return image.
		# This should replicate previous $site->image-functionality cache-wise.
		# content-type image/(jpeg|png|...)
		
		# if fail, show this:
		$this->cakeError("error404");
	}

?>