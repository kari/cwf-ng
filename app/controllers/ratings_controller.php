<?php

class RatingsController extends AppController {
	var $name = 'Ratings';
  # var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("user_ratings"));
		$this->Auth->mapActions(array("create"=>array("vote")));
	}

	function vote() {
		if(!empty($this->data)) {
			# One feature of this is that once User has voted for Game on a Rating_Type, he can only change the value of that rating, but not delete it.
			
			$game_id = $this->data["Game"]["game_id"];
			foreach($this->data["Rating"] as $key => $rating) {
				if ($rating["rating_value"] == "") {
					unset($this->data["Rating"][$key]); # No value.
					continue;
				}
				$old_rating = $this->Rating->find("first",array("conditions"=>array("game_id"=>$game_id,"user_id"=>$this->Auth->user("user_id"),"rating_type"=>$key)));
				if (!empty($old_rating)) {
					$this->data["Rating"][$key] = array_merge($old_rating["Rating"],$rating);
					if (Set::isEqual($this->data["Rating"][$key],$old_rating["Rating"])) {
						unset($this->data["Rating"][$key]); # Nothing's changed.
					} else {
						$this->data["Rating"][$key]["voting_time"] = date("Y-m-d H:i:s"); # Something's changed.
					}
				} else { # New rating.
					$this->data["Rating"][$key]["voting_time"] = date("Y-m-d H:i:s");
					$this->data["Rating"][$key]["game_id"] = $game_id;
					$this->data["Rating"][$key]["user_id"] = $this->Auth->user("user_id");
				}
			}
			if(!empty($this->data["Rating"])) { 
				$this->Rating->saveAll($this->data["Rating"],array("validate"=>"all"));
			}
			$this->Session->setFlash("Your ratings have been saved."); # Not really (in all cases), but...
			$this->redirect($this->referer());
		} else {
			$this->redirect("/"); # shouldn't be here if not POSTed.
		}
	}
	# Some skeleton for possible game ratings element.. 
	function user_ratings($id=null) {
		if ((isset($this->params["requested"])) AND (isset($id))) {
			$user_ratings_array = $this->Rating->find("all",array("conditions"=>array("user_id"=>$this->Auth->user("user_id"),"game_id"=>$id)));
			$user_ratings = array();
				foreach ($user_ratings_array as $rating) {
					$user_ratings[$rating["Rating"]["rating_type"]]["value"] = $rating["Rating"]["rating_value"];
		  		$user_ratings[$rating["Rating"]["rating_type"]]["vote_id"] = $rating["Rating"]["vote_id"];
				}
			return $user_ratings;
		}
		if (isset($this->params["requested"])) { return false; }
		$this->cakeError("error404");
	}
}

?>