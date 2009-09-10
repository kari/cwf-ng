<?php

class PublishersController extends AppController {
	var $name = 'Publishers';
  # var $scaffold;
	var $helpers = array("cache");
	var $cacheAction = array("view/"=>"+1 day");
	var $components = array('Recaptcha');
	# var $uses = array("Publisher","Game","Interview");
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("view"));
	}

  function view($id = null) {
		$this->Publisher->contain(array("Game.download_status=0","Interview"));
		$this->set("publisher",$this->Publisher->find("first",array("conditions"=>array("Publisher.publisher_id"=>$id))));
  }

	function admin() {
		# Dummy redirector
		$this->redirect("/games/admin");
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
			$this->Session->setFlash('The publisher with id '.$id.' has been deleted.');
			$this->redirect("/games/admin");
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/");
		}
		
	}
  
}
?>