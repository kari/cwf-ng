<?php
class BlogsController extends AppController {
	var $name = 'Blogs';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}
	
	function index() {        
		$this->set('blogs', $this->Blog->find('all',array("order"=>"created DESC")));    		
	}
	
	function view($id = null) {
		$this->set('blog', $this->Blog->read("",$id));
	}
	
	function add() {
		if (!empty($this->data)) {            
			if ($this->Blog->save($this->data)) {                
				$this->flash('Your blog entry has been saved.', '/blogs');            
			}        
		}    
	}
	
	function delete($id=null) {
		$blog = $this->Blog->find("first",array("conditions"=>array("Blog.entry_id"=>$id,"Blog.user_id"=>$this->Auth->user("user_id"))));
		if (!empty($blog)) {
			$this->Blog->del($id);
			$this->flash('The blog with id '.$id.' has been deleted.', '/blogs');
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/blogs");
		}
	}
	
	function edit($id = null) { # FIXME: Edit only own.
		$blog = $this->Blog->find("first",array("conditions"=>array("Blog.entry_id"=>$id,"Blog.user_id"=>$this->Auth->user("user_id"))));
		if (!empty($blog)) {
			if (empty($this->data)) {
				$this->data = $blog;
			} else {
				if ($this->Blog->save($this->data)) {
					$this->flash('Your post has been updated.','/blogs');
				}
			}
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/blogs");
		}
	}
	
}
?>