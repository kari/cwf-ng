<?php

class GamesController extends AppController {
	var $name = 'Games';
  # var $scaffold;
	var $paginate = array(
	    'conditions' => array("Game.download_status" => 0,"Genres.tools"=>0),
      'limit' => 25,
      'order' => array('Game.game_name' => 'asc'),
			# "fields" => array("game_name","game_id"),
			'recursive' => 1
	    );
	var $uses = array("Game","Download","Rating");
	
	var $helpers = array('Cache',"Number","Site","javascript");
	
	# var $cacheAction = array("view/" => "1 day");

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}

	function index() {        
		#$this->set('games', $this->Game->find('all',array("order"=>"Game.game_name","limit"=>25,"fields"=>array("game_name","game_id"))));
		$this->set('GENRE',$this->Game->GENRE);
		$this->set("games",$this->paginate('Game'));	
	}
	
	function view($id = null) {
	  # FIXME we assume a valid and public id. 
	  if (($id == null) and (isset($this->params["requested"]))) {
			$this->Game->recursive = 1;
			return $this->Game->getRandom(1);	# For Spotlights-element.
		}
		
	  if ($id == null) { $this->cakeError('error404'); }
	  
		# $this->Game->recursive = 2; # TODO: It'd be nice to limit this just to Review
		$this->Game->cacheQueries = true;
		$this->set('game', $this->Game->read("",$id)); # DL status and validity needs to be checked, custom finderquery.

		$this->set('LICENSE',$this->Game->LICENSE);
		$this->set('GENRE',$this->Game->GENRE);
		$this->set('OSYSTEM',$this->Game->OSYSTEM);
		$this->set("DL_TYPE",$this->Download->TYPE);
		$this->set("PLATFORM",$this->Download->PLATFORM);
		$this->set("RATING_TYPE",$this->Rating->TYPE);
		$this->set("user_ratings",$this->Rating->find("all",array("conditions"=>array("user_id"=>$this->Auth->user("user_id"),"game_id"=>$this->Game->id))));
		 # $this->set("user_ratings",$this->Rating->find("all",array("conditions"=>array("user_id"=>81,"game_id"=>$this->Game->id))));
		$this->set("user_id",$this->Auth->user("user_id"));
		
	}
	
	function edit($id = null) {
		if (!empty($this->data)) {
			if ($this->Game->saveAll($this->data,array("validate"=>"first"))) {
				$this->flash("Game changes saved.","");
			} else {
				$this->Session->setFlash("There were validation errors"); # FIXME: Validation errors are not visible!
			}
		}
		
		$this->data = $this->Game->read("",$id);
		$this->set("gameProposers",$this->Game->GameProposer->find('list'));
		$this->set("gameHunters",$this->Game->GameHunter->find('list'));
		$this->set("publishers",$this->Game->Publisher->find('list'));
		$this->set('LICENSE',$this->Game->LICENSE);
		$this->set('GENRE',$this->Game->GENRE);
		$this->set('OSYSTEM',$this->Game->OSYSTEM);
		$this->set('DL_STATUS',$this->Game->DL_STATUS);
		$this->set("DL_TYPE",$this->Download->TYPE);
		$this->set("PLATFORM",$this->Download->PLATFORM);		
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->Game->Specs->save($this->data);
			$this->data["Game"]["specs_id"] = $this->Game->Specs->id;
			$this->Game->Genres->save($this->data);
			$this->data["Game"]["genre_id"] = $this->Game->Genres->id;
			$this->Game->save($this->data);
			$this->flash("Game created.",array("action"=>"edit",$this->Game->id));
		}
		$this->set("gameProposers",$this->Game->GameProposer->find('list'));
		$this->set("gameHunters",$this->Game->GameHunter->find('list'));
		$this->set("publishers",$this->Game->Publisher->find('list'));
		$this->set('LICENSE',$this->Game->LICENSE);
		$this->set('GENRE',$this->Game->GENRE);
		$this->set('OSYSTEM',$this->Game->OSYSTEM);
		$this->set('DL_STATUS',$this->Game->DL_STATUS);
		
		$this->set("user_id",$this->Auth->user("user_id"));
	}
}

?>