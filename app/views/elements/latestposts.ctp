<h1>Latest forum posts</h1>
<?
$topics = $this->requestAction("/forum/latest_posts");
# debug($topics);
?>
<table>
  <tr><th>Topic</th><th>User</th></tr>
<?
foreach ($topics as $topic) {
  echo "<tr><td>".$html->link($topic["Topic"]["topic_title"],"http://".Configure::read("Forum.url")."/viewtopic.php?p=".$topic["Post"]["post_id"]."#".$topic["Post"]["post_id"])."</td><td>".$html->link($topic["User"]["username"],array("controller"=>"users","action"=>"view",$topic["Post"]["poster_id"]))."</td></tr>";
}
?>
</table>