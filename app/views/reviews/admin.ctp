<?
echo $javascript->codeBlock("
$(document).ready(function() {
  $('select#game').change(function() {
      var selected = $('select#game option:selected');
      if (selected.val() > 0) {
        window.location.href = '".$html->url(array("action"=>"add"))."/'+selected.val();
      }
    });
});");
?>
<h1>Review admin</h1>
<p>Add a review for <?=$form->select("game",$games,false,array(),true)?></p>
<p>Filter by Review status: [<?=$paginator->link("All",array())?>] [<?=$paginator->link("Published",array("status"=>1))?>] [<?=$paginator->link("Validation queue",array("status"=>2))?>]</p>
<?$paginator->options(array('url' => $this->passedArgs));?>
<table class="clean">
  <tr><th>Actions</th><th>Review title</th><th><?=$paginator->sort("Game","Game.game_name")?></th><th><?=$paginator->sort("Author","User.username")?></th><th>Validated</th><th><?=$paginator->sort("Added","Review.added")?></th></tr>
<?
foreach($reviews as $review) {
  echo "<tr>";
  echo "<td>".$html->link($html->image("/img/icons/application_edit.png",array("alt"=>"Edit","title"=>"Edit")),array("action"=>"edit",$review["Review"]["review_id"]),null,null,false)." ";
  echo $html->link($html->image("/img/icons/application_delete.png",array("alt"=>"Delete","title"=>"Delete")),array("action"=>"delete",$review["Review"]["review_id"]),array(),"Are you sure you want to delete this review?",false)." ";
  echo "</td>";
  echo "<td>".$text->trim($review["Review"]["review_title"],40,"…",false)."</td>";
  echo "<td>".$text->trim($review["Game"]["game_name"],25,"…",false)."</td>";
  echo "<td>".$review["User"]["username"]."</td>";
  if ($review["Review"]["review_rating"] > 0) {
    echo "<td>".$html->image("/img/icons/accept.png",array("title"=>"Validated"))." ".$html->link("Unpublish",array("action"=>"unpublish",$review["Review"]["review_id"]))."</td>";
  } else {
    echo "<td>".$html->image("/img/icons/error.png",array("title"=>"Unvalidated"))."  ".$html->link("Publish",array("action"=>"publish",$review["Review"]["review_id"]))."</td>";
  }
  echo "<td>".$time->format("d.m.Y",$review["Review"]["added"])."</td>";
  echo "</tr>";
}
?>
</table>
<?=$paginator->prev();?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next();?> &nbsp;
<?=$paginator->counter(); ?>