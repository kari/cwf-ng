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
		#'title' => array(
		#	"notEmpty" => array("rule" => "notEmpty"),
		#	"maxLength" => array("rule" => array("maxLength",100)),
		#	"minLength" => array("rule" => array("minLength",5))
		#	),
	  'text' => array(
			"notEmpty" => array("rule" => "notEmpty"),
			"maxLength" => array("rule" => array("maxLength",320)), # 2xSMS =)
			"minLength" => array("rule" => array("minLength",10))
			),
		'user_id' => "notEmpty",
	);
	
	
}
?>