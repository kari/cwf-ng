<?php
class Guide extends AppModel {
	var $name = 'Guide'; # PHP4 compatibility
	
	var $useTable = "game_guides";
	var $tablePrefix = "CWF_";
	var $displayField = "title";
	var $primaryKey = "id";
	var $order = "Guide.created DESC";
	
	var $belongsTo = array("User"=>array("fields"=>"User.user_id,User.username"),"Game");
}
?>