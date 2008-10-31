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
	
	var $belongsTo = array("User" => array("foreignKey"=>"poster_id","fields"=>"user_id,username"),
	"Editor" => array("className"=>"User","foreignKey"=>"edited_by","fields"=>"user_id,username"));

	
}
?>