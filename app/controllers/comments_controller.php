<?php

class CommentsController extends AppController {
	var $name = 'Comments';
  # var $scaffold;
	var $paginate = array(
	    # 'conditions' => array("Game.download_status" => 0,"Genres.tools"=>0),
      'limit' => 30,
      'order' => array('Comment.created' => 'desc'),
			# "fields" => array("game_name","game_id"),
			'recursive' => 1
	    );

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("add")); # FIXME: No comments/index in production.
	}
	
	function queue() {
		$this->set("comments",$this->paginate("Comment"));
	}
	
	function add() {
		if (!empty($this->data)) {
			if ($this->Auth->user()) { 
				$this->data["Comment"]["validated"] = true; 
			} else {
				$this->data["Comment"]["validated"] = false;
				$this->data["Comment"]["user_id"] = -1; # FIXME: Magic number
			}
			if($this->Comment->save($this->data)) {
				$this->Session->setFlash("Comment was added and will be published after validation.");
				$this->redirect($this->referer());
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
			$this->flash('The comment with id '.$id.' has been deleted.', $this->referer());
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/");
		}
		
	}
}

?>