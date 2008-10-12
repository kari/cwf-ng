<?php
class Group extends AppModel {
	var $name = 'Group'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	# var $useTable = 'group';
	var $tablePrefix = 'phpbb_';
	var $primaryKey = 'group_id';
	var $displayField = 'group_name';
	
	# Relationships
	var $belongsTo = array("Moderator"=>array("className"=>"User","foreignKey"=>"group_moderator","fields"=>"user_id,username"));
	
	# This model SHOULD NOT modify groups table.
	
}
?>