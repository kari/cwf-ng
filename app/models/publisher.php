<?php
class Publisher extends AppModel {
	var $name = 'Publisher'; # PHP4 compatibility
	
	# var $useDbConfig = 'dev';
	
	# Custom DB/Model-mapping attributes
	# var $useTable = "publishers";
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'publisher_id';
	# var $displayField = 'name';
	var $order = "name";
	
	var $hasMany = array("Game");
}
?>