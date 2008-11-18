<?php

class PagesController extends AppController {
	var $name = 'Pages';
	var $helpers = array("html","javascript","text","time"); # probably should be put on AppController, because prototype/script.al.blah-tricks will be on all views?
	var $uses = array("News","Blog","Review","Game");
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("home","sitemap"));
	}
	
	function home() {
		$this->set("news",$this->News->find("all",array("order" => "post_date DESC","limit"=>10)));
		$this->set("blogs",$this->Blog->find("all",array("order" => "created DESC","limit"=>10)));
		$this->set("reviews",$this->Review->find("all",array("conditions" => "review_rating <> -99","order" => "added DESC","limit" => 5)));
		$this->set("games",$this->Game->find("all",array("conditions"=>array("download_status"=>0),"order" => "Game.game_id DESC","limit"=>10)));
		# $this->set('Auth',$this->Auth->user());
	}
	
	function sitemap() {
		# http://bakery.cakephp.org/articles/view/automatically-generate-dynamic-sitemaps
	}
	
	function status() {
		
	}
	
}

?>