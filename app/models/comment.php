<?php
class Comment extends AppModel {
	var $name = 'Comment'; # PHP4 compatibility
	

	# Custom DB/Model-mapping attributes
	var $useTable = 'game_comments';
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'comment_id';
	var $displayField = 'title';
	
	# Relationships
	var $belongsTo = array('User' => array("foreignKey"=>"user_id","fields"=>"user_id,username"),"Game"=>array("foreignKey"=>"game_id","fields"=>"game_id,game_name"));
		
	# Validation
	var $validate = array(        
		'title' => "notEmpty",
	  'text' => "notEmpty",
		# 'user_id' => "notEmpty",
	);
	
	
}
?>