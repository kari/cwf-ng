<?php
class BlogsController extends AppController {
	var $name = 'Blogs';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny("*");
		$this->Auth->allow(array("index","view"));
	}
	
	function index() {        
		$this->set('blogs', $this->Blog->find('all'));    		
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
	
	function delete($id) {    
		$this->Blog->del($id);    
		$this->flash('The blog with id: '.$id.' has been deleted.', '/blogs');
	}
	
	function edit($id = null) {
		$this->Blog->id = $id;
		if (empty($this->data)) {
			$this->data = $this->Blog->read();
		} else {
			if ($this->Blog->save($this->data)) {
				$this->flash('Your post has been updated.','/blogs');
			}
		}
	}
	
	
}
?>