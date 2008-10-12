<?php
class Comment extends AppModel {
	var $name = 'Comment'; # PHP4 compatibility
	
	var $useDbConfig = 'dev';
	
	# Custom DB/Model-mapping attributes
	# var $useTable = 'blog_entries';
	var $tablePrefix = '';
	var $primaryKey = 'id';
	var $displayField = 'id';
	
	# Relationships
	var $belongsTo = array('User',"Game");
		
	# Validation
	var $validate = array(        
		'title' => array('rule' => array('minLength', 1)),
	  'content' => array('rule' => array('minLength', 1)),
	);
	
	
}
?>