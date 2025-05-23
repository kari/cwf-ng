<?php
class ForumController extends AppController {
	var $name = 'Forum';
	var $uses = array("Game");
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow("*");
	}
	
	function index() {
		$this->redirect("http://".Configure::read("Forum.url")."/index.php"); # FIXME: before release
		# $this->cakeError("error404");
	}
	
	function latest_posts() {
		if (!isset($this->params["requested"])) { $this->cakeError("error404"); }
		$query = "SELECT Topic.topic_title,Post.post_id,Post.poster_id,User.username FROM phpbb_posts AS Post JOIN phpbb_topics AS Topic ON Post.topic_id = Topic.topic_id JOIN phpbb_users AS User ON User.user_id = Post.poster_id ORDER BY Post.post_id DESC LIMIT 10;";
		return $this->Game->query($query);
	}
	
	function latest_topics() {
		if (!isset($this->params["requested"])) { $this->cakeError("error404"); }
		$query = "SELECT Topic.topic_title,Post.post_id,Post.poster_id,User.username FROM phpbb_topics AS Topic JOIN phpbb_posts AS Post ON Topic.topic_last_post_id = Post.post_id JOIN phpbb_users AS User ON User.user_id = Post.poster_id ORDER BY Post.post_id DESC LIMIT 10;";
		return $this->Game->query($query);
	}
}