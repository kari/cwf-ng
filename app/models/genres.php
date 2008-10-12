<?php
class Genres extends AppModel {
	var $name = 'Genres'; # PHP4 compatibility
	
	# var $useDbConfig = 'dev';
	
	# Custom DB/Model-mapping attributes
	var $useTable = "game_genres";
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'genre_id';
	var $displayField = 'genre_id';
		
}
?>