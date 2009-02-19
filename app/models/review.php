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
	var $validate = array(
		"review_title" => array(
			"notEmpty" => array("rule" => "notEmpty"),
			"maxLength" => array("rule" => array("maxLength",160)),
			"minLength" => array("rule" => array("minLength",10))
			),
		"user_id" => "notEmpty",
		"validator_id" => "notEmpty",
		"review_text" => "notEmpty",
		"game_id" => "notEmpty",
		"review_rating" => array("inList",array(-99,0,1,2,3,4,5,6)),
		# "review_lang" => array("rule"=>array("inList",array("en","dk","fi")),"allowEmpty"=>true),
		);
}
?>