<?php
class Specs extends AppModel {
	var $name = 'Specs'; # PHP4 compatibility
	
	# var $useDbConfig = 'dev';
	
	# Custom DB/Model-mapping attributes
	var $useTable = "game_specs";
	var $tablePrefix = 'CWF_';
	var $primaryKey = 'specs_id';
	# var $displayField = 'OTHER';
		
}
?>