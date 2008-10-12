<?php
class Download extends AppModel {
	var $name = 'Download'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	var $useTable = 'game_files';
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'file_id';
	var $displayField = 'download_link';
	
	# Relationships
	var $belongsTo = array(
		"Game" => array("fields" => "game_id,game_name"), 
		"Game_Submitter" => array("className" => "User", "foreignKey" => "game_submitter_id","fields" => "username,user_id"),
		);
		
	# Validation
	
	# See Cookbook's View for Media view and downloads
	var $PLATFORM = array(0 => "Unknown",
	1 => "Windows",
	2 => "Linux",
	3 => "Mac",
	4 => "Special");
	
	var $TYPE = array(0 => "Unknown",
	1 => "Executable",
	2 => "Source",
	3 => "Installer",
	4 => "Other");
}
?>