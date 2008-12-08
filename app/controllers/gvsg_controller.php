<?php

class GvsgController extends AppController {
	var $name = 'Gvsg';
  var $uses = array("Game","GvsgVote","GvsgStats");

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","stats"));
	}
	
	function index() {
		$this->Game->recursive = 1;
		$this->set("games",$this->Game->getRandom(2));
	}

	function vote() {
		/*
		Game vs Game voting
		Two games are chosen by random and user chooses between them.
		For the winning game its wins+=1 and points+=loser_points
		Player can't vote twice for the same combination
		*/
		# if POST data, process. otherwise, redirect to index.
		if(!empty($this->data["gvsg"])) {
			$user_id = $this->data["User"]["user_id"];
			$winner = $this->Game->read("",$this->data["Game"][$this->data["gvsg"]["winner"]]["game_id"]);
			$loser = $this->Game->read("",$this->data["Game"][($this->data["gvsg"]["winner"] XOR 1)]["game_id"]); # loser is the opposite of winner. 1 xor 1 = 0, 0 xor 1 = 1. 
			
			
			# Some DB action...
			# gvsg vote, must be unique for (user_id,game1_id,game2_id)
			$gvsg_vote = array("GvsgVote"=>array("game1_id"=>$winner["Game"]["game_id"],"game2_id"=>$loser["Game"]["game_id"],"winner"=>$winner["Game"]["game_id"],"voter"=>$user_id,"time"=>date("Y-m-d H:i:s")));
			$winner["GvsgStats"]["game_id"] = $winner["Game"]["game_id"]; # Game had never won 
			$winner["GvsgStats"]["wins"] += 1;
			$winner["GvsgStats"]["points"] += $loser["GvsgStats"]["wins"];
			
			# Only save vote if it's unique for (user_id,game1_id,game2_id)
			# FIXME: We only check that for given combination, the user hasn't voted similarily before. In other words, user can vote twice for a combination once for game1 and for game2.
			# FIX: conditions => game1_id = (loser_id OR winner_id) AND game2_id = (loser_id OR winner_id) 
			$unique_check = $this->GvsgVote->find("first",array("fields"=>"vote_id","conditions"=>array("voter"=>$gvsg_vote["GvsgVote"]["voter"],"game1_id"=>$gvsg_vote["GvsgVote"]["game1_id"],"game2_id"=>$gvsg_vote["GvsgVote"]["game2_id"])));
			if (empty($unique_check)) {
				$this->GvsgVote->save($gvsg_vote);
				$this->GvsgStats->save($winner);
				$this->Session->setFlash("Your vote for ".$winner["Game"]["game_name"]." is counted. Thanks for playing!");
			}
			
			$this->redirect($this->referer()); # or where-ever we did the vote
		} else {
			$this->redirect(array("action"=>"index"));
		}
	}
	
	function stats() {
		$top = 100;
		if (isset($this->params["requested"])) { $top = 10; }
		$games = $this->Game->query("SELECT Game.game_id,Game.game_name,Stats.wins,Stats.points FROM CWF_games AS Game LEFT JOIN CWF_gVsg_random_stats AS Stats on Game.game_id = Stats.game_id ORDER BY Stats.points DESC LIMIT ".$top.";");
		if (isset($this->params["requested"])) { return $games; }
		$this->set("games",$games); # TOP 100
	}

}

?>