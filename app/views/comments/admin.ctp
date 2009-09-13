<h1>Comment admin</h1>
<p>All validated comments are visible on the site.</p>
<p>Filter by Download status: [<?=$paginator->link("All",array())?>] [<?=$paginator->link("Validation queue",array("status"=>2))?>] [<?=$paginator->link("Validated",array("status"=>1))?>]</p>
<?$paginator->options(array('url' => $this->passedArgs));?>
<table class="clean"> <tr><th>Comment</th><th><?=$paginator->sort("Game","Game.game_name")?></th><th><?=$paginator->sort("Author","User.username")?></th><th>Validated</th><th><?=$paginator->sort("Added","Comment.created")?></th><th>Actions</th></tr>
<?
foreach($comments as $comment) {
  echo "<tr><td>".$comment["Comment"]["text"]."</td>";
  echo "<td>".$html->link($comment["Game"]["game_name"],array("controller"=>"games","action"=>"view",$comment["Game"]["game_id"]))."</td>";
  echo "<td>".$comment["User"]["username"]."</td>";
  echo "<td>";
  if ($comment["Comment"]["validated"] == TRUE) {
    echo "Yes, ".$html->link("unpublish",array("action"=>"unpublish",$comment["Comment"]["comment_id"])).".";
  } else {
      echo "No, ".$html->link("publish",array("action"=>"publish",$comment["Comment"]["comment_id"])).".";
  }
  echo "</td>";
  echo "<td>".$time->format("d.m.Y H:i",$comment["Comment"]["created"])."</td>";
  echo "<td>".$html->link("Edit",array("action"=>"edit",$comment["Comment"]["comment_id"]))." ";
  echo $html->link("Delete",array("action"=>"delete",$comment["Comment"]["comment_id"]),array(),false)." ";
  echo "</td></tr>";
}
?>
</table>
<?=$paginator->prev();?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next();?> &nbsp;
<?=$paginator->counter(); ?>