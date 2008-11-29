<?php

class ToolsController extends AppController {
	# This is just a clone of the Games Controller. Internally games and tools are identical, but for display purposes there should be some distinction.
	var $name = 'Tools';
  # var $scaffold;
	var $paginate = array(
	    'conditions' => array("Game.download_status" => 0,"Genres.tools"=>1),
      'limit' => 15,
      'order' => array('Game.game_name' => 'asc'),
			# "fields" => array("game_name","game_id"),
			'recursive' => 1
	    );
	var $uses = array("Game","Download","Rating");
	
	var $helpers = array('Cache',"Number","Site","javascript");
	
	# var $cacheAction = array("view/" => "1 day");

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view","random","top"));
	}

	function index() {
		# FIXME: Do not fetch Reviews and Comments.
		# Remove those associations on the fly.
		#$this->set('games', $this->Game->find('all',array("order"=>"Game.game_name","limit"=>25,"fields"=>array("game_name","game_id"))));
		$this->set('GENRE',$this->Game->GENRE);
		$this->set("tools",$this->Game->find("all",array("conditions"=>array("Game.download_status" => 0,"Genres.tools"=>1))));	
	}

	function view($id = null) {
	# FIXME: view decide if $id is a number (primary key) or slug (acidbomb-2-rearmament) and work accordingly. Same thing to all view-actions which'd benefit from friendly urls. 
	  if ($id == null) { $this->cakeError('error404'); }
	  
		$this->Game->recursive = 2; # TODO: It'd be nice to limit this just to Review and Comment, with caching, who cares?
		$this->Game->cacheQueries = true;
		$tool = $this->Game->find("first",array("conditions"=>array("Game.download_status"=>0,"Game.game_id"=>$id,"Genres.tools"=>1)));
		if (empty($tool)) { $this->cakeError("error404"); }
		
		$this->set("tool",$tool);
		$this->set('LICENSE',$this->Game->LICENSE);
		$this->set('GENRE',$this->Game->GENRE);
		$this->set('OSYSTEM',$this->Game->OSYSTEM);
		$this->set("DL_TYPE",$this->Download->TYPE);
		$this->set("PLATFORM",$this->Download->PLATFORM);
		$this->set("RATING_TYPE",$this->Rating->TYPE);
		$this->set("user_ratings",$this->Rating->find("all",array("conditions"=>array("user_id"=>$this->Auth->user("user_id"),"game_id"=>$id))));
		 # $this->set("user_ratings",$this->Rating->find("all",array("conditions"=>array("user_id"=>81,"game_id"=>$this->Game->id))));
		$this->set("user_id",$this->Auth->user("user_id"));
		
	}
	
			
}

?>