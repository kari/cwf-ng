<?php
class GroupsController extends AppController {
    var $name = 'Groups';

		function beforeFilter() {
			parent::beforeFilter();
		}
		
		function index() {
			$this->set("groups",$this->Group->find("all",array("conditions"=>array("Group.group_single_user"=>"0"))));
		}
		
		function edit($id = null) {
			if ($id == null) { $this->redirect("/groups"); }
			if (!empty($this->data)) {
				# $this->data["News"]["last_edit_time"] = date("Y-m-d H:i:s");
				if($this->Group->Action->saveAll($this->data["Action"])) {
			  	//Set a session flash message and redirect.
			    $this->Session->setFlash("Access rights saved!");
					# $this->set("formdata",$this->data);
			    # $this->redirect('/news');
				}
			}
			
			if ($id == 1) {
				$this->set("group",$this->Group->find("first"),array("conditions"=>array("Group.group_id"=>1)));
			} else {
				$this->set("group",$this->Group->find("first",array("conditions"=>array("Group.group_single_user"=>"0","Group.group_id"=>$id))));
			}
			$this->set("ACTIONS",$this->Group->Action->ACTIONS);
		}
}
?>