<?php

class ScreenshotsController extends AppController {
	var $name = 'Screenshots';
  # var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		# $this->Auth->allow(array("index","view"));
	}
	
	function add($id = null) {
		$this->log("Hit screenshots/add controller",LOG_DEBUG);
		if (!empty($this->data)) {
			$this->log("Seems like we have some POST data...",LOG_DEBUG);
			$valid_mime = array("image/png"); # Valid MIME types for uploads
			$path = Configure::read("Site.screenshot_path");
			
			if (empty($this->data["Screenshot"]["image"])) {
				$this->Session->setFlash("Upload failed.");
				$this->redirect($this->referer());
			}

			switch ($this->data["Screenshot"]["image"]["error"]) {
				case 0:
				# No error
					break;
				case 1:
					$this->Session->setFlash("File exceedes maximum size.");
					# FIXME: cleanup?
					$this->redirect($this->referer());
				case 3:
					# FIXME: cleanup?
				case 4:
					$this->Session->setFlash("Did not receive file completely.");
					$this->redirect($this->referer());
				default:
					$this->Session->setFlash("Error uploading file (".$this->data["Screenshot"]["image"]["error"].")");
					$this->redirect($this->referer());
					break;
			}
			
			$this->log("Got upload.",LOG_DEBUG);
			
			if (!in_array($this->data["Screenshot"]["image"]["type"],$valid_mime)) { 
				$this->Session->setFlash("Uploaded file not a valid image. Please, upload a PNG.");
				$this->redirect($this->referer());
			}
			
			if (!is_uploaded_file($this->data["Screenshot"]["image"]["tmp_name"])) {
				die("Hack attempt. IP logged. Please go and die."); # TODO: log IP, ensure attacker is actually dead.
			}
			
			$this->log("Upload looks good",LOG_DEBUG);
			
			if (file_exists($path.$this->data["Screenshot"]["image"]["name"])) {
				$this->Session->setFlash("File with same name already exists. Please rename file.");
				$this->redirect($this->referer());
			} else {
				# File doesn't already exist.
			}
			
			$this->log("Good, uploaded file doesn't exist already Let's try to save.",LOG_DEBUG);
			
			if (is_writable(rtrim($path,"\/"))) {
				$this->log("Destination path is writable",LOG_DEBUG);
				if (move_uploaded_file($this->data["Screenshot"]["image"]["tmp_name"],$path.$this->data["Screenshot"]["image"]["name"])) {
					$this->log("Moved tmp file to destination.",LOG_DEBUG);
					$this->data["Screenshot"]["image_link"] = $this->data["Screenshot"]["image"]["name"];
				} else {
					$this->Session->setFlash("Error moving uploaded file.");
					$this->redirect("/");
				}
			} else {
				$this->Session->setFlash("Screenshot uploads disabled. Please contact admininstrator.");
				$this->redirect("/");
			}
			
			$this->log("Upload OK, moving to DB save.",LOG_DEBUG);
			if ($this->Screenshot->save($this->data)) {
				$this->log("All OK. Redirecting..",LOG_DEBUG);
				$this->Session->setFlash("Screenshot was added.");
				$this->redirect(array("action"=>"edit",$this->Screenshot->id));
			} else {
				# FIXME: Database save failed, but file was added. Remove file.
			}
		}
		$this->set("game_id",$id);
		$this->set("screenshot_submitters",$this->Screenshot->User->find('list')); # FIXME: should only list users with relevant access level? (That'd be set in the model assocations...)
		$this->set("games",$this->Screenshot->Game->find("list"));
	}
	
	function admin() {
		# Dummy redirector to game/admin
		$this->redirect("/games/admin");
	}
	
	function edit($id=null) { # interview/edit allows to edit all news.
		if ($id == null) { $this->redirect("/"); }
		if (!empty($this->data)) {
			if($this->Screenshot->save($this->data)) {
		  	//Set a session flash message and redirect.
		    $this->Session->setFlash("Screenshot saved!");
		    # $this->redirect('/games/queue');
			}
		}
		$this->data = $this->Screenshot->find("first",array("conditions"=>array("screenshot_id"=>$id)));
		# $this->set("game_id",$this->data["Screenshot"]["game_id"]);
		$this->set("games",$this->Screenshot->Game->find("list"));
		$this->set("screenshot_submitters",$this->Screenshot->User->find('list')); # FIXME: should only list users with relevant access level? (That'd be set in the model assocations...)
	}
	
	function delete($id=null) { # interview/delete allows to delete all news.
		if ($id == null) { $this->redirect("/"); }
		$screenshot = $this->Screenshot->find("first",array("conditions"=>array("screenshot_id"=>$id)));
		if (!empty($screenshot)) {
			$this->Screenshot->del($id);
			# FIXME: Also delete the screenshot file.
			$this->flash('The screenshot with id '.$id.' has been deleted.', array("controller"=>"games","action"=>"edit",$screenshot["Screenshot"]["game_id"]));
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/");
		}
		
	}

/*
	function show($img = null) {
		# This might be even slower way to do things. We need to invoke a php thread for each image... every time.
		# view = show DB-entry, show (public) = return image.
		# This should replicate previous $site->image-functionality cache-wise.
		# content-type image/(jpeg|png|...)
		if (!isset($img)) { $this->cakeError("error404"); }
		$ext = "png";
		$filename = basename($img);
		$this->view = "Media";
		$params = array("id"=>$filename,
			"download"=>false,
			"extension"=>$ext,
			"path"=>"webroot/img/cache/"
			);
		$this->set($params);
		# if fail, show this:
		# $this->cakeError("error404");
	} 
*/
}
?>