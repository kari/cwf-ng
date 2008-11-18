<?php
class GvsgStats extends AppModel {
	var $name = 'GvsgStats'; # PHP4 compatibility
	
	var $useTable = "gVsg_random_stats";
	var $tablePrefix = "CWF_";
	var $displayField = "game_id";
	var $primaryKey = "vote_id";
	
		
}
?>