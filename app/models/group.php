<?php
class Group extends AppModel {
	var $name = 'Group'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	# var $useTable = 'group';
	var $tablePrefix = 'phpbb_';
	var $primaryKey = 'group_id';
	var $displayField = 'group_name';
	var $order = "group_name ASC";
	
	# Relationships
	var $belongsTo = array("Moderator"=>array("className"=>"User","foreignKey"=>"group_moderator","fields"=>"user_id,username"));
	
	# Allowed actions for group, action_id is "controller"
	var $hasMany = array("Action"=>array("conditions"=>array()));
	
	var $hasAndBelongsToMany = array(
	  "User" => array("joinTable" => "phpbb_user_group", "foreignKey" => "group_id", "associationForeignKey" => "user_id","conditions"=>array("PhpbbUserGroup.user_pending"=>"0"),"fields"=>"user_id,username"));
	
	# This model SHOULD be read-only and SHOULD NOT modify groups table. 
	
	# phpbb_Groups
	# 2 Admin (single user, so not a group here.)
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
	# 	- phpbb should somehow assign all new users to a Member group.
	# ? Guest (not needed, public actions are set at controller)
	
}
?>