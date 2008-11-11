<?php
class Action extends AppModel {
	var $name = 'Action'; # PHP4 compatibility
	
	var $useTable = "groups_actions";
	var $tablePrefix = "CWF_";
	var $displayField = "action_id";
	
	# Lists actions a certain group is allowed to perform on site.
		
}
?>