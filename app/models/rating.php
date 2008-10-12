<?php
class Rating extends AppModel {
	var $name = 'Rating'; # PHP4 compatibility
	
	# var $useDbConfig = 'dev';
	
	# Custom DB/Model-mapping attributes
	var $useTable = "game_ratings";
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'vote_id';
	var $displayField = 'rating_value';

  var $TYPE = array(0 => "Overall",
  1 => "Playability",
  2 => "Idea",
  3 => "Technical",
  4 => "Graphics",
  5 => "Music",
  6 => "Extras");
  
# rating_type:
# 	'GAME_OVERALL' => $all_votes[0], 
#	'GAME_PLAYABILITY' => $all_votes[1], 
#	'GAME_IDEA' => $all_votes[2], 
#	'GAME_TECHIMP' => $all_votes[3], 
#	'GAME_GRAPHICS' => $all_votes[4], 
#	'GAME_MUSIC' => $all_votes[5], 
#	'GAME_EXTRAS' => $all_votes[6],		

  function average_ratings($id = null) {
    #return $this->query("SELECT game_id,rating_type,AVG(rating_value) AS average_rating,COUNT(rating_value) AS vote_count FROM Chroell_Forum.CWF_game_ratings AS Rating WHERE game_id = (".$id.") GROUP BY rating_type");
    return $this->find('all',array("conditions" => array("game_id" => $id),
      "fields" => array("AVG(rating_value) AS average_rating","COUNT(rating_value) AS vote_count"),
      "group" => array("rating_type"))); # "game_id","rating_type",
  }
}
?>