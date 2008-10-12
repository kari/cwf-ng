<?php
class Page extends AppModel {
	var $name = 'Page'; # PHP4 compatibility
	
	var $useDbConfig = 'dev';
	
	# Custom DB/Model-mapping attributes
	# var $useTable = false;
	var $tablePrefix = '';
	var $primaryKey = 'id';
	var $displayField = 'title';
			
	function index() {        
		$this->set('pages', $this->Page->find('all'));
	}
	
}
?>