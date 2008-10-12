<?php
class Review extends AppModel {
	var $name = 'Review'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	# var $useTable = 'blog_entries';
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'review_id';
	var $displayField = 'review_title';
	
	# Relationships
	var $belongsTo = array(
	  'User' => array("fields" => "user_id,username","foreignKey" => "user_id"),
	  "Game" => array("fields" => "game_id,game_name","foreignKey" => "game_id"), 
	  "Validator" => array("className" => "User", "foreignKey" => "validator_id","fields" => "username,user_id"));
		
	# Validation	
	
}
?>