<?php
class GvsgVote extends AppModel {
	var $name = 'GvsgVote'; # PHP4 compatibility
	
	var $useTable = "gVsg_random_votes";
	var $tablePrefix = "CWF_";
	var $displayField = "winner";
	var $primaryKey = "vote_id";

		
}
?>