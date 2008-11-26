<?php
class Interview extends AppModel {
	var $name = 'Interview'; # PHP4 compatibility
	
	var $useTable = "interviews";
	var $tablePrefix = "CWF_";
	var $displayField = "interview_title";
	var $primaryKey = "interview_id";
	var $order = "interview_date DESC";
	
	var $belongsTo = array(
		"Publisher"=>array("className"=>"Publisher","foreignKey"=>"developer_id"),
		"Interviewer"=>array("className"=>"User","foreignKey"=>"interviewer_id"),
		"Game"=>array("foreignKey"=>"game_id")
		);

		
}
?>