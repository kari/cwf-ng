<?php
class Blog extends AppModel {
	var $name = 'Blog'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	var $useTable = 'blog_entries';
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'entry_id';
	var $displayField = 'title';
	var $order = "created DESC";
	
	# Relationships
	var $belongsTo = array('User' => array("fields" => "username,user_id"));
	
	# Validation
	var $validate = array(        
		'title' => array(
			"notEmpty" => array("rule" => "notEmpty"),
			"maxLength" => array("rule" => array("maxLength",160)),
			"minLength" => array("rule" => array("minLength",3))
			),
	  'content' => "notEmpty",
		'user_id' => array("rule"=>"numeric","allowEmpty"=>false),
	);
	

	
}
?>