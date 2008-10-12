<?php

class PagesController extends AppController {
	var $name = 'Pages';
	var $helpers = array("html","javascript"); # probably should be put on AppController, because prototype/script.al.blah-tricks will be on all views?
			
	function home() {
		
	}
	
	function gh() {
	
		$this->layout = 'gh';
		$this->pageTitle = "Gamehippo";
	}
}

?>