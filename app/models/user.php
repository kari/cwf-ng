<?php
class User extends AppModel {
	var $name = 'User'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	# var $useTable = 'users';
	var $tablePrefix = 'phpbb_';
	var $primaryKey = 'user_id';
	var $displayField = 'username';
	
	# Relationships
	var $hasMany = array('Blog',"Comment",
	'Review' => array("conditions" => "review_rating <> -99","order" => "added DESC"),
	"Game_Proposed" => array("className" => "Game","foreignKey" => "game_proposer_id","fields" => "game_id,game_name",'conditions' => array("download_status" => 0)),
	"Game_Hunted" => array("className" => "Game","foreignKey" => "game_proposer_id","fields" => "game_id,game_name",'conditions' => array("download_status" => 0))); 
	
	var $hasAndBelongsToMany = array(
	  "Group" => array("joinTable" => "phpbb_user_group", "foreignKey" => "user_id", "associationForeignKey" => "group_id","conditions"=>array("Group.group_single_user"=>"0","PhpbbUserGroup.user_pending"=>"0"),"fields"=>"group_id,group_name,group_description"));
	
	# This model SHOULD NOT add or remove users. These and most user info management should be left to phpbb
	
}
?>