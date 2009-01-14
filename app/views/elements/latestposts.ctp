<h1>Latest forum posts</h1>
<?
$topics = $this->requestAction("/forum/latest_posts");
debug($topics);
?>
<table>
  <tr><th>Topic</th><th>User</th></tr>
<?
foreach ($topics as $topic) {
  
}
?>