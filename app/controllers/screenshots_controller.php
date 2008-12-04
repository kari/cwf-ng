<?php

class ScreenshotsController extends AppController {
	var $name = 'Screenshots';
  var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view","show"));
	}

	function show($img = null) {
		# This might be even slower way to do things. We need to invoke a php thread for each image... every time.
		# view = show DB-entry, show (public) = return image.
		# This should replicate previous $site->image-functionality cache-wise.
		# content-type image/(jpeg|png|...)
		if (!isset($img)) { $this->cakeError("error404"); }
		$ext = "png";
		$filename = basename($img);
		$this->view = "Media";
		$params = array("id"=>$filename,
			"download"=>false,
			"extension"=>$ext,
			"path"=>"webroot/img/cache/"
			);
		$this->set($params);
		# if fail, show this:
		# $this->cakeError("error404");
	}
}
?>