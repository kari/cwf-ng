<?php
class WorldNews extends AppModel {
	var $name = 'WorldNews'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	var $useTable = "world_news";
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'wnews_id';
	var $displayField = 'wnews_title';
	var $recursive = 0;
	
	var $order = "wnews_date DESC";
	
	var $belongsTo = array(
		"User" => array("foreignKey"=>"wnews_adder","fields"=>"user_id,username","order"=>"User.username"));

	var $validate = array(
		"wnews_title" => "notEmpty",
		"wnews_text" => "notEmpty",
		"wnews_adder" => "notEmpty",
		"wnews_date" => "notEmpty");
	}
?>