<?php

class GvsgController extends AppController {
	var $name = 'Gvsg';
  var $uses = array("Game");

	function vote() {
		if(!empty($this->data["gvsg"])) {
			# TODO: User has to be logged in.
			$winner = $this->Game->read("",$this->data["Game"][$this->data["gvsg"]["winner"]]["game_id"]);
			$loser = $this->Game->read("",$this->data["Game"][($this->data["gvsg"]["winner"] XOR 1)]["game_id"]); # loser is the opposite of winner. 1 xor 1 = 0, 0 xor 1 = 1. 
			
			
			
			$this->Session->setFlash("Your vote for ".$winner["Game"]["game_name"]." is counted. Thanks for playing!");
			# $this->redirect('/'); # or where-ever we did the vote
		}
		
		$this->Game->recursive = 1;
		$this->set("games",$this->Game->getRandom(2));
	}
	
	function stats() {
		$this->set("games",$this->Game->query("SELECT Game.game_id,Game.game_name,Stats.wins,Stats.points FROM CWF_games AS Game LEFT JOIN CWF_gVsg_random_stats AS Stats on Game.game_id = Stats.game_id ORDER BY Stats.points DESC LIMIT 100;"));
	}

}

?>