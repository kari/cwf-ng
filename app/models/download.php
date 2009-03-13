<?php
class Download extends AppModel {
	var $name = 'Download'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	var $useTable = 'game_files';
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'file_id';
	var $displayField = 'download_link';
	
	# var $actsAs = array("Containable");
	
	# Relationships
	var $belongsTo = array(
		"Game" => array("fields" => "game_id,game_name,adult"), 
		"User" => array("className" => "User", "foreignKey" => "game_submitter_id","fields" => "username,user_id"),
		);
		
	# Validation
	var $validate = array(
		"download_link" => "notEmpty",
		"file_platform" => array("rule"=>array("between",0,4)),
		"package_type" => array("rule"=>array("between",0,4)),
		"game_submitter_id" => "notEmpty",
		"game_id" => "notEmpty",
		"size" => array("rule"=>array("comparison",">=",0)),
		);
	
	var $PLATFORM = array(
		0 => "Unknown",
		1 => "Windows",
		2 => "Linux",
		3 => "Mac OS X",
		4 => "Special"
	);
	
	var $TYPE = array(
		0 => "Unknown",
		1 => "Executable",
		2 => "Source",
		3 => "Installer",
		4 => "Other"
	);

}
?>