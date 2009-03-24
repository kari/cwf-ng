<?php

class GamesController extends AppController {
	var $name = 'Games';

	var $paginate = array(
		"Game" => array(
	   	# 'conditions' => array("Game.download_status" => 0,"Genres.tools"=>0),
     	'limit' => 15,
     	'order' => array('Game.game_name' => 'asc',"Game.site_rating"=>"desc","Game.created"=>"desc","Game.year"=>"desc"),
			# "fields" => array("game_name","game_id"),
			#'recursive' => 1
			"contain"=>array("Screenshot","Rating","Genres","GameHunter","Specs")
			),
		"Comment" => array(
			"conditions" => array("Comment.validated"=>TRUE),
			"order" => array("Comment.created"=>"desc"),
			"limit" => 10)
			);
	var $uses = array("Game","Download","Rating");
	
	var $components = array('Recaptcha',"RequestHandler");
	var $helpers = array('Cache',"Number","Site","javascript");
	
	# var $cacheAction = array("view/" => "+1 hour","index" => "+1 hour");
	# FIXME: Recaptcha breaks view/ caching, POST/cookie filtering breaks indexing.

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view","random","top","get","flag"));
		$this->Auth->mapActions(array("queue"=>"admin"));
		$this->Recaptcha->publickey = Configure::read("Site.captcha_public_key"); 
		$this->Recaptcha->privatekey = Configure::read("Site.captcha_private_key");
	}

	function index() {
		if ($this->RequestHandler->isAtom()) {
			$this->layout = "datarss";
			$this->Game->contain(array("Genres.tools","Screenshot","Publisher","Rating"));
			$this->cacheAction = null;
			$this->set("games",$this->Game->find("all",array("conditions"=>array("download_status"=>0,"Genres.tools"=>0),"order" => "Game.created DESC","limit"=>30)));
		} else {
			$genres = $this->Game->GENRE;
			unset($genres["tools"]); # Do not show Tools.
			asort($genres);
			$this->set('GENRE',$genres);
			# $this->set("PLATFORM",$this->Download->PLATFORM);
			$osystem = $this->Game->OSYSTEM;
			asort($osystem);
			$this->set('OSYSTEM',$osystem);
			$conds = array("Game.download_status"=>0,"Genres.tools"=>0);
			# Check if set new filtering parameters
			if (!empty($this->data)) {
				if(!empty($this->data["Game"]["score"]) && ($this->data["Game"]["score"] >= 0 && $this->data["Game"]["score"] <= 6)) {
						$conds["Game.site_rating >="] = $this->data["Game"]["score"];
						$this->Session->write("Game.score",$this->data["Game"]["score"]);
				}	else {
					unset($this->data["Game"]["score"]);
					$this->Session->delete("Game.score");
				}
				if(!empty($this->data["Game"]["platform"]) && array_key_exists($this->data["Game"]["platform"],$osystem)) {
					$conds["Specs.".$this->data["Game"]["platform"]] = 1;
					$this->Session->write("Game.platform",$this->data["Game"]["platform"]);
				} else {
					unset($this->data["Game"]["platform"]);
					$this->Session->delete("Game.platform");
				}
				if(!empty($this->data["Game"]["genre"]) && array_key_exists($this->data["Game"]["genre"],$genres)) {
					$conds["Genres.".$this->data["Game"]["genre"]] = 1;
					$this->Session->write("Game.genre",$this->data["Game"]["genre"]);
				} else {
					unset($this->data["Game"]["genre"]);
					$this->Session->delete("Game.genre");
				}
			} else {
				# Read session variables
				if ($this->Session->check("Game.score")) $conds["Game.site_rating >="] = $this->Session->read("Game.score");
				if ($this->Session->check("Game.platform")) $conds["Specs.".$this->Session->read("Game.platform")] = 1;
				if ($this->Session->check("Game.genre")) $conds["Genres.".$this->Session->read("Game.genre")] = 1;
			}
			$this->set("conds",$conds);
			$this->set("games",$this->paginate('Game',$conds));
		}
	}
	
	function random($limit=1) {
		if (isset($this->params["requested"])) {
			if ($limit < 1) $limit = 1;
			if ($limit > 10) $limit = 10;
			$this->Game->recursive = 1;
			$findparams = array("conditions"=>array("download_status" => 0,"Genres.tools"=>0),'limit'=>$limit,"order"=>"rand()","contain"=>array("Screenshot","Publisher","Rating","Genres.tools"));
			if ($limit == 1) {
				return $this->Game->find("first",$findparams);
			} else {
				return $this->Game->find("all",$findparams);
			}
		}
		$this->cakeError("error404");
	}
	
	function top($by="download",$limit=10) {
		if (isset($this->params["requested"])) {
			$this->Game->recursive = 1;
			switch ($by) {
				case "download":
					$games = $this->Game->find("all",array("fields"=>array("Game.game_id","Game.download_count","Game.game_name"),"limit"=>$limit,"order"=>"Game.download_count DESC","conditions"=>array("download_status"=>0,"Genres.tools"=>0),"contain"=>array("Genres.tools")));
					break;
				case "rating":
					$games = $this->Game->query("SELECT Game.game_name, Game.game_id, AVG(Rating.rating_value) AS average_rating, COUNT(Rating.rating_value) AS vote_count FROM CWF_game_ratings AS Rating LEFT JOIN CWF_games AS Game ON Game.game_id = Rating.game_id LEFT JOIN CWF_game_genres AS Genres ON Game.genre_id = Genres.genre_id WHERE Rating.rating_type = 0 AND Genres.tools = 0 GROUP BY Rating.game_id, Rating.rating_type HAVING COUNT(Rating.rating_value) > 2");
					$games = array_slice(Set::sort($games,'{n}.0.average_rating',"desc"),0,$limit); #TOP ten.
					break;
				case "latest":
					$games = $this->Game->find("all",array("conditions"=>array("Game.download_status"=>0),"fields"=>array("Game.game_id","Game.game_name","Game.created"),"limit"=>$limit,"order"=>"Game.created DESC","conditions"=>array("download_status"=>0,"Genres.tools"=>0),"contain"=>array("Genres.tools")));
					break;
				default:
					$games = array();
					break;
			}
			return $games;
		}
		$this->cakeError("error404");
	}
	
	function get($id = null) {
		if ($id == null) { $this->cakeError('error404'); }
		$game = $this->Game->find("first",array("conditions"=>array("Game.download_status"=>0,"Game.game_id"=>$id),"contain"=>array("Screenshot","Publisher","Rating")));
		if (isset($this->params["requested"])) {
			if (!empty($game)) { 
				return $game;
			} else { 
				return false; 
			}
		}
		$this->cakeError('error404');
	}
	
	function view($id = null) {
	# FIXME: view decide if $id is a number (primary key) or slug (acidbomb-2-rearmament) and work accordingly. Same thing to all view-actions which'd benefit from friendly urls. 
	  if ($id == null) { $this->cakeError('error404'); }
		$this->Game->contain(array("Genres","GameProposer","GameHunter","Specs","Publisher","Review"=>array("User"),"Screenshot","Rating","Download"));
		# $this->Game->cacheQueries = true;
		$game = $this->Game->find("first",array("conditions"=>array("Game.download_status"=>0,"Game.game_id"=>$id)));
		if (empty($game)) { $this->cakeError("error404"); }
		if ($game["Genres"]["tools"] == 1) { $this->redirect("/tools/view/".$game["Game"]["game_id"]); } // Silent redirect to correct view.
		
		$this->set("game",$game);
		$this->set("comments",$this->paginate("Comment",array("Comment.game_id"=>$game["Game"]["game_id"])));
		$this->set('LICENSE',$this->Game->LICENSE);
		$this->set('GENRE',$this->Game->GENRE);
		$this->set('OSYSTEM',$this->Game->OSYSTEM);
		$this->set("DL_TYPE",$this->Download->TYPE);
		$this->set("PLATFORM",$this->Download->PLATFORM);
		$this->set("RATING_TYPE",$this->Rating->TYPE);
		
		# Caching variables... FIXME.
		$this->data["cached_RATING_TYPE"] = $this->Rating->TYPE;
		$this->data["cached_game_id"] = $id;

		$ratings = array(); # Rewriting arrays for better traversal in foreach loops.
		foreach ($game["Rating"] as $rating) {
		  $ratings[$rating["rating_type"]]["average_rating"] = $rating["Rating"][0]["average_rating"];
		  $ratings[$rating["rating_type"]]["vote_count"] = $rating["Rating"][0]["vote_count"];
		}
		$this->data["cached_ratings"] = $ratings;
#		$this->set("user_ratings",$this->Rating->find("all",array("conditions"=>array("user_id"=>$this->Auth->user("user_id"),"game_id"=>$id))));
#		$this->set("user_id",$this->Auth->user("user_id"));

	# Check if user has downloaded this game and hasn't written a review yet.
	# Check if we have a logged in user
		$this->set("review_notify",false);
		if ($this->Auth->user()) {
		# Check if query "SELECT reviews.id FROM reviews LEFT JOIN downloads ON game_id WHERE user_id = loggedinuser" returns empty.
			$review_notify = $this->Game->query("SELECT stats.date < NOW() - INTERVAL 1 DAY AS notify FROM CWF_download_stats AS stats LEFT JOIN CWF_reviews AS review ON (stats.gameid = review.game_id AND review.user_id = stats.user_id) WHERE stats.user_id = ".$this->Auth->user("user_id")." AND stats.gameid = ".$game["Game"]["game_id"]." AND review.review_id IS NULL ORDER BY stats.date DESC LIMIT 1;"); # Find if the latest download for this game, for which there is no review written by the logged in user, happened at least a day ago. This statement puts BI tools to shame.
			if (!empty($review_notify)) {
				$this->set("review_notify",true);
			}
			# debug($review_notify);
		} else {
			
		}
	}	

	
	function edit($id = null) {
		$this->Game->contain(array("Publisher","Screenshot","Download","Specs","Genres"));
		if (!empty($this->data)) {
			if ($this->Game->saveAll($this->data,array("validate"=>"first"))) {
				$this->Session->setFlash("Game changes saved.");
				$this->data = $this->Game->find("first",array("conditions"=>array("Game.game_id"=>$id))); // FIXME: Otherwise doesn't load publisher, screenshots, etc.
			} else {
				$this->Session->setFlash("There were validation errors");
				# debug($this->Game->invalidFields());
				$old_data = $this->Game->find("first",array("conditions"=>array("Game.game_id"=>$id)));
				$this->data = Set::merge($old_data,$this->data); // FIXME: Otherwise doesn't load publisher, screenshots, etc. AND keep validation errors.
			}
		} else {
			$game = $this->Game->find("first",array("conditions"=>array("Game.game_id"=>$id)));
			if (empty($game)) { $this->cakeError("error404"); }
			$this->data = $game;	
		}		
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
	
	function admin() {
		$this->paginate["Game"]["contain"] = array("Genres","GameProposer","GameHunter","Specs","Publisher","Screenshot","Download");
		$this->paginate["Game"]["limit"] = 30;
		$this->paginate["Game"]["order"] = array("Game.created"=>"desc");
		$conds = array();
		if (!empty($this->passedArgs["status"])) {
			switch($this->passedArgs["status"]) {
				case 1:
				$conds["download_status"] = 0;
				break;
				case 2:
				$conds["download_status"] = -1;
				break;
				case 3:
				$conds["download_status >"] = 0;
				break;
				default:
			}
		}
		$this->set("games",$this->paginate("Game",$conds));
		$this->set('DL_STATUS',$this->Game->DL_STATUS);	
		$this->set("allgames",$this->Game->find("list",array("contain"=>array(),"fields"=>array("Game.game_id","Game.game_name"),"order"=>"Game.game_name")));
	}
	
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
	
	function delete($id=null) { # FIXME: Fix dependencies to delete also dependent models.
		if ($id == null) { $this->redirect("/"); }
		$game = $this->Game->find("first",array("conditions"=>array("Game.game_id"=>$id)));
		if (!empty($game)) {
			$this->Game->del($id);
			$this->flash('The game with id '.$id.' has been deleted.', '/games/queue');
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/games/queue");
		}
	}
	
	function flag($id = null) {
		if ($id == null) { $this->redirect("/"); }
		$game = $this->Game->find("first",array("conditions"=>array("Game.game_id"=>$id)));
		if (empty($game)) { $this->redirect("/"); }
		$this->set("game",$game);
			
	}
}

?>