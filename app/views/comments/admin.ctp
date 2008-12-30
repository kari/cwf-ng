<h1>Comment admin</h1>
<p>All validated comments are visible on the site.</p>
<table>
  <tr><th>Comment</th><th>Game</th><th>Author</th><th>Validated</th><th>Added</th><th>Actions</th></tr>
<?
foreach($comments as $comment) {
  echo "<tr><td>".$comment["Comment"]["title"]."</td>";
  echo "<td>".$comment["Game"]["game_name"]."</td>";
  echo "<td>".$comment["User"]["username"]."</td>";
  echo "<td>";
  if ($comment["Comment"]["validated"] == TRUE) {
    echo "Yes";
  } else {
      echo "No";
  }
  echo "</td>";
  echo "<td>".$comment["Comment"]["created"]."</td>";
  echo "<td>".$html->link("Edit",array("action"=>"edit",$comment["Comment"]["comment_id"]))." ";
  echo $html->link("Delete",array("action"=>"delete",$comment["Comment"]["comment_id"]),array(),false)." ";
  echo "</td></tr>";
}
?>
</table>
<?=$paginator->prev('« Previous ', null, null, array('class' => 'disabled'));?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next(' Next »', null, null, array('class' => 'disabled'));?> &nbsp;
<?=$paginator->counter(); ?>