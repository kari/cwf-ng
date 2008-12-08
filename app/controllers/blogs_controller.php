<?php
class BlogsController extends AppController {
	var $name = 'Blogs';
	var $paginate = array(
	    # 'conditions' => array("download_status" => 0),
      'limit' => 15,
      # 'order' => array('post_date' => 'desc'),
			# 'recursive' => 1
	    );
	
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}
	
	function index() {        
		# $this->set('blogs', $this->Blog->find('all',array("order"=>"created DESC")));
		$this->set("blogs",$this->paginate("Blog"));    		
	}
	
	function view($id = null) {
		$this->set('blog', $this->Blog->read("",$id));
	}
	
	function add() {
		if (!empty($this->data)) {            
			if ($this->Blog->save($this->data)) {                
				$this->Session->setFlash('Your blog entry has been saved.');
				$this->redirect("/blogs");            
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
					$this->Session->setFlash('Your post has been updated.');
					$this->redirect("/blogs");
				}
			}
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/blogs");
		}
	}
	
}
?>