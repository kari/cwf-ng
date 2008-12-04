<?php

class NewsController extends AppController {
	var $name = 'News';
	# var $scaffold;
	var $paginate = array(
	    # 'conditions' => array("download_status" => 0),
      'limit' => 25,
      'order' => array('post_date' => 'desc'),
			# 'recursive' => 1
	    );
	var $helpers = array("Time","Cache");
	var $uses = array("News","User");
	var $cacheAction = "+1 day";
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}
	
	function index() {
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
				$this->redirect("/news");
			}
		}
		$this->set("user_id",$this->Auth->user("user_id"));
	}
	
	function edit($id=null) { # news/edit allows to edit all news.
		if (!empty($this->data)) {
			$this->data["News"]["last_edit_time"] = date("Y-m-d H:i:s");
			if($this->News->save($this->data)) {
		  	//Set a session flash message and redirect.
		    $this->Session->setFlash("News Saved!");
		    $this->redirect('/news');
			}
		}
		$this->data = $this->News->findByNews_id($id);
		$this->set("user_id",$this->Auth->user("user_id"));
		$this->set("posters",$this->News->User->find('list')); # FIXME: should only list users with relevant access level?
	}
	
}

?>