<?php
class Publisher extends AppModel {
	var $name = 'Publisher'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'publisher_id';
	var $order = "name";
	
	var $hasMany = array("Game","Interview" => array("foreignKey"=>"developer_id"));
	
	var $validate = array(
		"name" => "notEmpty",
		"site" => array("rule"=>"url", "allowEmpty"=>true),
		"email" => array("rule"=>"email","allowEmpty"=>true), # Note: E-mail MUST be hidden (from spambots) when shown publicly.
		);
}
?>