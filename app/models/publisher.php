<?php
class Publisher extends AppModel {
	var $name = 'Publisher'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'publisher_id';
	var $order = "name";
	var $actsAs = array("Containable");
	
	var $hasMany = array("Game" => array("order"=>"game_name ASC"),"Interview" => array("foreignKey"=>"developer_id"));
	
	var $validate = array(
		"name" => "notEmpty",
		"site" => array(
			"url"=>array("rule"=>"url","allowEmpty"=>true,"message"=>"Please enter a valid URL or leave empty."),
			"custom"=>array("rule"=>array("custom","/^http\:\/\/.+/i"),"message"=>"URL must begin with \"http://\"")),
		"email" => array("rule"=>"email","allowEmpty"=>true,"message"=>"Please enter a valid e-mail address, or leave this empty."), # Note: E-mail MUST be hidden (from spambots) when shown publicly.
		);
}
?>