<?php
class Game extends AppModel {
	var $name = 'Game'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	# var $useTable = 'blog_entries';
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'game_id';
	var $displayField = 'game_name';
	
	var $oder = "game_name DESC";
	
	# Validation
	
	# Relationships
	var $hasMany = array(
	  'Review' => array("conditions" => "review_rating <> -99","order" => "added DESC","limit" => 5), # TODO: we also need the reviewer's names. But how?
	  "Comment" => array("limit" => 5),
	  "Download",
	  "Rating", # TODO: needs a custom finderquery but no idea how to make it work.
	  # => array("className" => "User", "finderQuery" => 'SELECT AVG(rating_value) AS average_rating,COUNT(rating_value) AS vote_count FROM Chroell_Forum.CWF_game_ratings AS Rating WHERE game_id = {$__cakeID__$} GROUP BY rating_type'),
	  "Screenshot" => array("order" => "screenshot_id ASC"));
	
	var $belongsTo = array(
	  "GameProposer" => array("className" => "User", "foreignKey" => "game_proposer_id","fields" => "username,user_id"),
	  "GameHunter" => array("className" => "User", "foreignKey" => "game_hunter_id","fields" => "username,user_id"),
	  "Specs" => array("className" => "Specs", "foreignKey" => "specs_id"),
	  "Genres" => array("className" => "Genres", "foreignKey" => "genre_id"),
	  "Publisher"
	);
	
	
	# Constants
	var $OSYSTEM = array("OS_dos" => "DOS",
  "OS_95" => "Windows 95",
  "OS_98" => "Windows 98",
  "OS_2k" => "Windows 2000",
  "OS_XP" => "Windows XP",
  "OS_vista" => "Windows Vista",
  "OS_DosBox" => "DosBox",
  "OS_mac" => "Mac OS X",
  "OS_linux" => "Linux");
  
  var $GENRE = array("platform" => "Platform",
  "logipuzz" => "Logic/Puzzle",
  "firstshoot" => "1st Person Shooter",
  "act3d" => "3D Action",
  "adult" => "Adult",
  "beatemup" => "Beat'em up",
  "sports" => "Sports",
  "simulation" => "Simulation",
  "managing" => "Managing",
  "boardgame" => "Board game",
  "flying" => "Flying",
  "sidescroller" => "Sidescroller",
  "arcade" => "Arcade",
  "tbs" => "Turn Based Strategy",
  "rts" => "Real Time Strategy",
  "pointandclick" => "Point and Click",
  "adventure" => "Adventure",
  "misc" => "Misc",
  "RPG" => "RPG",
  "driving" => "Driving",
  "remake" => "Remake",
  "tools" => "Tools",
  "Action" => "Action",
  "ShootemUp" => "Shoot'em Up"
  );
	
	var $LICENSE = array(0 => "Freeware (GPL)",
	1 => "Freeware",
	2 => "Shareware",
	3 => "Special permission");
	
	var $DL_STATUS = array(0 => "Accepted for DL",
	-1 => "Not validated",
	2 => "Not accepted",
	3 => "Unknown",
	-666 => "Remove!",
	-665 => "Removed",
	);
		
	function index() {
	  $conditions = array("download_status" => 0);
		$this->set('games', $this->Game->find('list',array("conditions"=>$conditions)));
	}
	
	function view($id = null) {
	  $conditions = array("download_status" => 0, "game_id" => $id);
	  $this->set('game', $this->Game->find('first',array("conditions"=>$conditions)));
	}
	
	function getRandom($amount = 1) {
		$conditions = array("download_status" => 0);
		return $this->find('all',array("conditions"=>$conditions,'limit'=>$amount,"order"=>"rand()"));
	}
}
?>