<h1>Game validation queue</h1>
<p>Note that none of these games on this page are visible on the site.</p>
<table>
  <tr><th>Game name</th><th>Game status</th><th>Game Hunter</th><th>GH score</th><th>Actions</th></tr>
<?
foreach($games as $game) {
  echo "<tr><td>".$game["Game"]["game_name"]."</td>";
  echo "<td>".$DL_STATUS[$game["Game"]["download_status"]]."</td>";
  echo "<td>".$game["GameHunter"]["username"]."</td>";
  echo "<td>".$game["Game"]["site_rating"]."</td>";
  echo "<td>".$html->link("Edit",array("action"=>"edit",$game["Game"]["game_id"]))." ";
  echo $html->link("Delete",array("action"=>"delete",$game["Game"]["game_id"]),array(),"Are you sure you want to delete the game '".$game["Game"]["game_name"]."'?")." ";
  if (!empty($game["Game"]["forum_link"])) {
    echo $html->link("Forum",$game["Game"]["forum_link"])." ";
  }
  if (!empty($game["Game"]["site"])) { 
    echo $html->link("Website",$game["Game"]["site"])." ";
  }
  echo "</td></tr>";
}
?>
</table>