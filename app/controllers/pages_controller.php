<?php

class PagesController extends AppController {
	var $name = 'Pages';
	var $helpers = array("html","javascript","text","time","cache");
	var $uses = array("News","Blog","Review","Game","Interview","WorldNews");
	var $components = array("RequestHandler");
	
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
		$this->set("games",$this->Game->find("all",array("conditions"=>array("download_status"=>0),"order" => "Game.created DESC","limit"=>10,"contain"=>array("Screenshot","Publisher"))));
		$this->set("interviews",$this->Interview->find("all",array("limit"=>5)));
		$this->set("worldnews",$this->WorldNews->find("all",array("limit"=>5)));
		# $this->set('Auth',$this->Auth->user());
	}
	
	function sitemap() {
		$this->News->recursive = -1;
		$this->Blog->recursive = -1;
		$this->Game->recursive = -1;
		$this->Interview->recursive = -1;
		$this->WorldNews->recursive = -1;
		# see sitemapper.php for how to index phpbb2.
		# http://bakery.cakephp.org/articles/view/automatically-generate-dynamic-sitemaps
		if ($this->RequestHandler->isAtom() or $this->RequestHandler->isXML()) {
			# We get everything.
			$this->set("news",$this->News->find("all",array("fields"=>array("news_id","post_date","last_edit_time"))));
			$this->set("blogs",$this->Blog->find("all",array("fields"=>array("entry_id","modified"))));
			$this->set("reviews",$this->Review->find("all",array("conditions" => "review_rating <> -99","fields"=>array("review_id","added"))));
			$this->set("games",$this->Game->find("all",array("conditions"=>array("download_status"=>0),"fields"=>array("game_id","created"))));
			$this->set("interviews",$this->Interview->find("all",array("fields"=>array("interview_id","interview_date"))));
			$this->set("worldnews",$this->WorldNews->find("all",array("fields"=>array("wnews_id","wnews_date"))));
			# TODO: Add rest of objects.
			
		} else {
		# For HTML version, we only show structure with hand-painted HTML?
		}
		Configure::write ('debug', 0); 
	}
	
	function status() {
		
	}
	
	function admin() {
		
	}
	
}

?>