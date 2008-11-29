<?php

class GamesController extends AppController {
	var $name = 'Games';
  # var $scaffold;
	var $paginate = array(
	    'conditions' => array("Game.download_status" => 0,"Genres.tools"=>0),
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
		$this->set("games",$this->paginate('Game'));	
	}
	
	function random($limit=1) {
		if (isset($this->params["requested"])) {
			if ($limit < 1) $limit = 1;
			if ($limit > 10) $limit = 10;
			$this->Game->recursive = 1;
			return $this->Game->getRandom($limit);	# For Spotlights-element.
		}
		$this->cakeError("error404");
	}
	
	function top($by="download",$limit=10) {
		if (isset($this->params["requested"])) {
			$this->Game->recursive = 0;
			switch ($by) {
				case "download":
					$games = $this->Game->find("all",array("fields"=>array("Game.game_id","Game.download_count","Game.game_name"),"limit"=>$limit,"order"=>"Game.download_count DESC"));
					break;
				case "rating":
					# FIXME: lists Tools. ...LEFT JOIN CWF_games_genres AS Genre ON ... WHERE Genre.Tools = 0...
					$games = $this->Game->query("SELECT Game.game_name, Game.game_id, AVG(Rating.rating_value) AS average_rating, COUNT(Rating.rating_value) AS vote_count FROM CWF_game_ratings AS Rating LEFT JOIN CWF_games AS Game ON Game.game_id = Rating.game_id WHERE Rating.rating_type = 0 GROUP BY Rating.game_id, Rating.rating_type HAVING COUNT(Rating.rating_value) > 2");
					$games = array_slice(Set::sort($games,'{n}.0.average_rating',"desc"),0,$limit); #TOP ten.
					break;
				case "latest":
					$games = $this->Game->find("all",array("conditions"=>array("Game.download_status"=>0),"fields"=>array("Game.game_id","Game.game_name","Game.created"),"limit"=>$limit,"order"=>"Game.created DESC"));
					break;
				default:
					$games = array();
					break;
			}
			return $games;
		}
		$this->cakeError("error404");
	}
	
	function view($id = null) {
	# FIXME: view decide if $id is a number (primary key) or slug (acidbomb-2-rearmament) and work accordingly. Same thing to all view-actions which'd benefit from friendly urls. 
	  if ($id == null) { $this->cakeError('error404'); }
	  
		$this->Game->recursive = 2; # TODO: It'd be nice to limit this just to Review and Comment, with caching, who cares?
		$this->Game->cacheQueries = true;
		$game = $this->Game->find("first",array("conditions"=>array("Game.download_status"=>0,"Game.game_id"=>$id,"Genres.tools"=>0)));
		if (empty($game)) { $this->cakeError("error404"); }
		
		$this->set("game",$game);
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
	
/*	function delete($id = null) {
		# Delete the game. Should set dependencies at model level, too.
	} */
	
	function queue() {
		# GH voting and validation.
		if (!empty($this->data)) {
			# Err... or should we post to game/edit instead?
		}
		$this->set("games",$this->Game->find("all",array("conditions"=>array("Game.download_status <>"=>0),"order"=>"download_status,game_name")));
		$this->set("gameProposers",$this->Game->GameProposer->find('list'));
		$this->set("gameHunters",$this->Game->GameHunter->find('list'));
		$this->set("publishers",$this->Game->Publisher->find('list'));
		$this->set('LICENSE',$this->Game->LICENSE);
		$this->set('GENRE',$this->Game->GENRE);
		$this->set('OSYSTEM',$this->Game->OSYSTEM);
		$this->set('DL_STATUS',$this->Game->DL_STATUS);	
		
	}
}

?>