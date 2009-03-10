<h1>Review admin</h1>
<table>
  <tr><th>Review title</th><th><?=$paginator->sort("Game","Game.game_name")?></th><th>Author</th><th>Validated</th><th><?=$paginator->sort("Added","Review.added")?></th><th>Actions</th></tr>
<?
foreach($reviews as $review) {
  echo "<tr><td>".$review["Review"]["review_title"]."</td>";
  echo "<td>".$review["Game"]["game_name"]."</td>";
  echo "<td>".$review["User"]["username"]."</td>";
  if ($review["Review"]["review_rating"] > 0) {
    echo "<td>Yes, ".$html->link("Unpublish",array("action"=>"unpublish",$review["Review"]["review_id"])).".</td>";
  } else {
    echo "<td>No, ".$html->link("Publish",array("action"=>"publish",$review["Review"]["review_id"])).".</td>";
  }
  echo "<td>".$review["Review"]["added"]."</td>";
  echo "<td>".$html->link("Edit",array("action"=>"edit",$review["Review"]["review_id"]))." ";
  echo $html->link("Delete",array("action"=>"delete",$review["Review"]["review_id"]),array(),"Are you sure you want to delete this review?")." ";
  echo "</td></tr>";
}
?>
</table>
<?=$paginator->prev('« Previous ', null, null, array('class' => 'disabled'));?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next(' Next »', null, null, array('class' => 'disabled'));?> &nbsp;
<?=$paginator->counter(); ?>