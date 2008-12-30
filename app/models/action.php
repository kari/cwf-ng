<?php
class Action extends AppModel {
	var $name = 'Action'; # PHP4 compatibility
	
	var $useTable = "groups_actions";
	var $tablePrefix = "CWF_";
	var $displayField = "action_id";
	
	# Lists actions a certain group is allowed to perform on site.
	
	# Objects in the system.
	var $ACTIONS = array("worldnews","news","ratings","screenshots","tools","users","reviews","publishers","pages","blogs","comments","downloads","games","gvsg","interviews","guides","groups");	
}
?>