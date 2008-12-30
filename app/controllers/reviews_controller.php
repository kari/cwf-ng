<?php

class ReviewsController extends AppController {
	var $name = 'Reviews';

	var $uses = array("Review","Game");
	var $helpers = array("Cache");
	var $cacheAction = array("index"=>"+1 hour","view/"=>"+1 day");
	var $paginate = array("limit"=>15,"order"=>"Review.added DESC");

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
		$this->Auth->mapActions(array("queue"=>"admin"));
	}
	
	function index() {
		$this->set("reviews",$this->paginate("Review",array("review_rating >="=>0)));
	}
	
	function view($id = null) {
		if ($id == null) { $this->cakeError("error404"); }
		$review = $this->Review->find("first",array("conditions"=>array("review_rating >="=>0,"review_id"=>$id)));
		if (empty($review)) { $this->cakeError("error404"); }
		$this->set("review",$review);
	}
	
	function add($id = null) {
		if (!empty($this->data)) {
			$this->data["Review"]["added"] = date("Y-m-d H:i:s");
			$this->data["Review"]["review_rating"] = -99; #FIXME: Magic number
			# $this->data["Review"]["validator_id"] = null;
			if($this->Review->save($this->data)) {
				$this->Session->setFlash("Review was added and will be published after validation.");
				$this->redirect("/reviews");
			}
		}
		$game = $this->Game->find("first",array("conditions"=>array("download_status"=>0,"Game.game_id"=>$id)));
		if (!$game) { $this->redirect($this->referer()); } # throw out if invalid id.
		$this->set("game",$game);
		$this->set("user_id",$this->Auth->user("user_id"));
	}
	
	function edit($id=null) { # reviews/edit allows to only edit own reviews.
		$review = $this->Review->find("first",array("conditions"=>array("Review.review_id"=>$id,"Review.user_id"=>$this->Auth->user("user_id"))));
		if (!empty($review)) {
			if (!empty($this->data)) {
				$this->data["Review"]["review_rating"] = -99; #FIXME: Magic number. 
				# $this->data["Review"]["last_edit_time"] = date("Y-m-d H:i:s");
				if($this->Review->save($this->data)) {
		  		//Set a session flash message and redirect.
		    	$this->Session->setFlash("Review saved. It will published after validation.");
		    	$this->redirect('/reviews');
				}
			} else {
				$this->data = $review;
				$this->set("user_id",$this->Auth->user("user_id"));
				$this->set("users",$this->Review->User->find('list'));
				$this->set("games",$this->Review->Game->find("list",array("download_status"=>0)));
			}
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/reviews");
		}
	}
	
	function delete($id=null) {
		$review = $this->Review->find("first",array("conditions"=>array("Review.review_id"=>$id,"Review.user_id"=>$this->Auth->user("user_id"))));
		if (!empty($review)) {
			$this->Review->del($id);
			$this->flash('The review with id '.$id.' has been deleted.', '/reviews');
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/reviews");
		}
	}
	
	function queue() {
		$reviews = $this->Review->find("all",array("conditions"=>array("review_rating"=>-99),"order"=>"added DESC"));
		$this->set("reviews",$reviews);
	}
	
	function admin() {
		$this->set("reviews",$this->paginate("Review",array()));
	}
}

?>