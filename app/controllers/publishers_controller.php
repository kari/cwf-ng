<?php

class PublishersController extends AppController {
	var $name = 'Publishers';
  # var $scaffold;
	var $helpers = array("cache");
	var $cacheAction = array("view/"=>"+1 day");

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("view"));
	}

  function view($id = null) {
    $this->set('publisher', $this->Publisher->read('',$id));
  }

	function add() {
		if (!empty($this->data)) {
			if($this->Publisher->save($this->data)) {
				$this->Session->setFlash("Publisher was added.");
				$this->redirect("/games/queue");
			}
		}
	}
	
	function edit($id=null) { # interview/edit allows to edit all news.
		if ($id == null) { $this->redirect("/"); }
		if (!empty($this->data)) {
			if($this->Publisher->save($this->data)) {
		  	//Set a session flash message and redirect.
		    $this->Session->setFlash("Publisher saved!");
		    # $this->redirect('/games/queue');
			}
		}
		$this->data = $this->Publisher->find("first",array("conditions"=>array("publisher_id"=>$id)));
	}
	
	function delete($id=null) { # interview/delete allows to delete all news.
		if ($id == null) { $this->redirect("/"); }
		$publisher = $this->Publisher->find("first",array("conditions"=>array("publisher_id"=>$id)));
		if (!empty($publisher)) {
			$this->Publisher->del($id);
			$this->flash('The publisher with id '.$id.' has been deleted.', '/');
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/");
		}
		
	}
  
}
?>