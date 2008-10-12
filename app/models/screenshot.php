<?php
class Screenshot extends AppModel {
	var $name = 'Screenshot'; # PHP4 compatibility
	
	# var $useDbConfig = 'dev';
	
	# Custom DB/Model-mapping attributes
	# var $useTable = "game_specs";
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'screenshot_id';
	# var $displayField = 'OTHER';
	
	var $belongsTo = array("Submitter" => array("className" => "User", "foreignKey" => "screenshot_submitter_id","fields" => "username,user_id"),);
	
}
?>