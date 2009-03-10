<?php

class PagesController extends AppController {
	var $name = 'Pages';
	var $helpers = array("html","javascript","text","time","cache");
	var $uses = array("News","Blog","Review","Game","Interview","WorldNews","Guide");
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
		$this->set("games",$this->Game->find("all",array("conditions"=>array("download_status"=>0),"order" => "Game.created DESC","limit"=>12,"contain"=>array("Screenshot","Publisher"))));
		$this->set("interviews",$this->Interview->find("all",array("limit"=>5)));
		$this->set("worldnews",$this->WorldNews->find("all",array("limit"=>5)));
		# $this->set('Auth',$this->Auth->user());
	}
	
	function sitemap() {
		$this->News->recursive = -1;
		$this->Blog->recursive = -1;
		$this->Interview->recursive = -1;
		$this->WorldNews->recursive = -1;
		$this->Review->recursive = -1;
		$this->Guide->recursive = -1;
		# see sitemapper.php for how to index phpbb2.
		# http://bakery.cakephp.org/articles/view/automatically-generate-dynamic-sitemaps
		if ($this->RequestHandler->isAtom() or $this->RequestHandler->isXML()) {
			# We get everything.
			$this->set("news",$this->News->find("all",array("fields"=>array("news_id","post_date","last_edit_time"))));
			$this->set("blogs",$this->Blog->find("all",array("fields"=>array("entry_id","modified"))));
			$this->set("reviews",$this->Review->find("all",array("conditions" => "review_rating <> -99","fields"=>array("review_id","added"))));
			$this->set("games",$this->Game->find("all",array("conditions"=>array("Genres.tools"=>0,"download_status"=>0),"fields"=>array("game_id","created"),"contain"=>array("Genres.tools"))));
			$this->set("tools",$this->Game->find("all",array("conditions"=>array("Genres.tools"=>1,"download_status"=>0),"fields"=>array("game_id","created"),"contain"=>array("Genres.tools"))));
			$this->set("interviews",$this->Interview->find("all",array("fields"=>array("interview_id","interview_date"))));
			$this->set("worldnews",$this->WorldNews->find("all",array("fields"=>array("wnews_id","wnews_date"))));
			
			$this->set("reviews",$this->Review->find("all",array("conditions"=>array("review_rating >="=>0),"fields"=>array("review_id","added"))));
			
			$this->set("guides",$this->Guide->find("all",array("fields"=>array("id","created"))));
			
			$public_forums = array(34,33,32,18,16,27,17,19,24); # FIXME: Volatile. Needs a better way of discovery.
			$this->set("forums",$public_forums);
			$query = "SELECT Topic.topic_id, Topic.topic_time FROM phpbb_topics AS Topic WHERE Topic.forum_id IN (".implode(",",$public_forums).")"; # FIXME: No updated time and no paging.
			$this->set("topics",$this->Game->query($query));
			
		} else {
		# For HTML version, we only show structure with hand-painted HTML.
		}
		Configure::write ('debug', 0); 
	}
	
	function status() {
		
	}
	
	function admin() {
		
	}
	
}

?>