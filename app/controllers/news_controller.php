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
	var $helpers = array("Time");
	var $uses = array("News","User");
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny("*");
		$this->Auth->allow(array("index","view"));
	}
	
	function index() {
		$this->set("news",$this->paginate("News"));
	}
	
	function view($id = null) {
		$this->set("news",$this->News->findByNews_id($id));
	}
	
	function add() {
		if (!empty($this->data)) {
			if($this->News->save($this->data)) {
				$this->Session->setFlash("News added.");
				$this->redirect("/news");
			}
		}
		$this->set("user_id",$this->Auth->user("user_id"));
	}
	
	function edit($id=null) {
		if (!empty($this->data)) {
			if($this->News->save($this->data)) {
		  	//Set a session flash message and redirect.
		    $this->Session->setFlash("News Saved!");
		    $this->redirect('/news');
			}
		}
		$this->data = $this->News->findByNews_id($id);
		$this->set("user_id",$this->Auth->user("user_id"));
		$this->set("users",$this->User->find('list',array("fields"=>"user_id,username","order"=>"username"))); # FIXME: should only list users with relevant access level?
	}
	
}

?>