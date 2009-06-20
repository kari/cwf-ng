<?php

class PublishersController extends AppController {
	var $name = 'Publishers';
  # var $scaffold;
	var $helpers = array("cache");
	var $cacheAction = array("view/"=>"+1 day");
	var $components = array('Recaptcha');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("view"));
	}

  function view($id = null) {
    $this->set('publisher', $this->Publisher->read('',$id));
  }

	function add($game_id = null) {
		if (!empty($this->data)) {
			if($this->Publisher->save($this->data)) {
				$this->Session->setFlash("Publisher was added.");
				if ($game_id) {
					# FIXME: Save publisher as game's publisher.
					$pub = array("Game"=>array("game_id"=>$game_id,"publisher_id"=>$this->Publisher->id));
					$this->Publisher->Game->save($pub);
					$this->redirect(array("controller"=>"games","action"=>"edit",$game_id));
				} else {
					$this->redirect(array("action"=>"edit",$this->Publisher->id));
				}
			}
		}
		if ($game_id) {
			$game = $this->Publisher->Game->find("first",array("conditions"=>array("Game.game_id"=>$game_id)));
			if (empty($game)) { $this->cakeError("error404"); }
			$this->set("game",$game);
			$this->set("game_redirect",$game_id);
		}
	}
	
	function edit($id=null) { # interview/edit allows to edit all news.
		if ($id == null) { $this->redirect("/"); }
		if (!empty($this->data)) {
			$this->data["Publisher"]["publisher_id"] = $id;
			if($this->Publisher->save($this->data)) {
		  	//Set a session flash message and redirect.
		    $this->Session->setFlash("Publisher saved!");
		    # $this->redirect('/games/queue');
			} else {
				# Save failed
				$this->Session->setFlash("There were errors trying to save changes.");
			}
		} else {
			$this->data = $this->Publisher->find("first",array("conditions"=>array("publisher_id"=>$id)));
		}
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