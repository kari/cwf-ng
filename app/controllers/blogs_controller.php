<?php
class BlogsController extends AppController {
	var $name = 'Blogs';
	var $paginate = array(
	    # 'conditions' => array("download_status" => 0),
      'limit' => 15,
      # 'order' => array('post_date' => 'desc'),
			# 'recursive' => 1
	    );
	var $helpers = array("cache");
	var $components = array("RequestHandler");
	
	var $cacheAction = array("view/" => "+1 hour","index" => "+1 hour");
	
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("index","view"));
	}
	
	function index($id = null) {
		if ($id == null) {        
			$this->set("blogs",$this->paginate("Blog"));
		} else {
			$user = $this->Blog->User->findByUser_id($id);
			$this->set("user",$user);
			if (empty($user)) { $this->cakeError("error404"); }
			if ($this->RequestHandler->isAtom()) {
				# $this->layout = "datarss";
				$this->cacheAction = null;
				$this->set("blogs",$this->Blog->find("all",array("conditions"=>array("Blog.user_id"=>$user["User"]["user_id"]),"limit"=>30)));
			} else {
				$this->set("blogs",$this->paginate("Blog",array("Blog.user_id"=>$user["User"]["user_id"])));
			}
		}
	}
	
	function admin() {
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
		$blog = $this->Blog->find("first",array("conditions"=>array("Blog.entry_id"=>$id)));
		if (!empty($blog) AND (($blog["Blog"]["user_id"] == $this->Auth->user("user_id")) OR $this->Blog->User->isAuthorized($this->Auth->user(),"blogs","admin"))) { # Object exists and it's either User's or User has Admin
			$this->Blog->del($id);
			$this->flash('The blog with id '.$id.' has been deleted.', '/blogs');
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/blogs");
		}
	}
	
	function edit($id = null) {
		$blog = $this->Blog->find("first",array("conditions"=>array("Blog.entry_id"=>$id)));
		if (!empty($blog)) {
			if ($blog["Blog"]["user_id"] == $this->Auth->user("user_id")) { # User's own content
				if (empty($this->data)) {
					$this->data = $blog;
				} else {
					if ($this->Blog->save($this->data)) {
						$this->Session->setFlash('Your post has been updated.');
						$this->redirect("/blogs");
					}
				}
			} elseif ($this->Blog->User->isAuthorized($this->Auth->user(),"blogs","admin")) { # User has Admin access on this controller
				if (empty($this->data)) {
					$this->data = $blog;
				} else {
					if ($this->Blog->save($this->data)) {
						$this->Session->setFlash('The post has been updated.');
						$this->redirect("/blogs/admin");
					}
				}
			} else { # No access
				$this->Session->setFlash($this->Auth->authError);
				$this->redirect("/blogs");
			}
		} else { # Invalid object ID
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/blogs");
		}
	}
	
}
?>