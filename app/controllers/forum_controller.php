<?php
class ForumController extends AppController {
	var $name = 'Forum';
	var $uses = array("Game");
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow("*");
	}
	
	function index() {
		# $this->cakeError("error404");
	}
	
	function latest_posts() {
		if (!isset($this->params["requested"])) { $this->cakeError("error404"); }
		$query = "SELECT Topic.topic_title,Post.post_id,Post.poster_id,User.username FROM phpbb_posts AS Post LEFT JOIN phpbb_topics AS Topic ON Post.topic_id = Topic.topic_id LEFT JOIN phpbb_users AS User ON User.user_id = Post.poster_id ORDER BY Post.post_id DESC LIMIT 10;";
		return $this->Game->query($query);
	}
}