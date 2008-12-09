<h1>Review validation queue</h1>
<p>Note that none of these reviews on this page are visible on the site.</p>
<table>
  <tr><th>Review title</th><th>Game</th><th>Author</th><th>Added</th><th>Actions</th></tr>
<?
foreach($reviews as $review) {
  echo "<tr><td>".$review["Review"]["review_title"]."</td>";
  echo "<td>".$review["Game"]["game_name"]."</td>";
  echo "<td>".$review["User"]["username"]."</td>";
  echo "<td>".$review["Review"]["added"]."</td>";
  echo "<td>".$html->link("Edit",array("action"=>"edit",$review["Review"]["review_id"]))." ";
  echo $html->link("Delete",array("action"=>"delete",$review["Review"]["review_id"]),array(),"Are you sure you want to delete this review?")." ";
  echo "</td></tr>";
}
?>
</table>