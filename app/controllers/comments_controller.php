<?php

class CommentsController extends AppController {
	var $name = 'Comments';
	var $paginate = array(
	    # 'conditions' => array("Game.download_status" => 0,"Genres.tools"=>0),
      'limit' => 30,
      'order' => array('Comment.created' => 'desc'),
			# "fields" => array("game_name","game_id"),
			'recursive' => 1
	    );
	
	var $components = array('Recaptcha');
	

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("add")); # FIXME: No comments/index in production.
		$this->Auth->mapActions(array("queue"=>"admin","publish"=>"admin","unpublish"=>"admin"));
		$this->Recaptcha->publickey = Configure::read("Site.captcha_public_key"); 
		$this->Recaptcha->privatekey = Configure::read("Site.captcha_private_key");
	}
	
	function queue() {
		$this->set("comments",$this->paginate("Comment",array("Comment.validated"=>0)));
	}
	
	function admin() {
		$conds = array();
		if (!empty($this->passedArgs["status"])) {
			switch($this->passedArgs["status"]) {
				case 2:
				$conds["validated"] = 0;
				break;
				case 1:
				$conds["validated"] = 1;
				break;
				default:
			}
		}
		$this->set("comments",$this->paginate("Comment",$conds));
	}
	
	function add() {
		if (!empty($this->data)) {
			App::import("Sanitize");
			$this->data["Comment"]["text"] = Sanitize::html($this->data["Comment"]["text"],true);
			# $this->data["Comment"]["title"] = Sanitize::html($this->data["Comment"]["title"],true);
			if ($this->Auth->user()) { 
				$this->data["Comment"]["validated"] = true; 
				$this->data["Comment"]["user_id"] = $this->Auth->user("user_id");
			} elseif(!$this->Recaptcha->valid($this->params['form'])) {
				$this->Session->setFlash("Comment wasn't added, because reCAPTCHA was wrong. Please try again.");
				# FIXME: Form contents are not saved, causing form to be empty! Can we send $this->data to $this->referer()?
				$this->redirect($this->referer());
			} elseif($this->Recaptcha->valid($this->params['form'])) {
				$this->data["Comment"]["validated"] = false;
				$this->data["Comment"]["user_id"] = -1; # FIXME: Magic number
			}
			if(isset($this->data["Comment"]["flag"]) && $this->data["Comment"]["flag"] == true) {
				# FIXME: This is "report mistakes" comment. Could be done in a much more nicer way.
				$this->Session->setFlash("Thanks for reporting!");
				$this->data["Comment"]["validated"] = false;
				$this->Comment->save($this->data);
				$this->redirect(array("controller"=>"games","action"=>"view",$this->data["Comment"]["game_id"]));
			}
			if($this->Comment->save($this->data)) {
				$this->Session->setFlash("Comment was added and will be published after validation.");
				# $this->redirect($this->referer());
			} else {
				$this->Session->setFlash("There were errors trying to save your comment.");
			}
		}
		$this->redirect($this->referer());
	}
	
	function edit($id=null) { # comment/edit allows to edit all comments.
		if ($id == null) { $this->redirect("/"); }
		if (!empty($this->data)) {
			# $this->data["News"]["last_edit_time"] = date("Y-m-d H:i:s");
			if($this->Comment->save($this->data)) {
		  	//Set a session flash message and redirect.
		    $this->Session->setFlash("Comment saved!");
		    $this->redirect($this->referer());
			}
		}
		$this->data = $this->Comment->findByComment_id($id);
	}
	
	function delete($id=null) { # comments/delete allows to delete all comments.
		if ($id == null) { $this->redirect("/"); }
		$comment = $this->Comment->find("first",array("conditions"=>array("comment_id"=>$id)));
		if (!empty($comment)) {
			$this->Comment->del($id);
			$this->flash('The comment with id '.$id.' has been deleted.', array("action"=>"admin"));
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/");
		}
		
	}
	
	function publish($id) {
		if ($id == null) { $this->redirect("/"); }
		$comment = $this->Comment->find("first",array("conditions"=>array("comment_id"=>$id))); 
		if (!empty($comment)) {
			$comment["Comment"]["validated"] = true;
			if ($this->Comment->save($comment)) {
				$this->Session->setFlash("Comment validated.");
			}
		}
		$this->redirect($this->referer());
	}
	
	function unpublish($id) {
		if ($id == null) { $this->redirect("/"); }
		$comment = $this->Comment->find("first",array("conditions"=>array("comment_id"=>$id))); 
		if (!empty($comment)) {
			$comment["Comment"]["validated"] = false;
			if ($this->Comment->save($comment)) {
				$this->Session->setFlash("Comment unpublished.");
			}
		}
		$this->redirect($this->referer());
	}
}

?>