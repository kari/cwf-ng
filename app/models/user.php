<?php
class User extends AppModel {
	var $name = 'User'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	# var $useTable = 'users';
	var $tablePrefix = 'phpbb_';
	var $primaryKey = 'user_id';
	var $displayField = 'username';
	var $order = "username";
	
	# Relationships
	var $hasMany = array(
		'Blog',
		"Comment",
		'Review' => array("conditions" => "review_rating <> -99","order" => "added DESC"),
		"Game_Proposed" => array("className" => "Game","foreignKey" => "game_proposer_id","fields" => "game_id,game_name",'conditions' => array("download_status" => 0),"order"=>"Game_Proposed.created DESC"),
		"Game_Hunted" => array("className" => "Game","foreignKey" => "game_hunter_id","fields" => "game_id,game_name",'conditions' => array("download_status" => 0),"order"=>"Game_Hunted.created DESC")); 
	
	var $hasAndBelongsToMany = array(
	  "Group" => array("joinTable" => "phpbb_user_group", "foreignKey" => "user_id", "associationForeignKey" => "group_id","conditions"=>array("Group.group_single_user"=>"0","PhpbbUserGroup.user_pending"=>"0"),"fields"=>"group_id,group_name,group_description"));
	
	# This model SHOULD NOT add or remove users. These and most user info management should be left to phpbb.
	
	function isAuthorized($user,$controller,$action) {
		# phpbb_groups.group_id = 1 (Anonymous) is used as a group for all users
		# for non-registered users, access rights are set at controller level
		
		if (!in_array($action,array("create","update","read","delete","admin"))) {
			return false;
		}
		
		if(!isset($user)) { return false; }
		
		$allow = $this->query("SELECT Action.".$action." FROM CWF_groups_actions AS Action LEFT JOIN phpbb_user_group AS UserGroup ON UserGroup.group_id = Action.group_id WHERE (user_id = ".$user["User"]["user_id"]." OR Action.group_id = 1) AND Action.action_id = '".strtolower($controller)."' AND Action.".$action." = 1 LIMIT 1;");
		if (!empty($allow)) return true;
		return false;
	}
	 
}
?>