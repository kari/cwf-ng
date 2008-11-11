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
	
	# Allowed actions for group, action_id is "controller/action"
	var $hasMany = array("Action"=>array("conditions"=>array("allow"=>true),"fields"=>"action_id"));
	
	# This model SHOULD NOT modify groups table.
	
	# Groups
	# 2 Admin (single user)
	# 9 Contributor
	# 14 CREW
	# 51 Game Hunter
	# 68 Coder
	# 69 Top Level
	# 99 Designers
	# 176 Testers
	# 268 Newsgroup
	# 
	# ? Member (needed)
	# ? Guest (not needed, public actions are set at controller)
	
}
?>