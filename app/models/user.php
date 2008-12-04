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
		"Game_Hunted" => array("className" => "Game","foreignKey" => "game_proposer_id","fields" => "game_id,game_name",'conditions' => array("download_status" => 0),"order"=>"Game_Hunted.created DESC")); 
	
	var $hasAndBelongsToMany = array(
	  "Group" => array("joinTable" => "phpbb_user_group", "foreignKey" => "user_id", "associationForeignKey" => "group_id","conditions"=>array("Group.group_single_user"=>"0","PhpbbUserGroup.user_pending"=>"0"),"fields"=>"group_id,group_name,group_description"));
	
	# This model SHOULD NOT add or remove users. These and most user info management should be left to phpbb
	
	function isAuthorized($user,$controller,$action) {
		$node = strtolower($controller."/".$action);
		$allow = $this->query("SELECT Action.allow FROM CWF_groups_actions AS Action LEFT JOIN phpbb_user_group AS UserGroup on UserGroup.group_id = Action.group_id Where user_id = '".$user["User"]["user_id"]."' AND allow = 1 AND action_id = '".$node."' LIMIT 1;");
		if (Set::check($allow,"0.Action.allow")) return true;
		return false;
	}
	
	# User also needs a hasRight($action) function, maybe with a relationship to Actions with custom finderQuery (taking just unique rights) (see isAuthorized for example finderQuery). Actions should also be available through $this->Group?
	 
}
?>