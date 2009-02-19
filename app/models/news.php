<?php
class News extends AppModel {
	var $name = 'News'; # PHP4 compatibility
	
	# var $useDbConfig = 'dev';
	
	# Custom DB/Model-mapping attributes
	var $useTable = "frontpage_news";
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'news_id';
	var $displayField = 'news_title';
	var $recursive = 0;
	
	var $order = "post_date DESC";
	
	var $belongsTo = array(
		"User" => array("foreignKey"=>"poster_id","fields"=>"user_id,username","order"=>"User.username"),
		"Editor" => array("className"=>"User","foreignKey"=>"edited_by","fields"=>"user_id,username","order"=>"Editor.username"));

	var $validate = array(
		"news_title" => "notEmpty",
		"news_text" => "notEmpty",
		"poster_id" => "notEmpty",
		"post_date" => "notEmpty", # FIXME: Could use "created" instead
		"edited_by" => array("rule" => "notEmpty", "on" => "update"), # When we update field, the editor and time must be known.
		"last_edit_time" => array("rule" => "notEmpty", "on" => "update")); # FIXME: Could use "modified" instead
}
?>