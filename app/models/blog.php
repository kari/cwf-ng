<?php
class Blog extends AppModel {
	var $name = 'Blog'; # PHP4 compatibility
	
	# Custom DB/Model-mapping attributes
	var $useTable = 'blog_entries';
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'entry_id';
	var $displayField = 'title';
	
	# Relationships
	var $belongsTo = array('User' => array("fields" => "username,user_id"));
	
	# Validation
	var $validate = array(        
		'title' => "notEmpty",
	  'content' => "notEmpty",
		'user_id' => array("rule"=>"numeric","allowEmpty"=>false),
	);
	

	
}
?>