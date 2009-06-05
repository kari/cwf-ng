<?php
class Action extends AppModel {
	var $name = 'Action'; # PHP4 compatibility
	
	var $useTable = "groups_actions";
	var $tablePrefix = "CWF_";
	var $displayField = "action_id";
	var $order = "action_id ASC";
	
	# Lists actions a certain group is allowed to perform on site.
	
	# Objects in the system.
	var $ACTIONS = array("worldnews","news","ratings","screenshots","tools","users","reviews","publishers","pages","blogs","comments","downloads","games","gvsg","interviews","guides","groups");
	
	var $validate = array(
		"action_id" => "notEmpty",
		"group_id" => "notEmpty",
		"create" => array("rule"=>array("inList",array(0,1))),
		"read" => array("rule"=>array("inList",array(0,1))),
		"update" => array("rule"=>array("inList",array(0,1))),
		"delete" => array("rule"=>array("inList",array(0,1))),
		"admin" => array("rule"=>array("inList",array(0,1))),
		);
}
?>