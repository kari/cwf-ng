<?php
class Screenshot extends AppModel {
	var $name = 'Screenshot'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	# var $useTable = "game_specs";
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'screenshot_id';
	# var $displayField = 'OTHER';
	
	var $belongsTo = array(
		"User" => array("className" => "User", "foreignKey" => "screenshot_submitter_id","fields" => "username,user_id"),
		"Game" => array("fields"=>"game_id,game_name")
		);
	
	var $validate = array(
		"game_id" => "notEmpty",
		"image_link" => array(
			"notEmpty" => array("rule"=>"notEmpty"),
			"extension" => array("rule"=>array("extension",array("png","jpg","gif","jpeg")))
			),
		"screenshot_submitter_id" => "notEmpty",
		);
	
}
?>