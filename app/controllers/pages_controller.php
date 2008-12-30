<?php

class PagesController extends AppController {
	var $name = 'Pages';
	var $helpers = array("html","javascript","text","time","cache");
	var $uses = array("News","Blog","Review","Game","Interview","WorldNews");
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("home","sitemap"));
		$this->Auth->mapActions(array("status"=>"admin","admin"=>"admin"));
	}
	
	function home() {
		$this->cacheAction = "+1 hour";
		$this->set("news",$this->News->find("all",array("order" => "post_date DESC","limit"=>5)));
		$this->set("blogs",$this->Blog->find("all",array("order" => "created DESC","limit"=>10)));
		$this->set("reviews",$this->Review->find("all",array("conditions" => "review_rating <> -99","order" => "added DESC","limit" => 5)));
		$this->set("games",$this->Game->find("all",array("conditions"=>array("download_status"=>0),"order" => "Game.created DESC","limit"=>10)));
		$this->set("interviews",$this->Interview->find("all",array("limit"=>5)));
		$this->set("worldnews",$this->WorldNews->find("all",array("limit"=>5)));
		# $this->set('Auth',$this->Auth->user());
	}
	
	function sitemap() {
		# http://bakery.cakephp.org/articles/view/automatically-generate-dynamic-sitemaps
	}
	
	function status() {
		
	}
	
	function admin() {
		
	}
	
}

?>