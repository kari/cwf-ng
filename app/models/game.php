<?php
class Game extends AppModel {
	var $name = 'Game'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	# var $useTable = 'blog_entries';
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'game_id';
	var $displayField = 'game_name';
	
	var $order = "game_name ASC";
	
	var $actsAs = array("Containable");
	
	# Validation
	var $validate = array(
		"game_name" => "notEmpty",
		"specs_id" => "notEmpty",
		"genre_id" => "notEmpty",
		"site_rating" => array("rule"=>"numeric","allowEmpty"=>false),
		"year" => array("rule"=>array("range",1900,3000)), # FIXME: possible Y3K problem.
		"site" => array("rule"=>"url","allowEmpty"=>true),
		"forum_link" => array("rule"=>"url","allowEmpty"=>true),
		);
	
	# Relationships
	var $hasMany = array(
		"Guide" => array("fields"=>"Guide.id,Guide.title"),
	  'Review' => array("fields"=>"Review.review_id,Review.review_title,Review.review_text,Review.user_id","conditions" => "review_rating <> -99","order" => "added DESC","limit" => 5),
	  "Comment" => array("limit" => 5,"order"=>"created DESC","conditions"=>array("validated"=>TRUE)),
	  "Download",
	  # "Rating", # FXIME: needs a custom finderquery but no idea how to make it work. Below a hack, which almost works.
	  "Screenshot" => array("order" => "screenshot_id ASC"),
		"Rating" => array("className" => "Rating", "finderQuery" => 'SELECT Rating.game_id,Rating.rating_type, AVG(Rating.rating_value) AS average_rating, COUNT(Rating.rating_value) AS vote_count FROM CWF_game_ratings AS Rating WHERE Rating.game_id IN ({$__cakeID__$}) GROUP BY Rating.game_id, Rating.rating_type ORDER BY Rating.game_id, Rating.rating_type', # Average ratings. For some reason, merges the ratings wrong, but at least it works.
		)); 
	
	var $hasOne = array("GvsgStats");
	
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
	-128 => "Remove!", # DB datatype tinyint.
	-127 => "Removed",
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
		# FIXME: Really slow (> 100 ms)
		# possible FIX: get all games and then choose $amount at random at application layer?
		$conditions = array("download_status" => 0,"Genres.tools"=>0);
		return $this->find('all',array("conditions"=>$conditions,'limit'=>$amount,"order"=>"rand()"));
	}
}

/* Notes:
Dates for games were created from earliest file associated with the game using following SQL:
UPDATE CWF_games,(SELECT game_id,MIN(uploaded) AS uploaded FROM CWF_game_files GROUP BY game_id) AS File SET CWF_games.created = File.uploaded WHERE CWF_games.game_id = File.game_id
*/
?>