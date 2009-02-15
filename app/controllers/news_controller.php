<?php

class NewsController extends AppController {
	var $name = 'News';

	var $paginate = array(
	    # 'conditions' => array("download_status" => 0),
      'limit' => 15,
      'order' => array('News.post_date' => 'desc'),
			# 'recursive' => 1
	    );
	var $helpers = array("Time","Cache");
	var $components = array("RequestHandler");
	var $uses = array("News","User");
	var $cacheAction = array("index"=>"+1 day","view/"=>"+1 day");
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}
	
	function index() {
		if ($this->RequestHandler->isAtom()) {
			$this->set("news",$this->News->find("all",array("order"=>array("News.post_date"=>"desc"),"limit"=>30)));
		} else {
			$this->set("news",$this->paginate("News"));
		}
	}
	
	function admin() {
		$this->set("news",$this->paginate("News"));
	}
	
	function view($id = null) {
		if ($id == null) { $this->cakeError("error404"); }
		$news = $this->News->findByNews_id($id);
		if (empty($news)) { $this->cakeError("error404"); }
		$this->set("news",$news);
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->data["News"]["post_date"] = date("Y-m-d H:i:s");
			if($this->News->save($this->data)) {
				$this->Session->setFlash("News added.");
				$this->redirect(array("action"=>"view",$this->News->id));
			}
		}
		$this->set("user_id",$this->Auth->user("user_id"));
	}
	
	function edit($id=null) { # news/edit allows to edit all news.
		if ($id == null) { $this->redirect("/news"); }
		if (!empty($this->data)) {
			$this->data["News"]["last_edit_time"] = date("Y-m-d H:i:s");
			if($this->News->save($this->data)) {
		  	//Set a session flash message and redirect.
		    $this->Session->setFlash("News Saved!");
		    $this->redirect('/news');
			} else {
				$this->Session->setFlash("Unable to save.");
			}
		} else {
			# In else-block because otherwise unsaved form info is lost.
			$this->data = $this->News->findByNews_id($id); # FIXME: we don't check this actually exists.
		}
		$this->set("user_id",$this->Auth->user("user_id"));
		$this->set("posters",$this->News->User->find('list')); # FIXME: should only list users with relevant access level?
	}
	
	function delete($id=null) { # news/delete allows to delete all news.
		if ($id == null) { $this->redirect("/news"); }
		$news = $this->News->find("first",array("conditions"=>array("news_id"=>$id)));
		if (!empty($news)) {
			$this->News->del($id);
			$this->flash('The news item with id '.$id.' has been deleted.', '/news');
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/news");
		}
		
	}
	
}

?>