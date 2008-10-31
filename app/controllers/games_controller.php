<?php

class GamesController extends AppController {
	var $name = 'Games';
  # var $scaffold;
	var $paginate = array(
	    'conditions' => array("download_status" => 0),
      'limit' => 25,
      'order' => array('Game.game_name' => 'asc'),
			"fields" => array("game_name","game_id"),
			'recursive' => 0
	    );
	var $uses = array("Game","Download","Rating");
	
	var $helpers = array('Cache',"Number");
	
	# var $cacheAction = array("view/" => "1 day");

	function index() {        
		#$this->set('games', $this->Game->find('all',array("order"=>"Game.game_name","limit"=>25,"fields"=>array("game_name","game_id"))));
		$this->set("games",$this->paginate('Game'));	
	}
	
	function view($id = null) {
	  # FIXME we assume a valid and public id. 
	  
	  if ($id == null) { $this->cakeError('error404'); }
	  
		$this->Game->recursive = 2; # TODO: It'd be nice to limit this just to Review
		$this->Game->cacheQueries = true;
		$this->set('game', $this->Game->read("",$id)); # DL status and validity needs to be checked, custom finderquery.

		$this->set('LICENSE',$this->Game->LICENSE);
		$this->set('GENRE',$this->Game->GENRE);
		$this->set('OSYSTEM',$this->Game->OSYSTEM);
		$this->set("DL_TYPE",$this->Download->TYPE);
		$this->set("PLATFORM",$this->Download->PLATFORM);
		$this->set("RATING_TYPE",$this->Rating->TYPE);
		$this->set('ratings',$this->Rating->average_ratings($id)); # TODO: custom finderquery for Game model
		
	}
}

?>