<?php

class ScreenshotsController extends AppController {
	var $name = 'Screenshots';
  # var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		# $this->Auth->allow(array("index","view"));
	}
	
	function add($id = null) {
		if (!empty($this->data)) {
			if($this->Screenshot->save($this->data)) {
				$this->Session->setFlash("Screenshot was added.");
				// TODO: Some preliminary thumbnailing etc.?
				$this->redirect("/games/queue");
			}
		}
		$this->set("game_id",$id);
		$this->set("screenshot_submitters",$this->Screenshot->User->find('list')); # FIXME: should only list users with relevant access level? (That'd be set in the model assocations...)
		$this->set("games",$this->Screenshot->Game->find("list"));
	}
	
	function edit($id=null) { # interview/edit allows to edit all news.
		if ($id == null) { $this->redirect("/"); }
		if (!empty($this->data)) {
			if($this->Screenshot->save($this->data)) {
		  	//Set a session flash message and redirect.
		    $this->Session->setFlash("Screenshot saved!");
		    # $this->redirect('/games/queue');
			}
		}
		$this->data = $this->Screenshot->find("first",array("conditions"=>array("screenshot_id"=>$id)));
		$this->set("screenshot_submitters",$this->Screenshot->User->find('list')); # FIXME: should only list users with relevant access level? (That'd be set in the model assocations...)
	}
	
	function delete($id=null) { # interview/delete allows to delete all news.
		if ($id == null) { $this->redirect("/"); }
		$screenshot = $this->Screenshot->find("first",array("conditions"=>array("screenshot_id"=>$id)));
		if (!empty($screenshot)) {
			$this->Screenshot->del($id);
			$this->flash('The screenshot with id '.$id.' has been deleted.', '/games/queue');
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/");
		}
		
	}

/*
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
*/
}
?>