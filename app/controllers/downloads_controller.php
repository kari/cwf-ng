<?php

class DownloadsController extends AppController {
	var $name = 'Downloads';
  # var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array("get"));
		$this->Auth->mapActions(array("read"=>array("get")));
	}
	
	function admin() {
		# Dummy redirector
		$this->redirect("/games/admin");
	}

	function get($id=null) {
		# $this->Download->contain(array("Download","Game","Game.Genres"));
		if ($id == null) { $this->cakeError("error404"); }
		$download = $this->Download->find("first",array("conditions"=>array("file_id"=>$id)));
		if (!$download) { $this->cakeError("error404"); }
		if ($download["Game"]["adult"] and $this->data["accept"]<>true) {
			$this->set("download",$download);
			# show interstitial page
		} else {
			# check we got sane data
			$file_info = pathinfo($download["Download"]["download_link"]); # For extension.
			if (!file_exists(Configure::read("Site.file_path").basename($download["Download"]["download_link"]))) { 
				$this->log("File '".Configure::read("Site.file_path").basename($download["Download"]["download_link"])."' is missing.");
				$this->cakeError("error404"); 	
			}
		
			# Download count
			# query: CWF_download_stats (gameid, file_id,user_id,date)
			$user_id = $this->Auth->user("user_id");
			if (!$user_id) { $user_id = -1; } # Anonymous
			$query = "INSERT CWF_download_stats (gameid,file_id,user_id,date) VALUES ('".join("','",array($download["Download"]["game_id"],$download["Download"]["file_id"],$user_id,date("Y-m-d H:i:s")))."')";
			$this->Download->query($query);
		
			# query: CWF_game_files (Download) (download_count++)
			$download["Download"]["download_count"]++;
			$this->Download->save($download);
		
			$this->layout = 'ajax';
			$this->view = 'Media'; # TODO: Rewrite built-in media view to support throttling, additional mime types...
			$params = array(
		              'id' => basename($download["Download"]["download_link"]), # Filename
		              'name' => basename($download["Download"]["download_link"],".".$file_info["extension"]), # Alternate file name to be sent to the user (without extension)
		              'download' => true, # Force download
		              'extension' => $file_info["extension"], # Extension to be matched with internal list of MIME-types
		              'path' => Configure::read("Site.file_path"), # absolute filesystem path to file location 
									# Some mime types are not defined in Media view.
									# Built-in media view shows blank if extension is not in mimeType array.
									# The current zoo of file extensions can be checked for example with
									# SELECT DISTINCT SUBSTRING_INDEX(download_link,".",-1) FROM CWF_game_files
									"mimeType" => array("rar"=>"application/x-rar-compressed", # RAR archives.
																			"dmg"=>"application/x-apple-diskimage", # Mac OS X disk images
																			"run"=>"application/octet-stream",
																			"mojo"=>"application/octet-stream",
																			"msi"=>"application/octet-stream", # Windows MSI installers
																			"iso"=>"application/octet-stream", # ISO CD images
																			"rpm"=>"application/x-rpm", # Red Hat Package Manager
																			"deb"=>"application/x-deb", # Debian package
																			),
									); 
			$this->set($params);
			Configure::write('debug', 0);
		}
	}
	
	function add($id = null) {
		if (!empty($this->data)) {
			$file = Configure::read("Site.file_path").basename($this->data["Download"]["download_link"]);
			# Add file size information if file exists.
			if (file_exists($file) && filesize($file)) {
				$this->data["Download"]["size"] = filesize($file)/1024;
			} else {
				$this->data["Download"]["size"] = 0; # DB field is NOT NULL
				$this->log("File '".$file."' is missing.");
			}
			# legacy support
			$this->data["Download"]["download_link"] = "Download/Games/".basename($this->data["Download"]["download_link"]);
			if($this->Download->save($this->data)) {
				$this->Session->setFlash("Download was added.");
				$this->redirect(array("action"=>"edit",$this->Download->id));
			}
		}
		$this->set("game_id",$id);
		$this->set("game_submitters",$this->Download->User->find('list')); # FIXME: should only list users with relevant access level? (That'd be set in the model assocations...)
		
		$this->set("games",$this->Download->Game->find("list"));
		$this->set("DL_TYPE",$this->Download->TYPE);
		$this->set("PLATFORM",$this->Download->PLATFORM);
	}
	
	function edit($id=null) { # interview/edit allows to edit all news.
		if ($id == null) { $this->redirect("/"); }
		if (!$this->Download->find("first",array("conditions"=>array("Download.file_id"=>$id)))) {$this->redirect("/"); }
		if (!empty($this->data)) {
			$this->data["Download"]["file_id"] = $id;
			$file = Configure::read("Site.file_path").basename($this->data["Download"]["download_link"]);
			# Add file size information if file exists.
			if (file_exists($file) && filesize($file)) {
				$this->data["Download"]["size"] = filesize($file)/1024;
				# $this->log("File '".$file."' is ".(filesize($file)/1024)." kB in size");
			} else { 
				$this->log("File '".$file."' is missing.");
			}
			if($this->Download->save($this->data)) {
		  	//Set a session flash message and redirect.
		    $this->Session->setFlash("Download saved!");
		    # $this->redirect('/games/queue');
			}
		}
		$this->data = $this->Download->find("first",array("conditions"=>array("file_id"=>$id)));
		$this->set("game_submitters",$this->Download->User->find('list')); # FIXME: should only list users with relevant access level? (That'd be set in the model assocations...)
		$this->set("games",$this->Download->Game->find("list"));
		$this->set("DL_TYPE",$this->Download->TYPE);
		$this->set("PLATFORM",$this->Download->PLATFORM);
	}
	
	function delete($id=null) { # interview/delete allows to delete all news.
		if ($id == null) { $this->redirect("/"); }
		$download = $this->Download->find("first",array("conditions"=>array("file_id"=>$id)));
		if (!empty($download)) {
			# FIXME: Delete file on the file system too. 
			$this->Download->del($id);
			$this->Session->setFlash('The download has been deleted.');
			$this->redirect( array("controller"=>"games","action"=>"edit",$download["Download"]["game_id"]));
		} else {
			$this->Session->setFlash($this->Auth->authError);
			$this->redirect("/");
		}
		
	}
	
}

?>