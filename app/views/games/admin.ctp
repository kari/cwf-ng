<h1>Game admin</h1>
<table>
  <tr><th><?=$paginator->sort("Game name","Game.game_name")?></th><th><?=$paginator->sort("Game status","Game.download_status")?></th><th>Game Hunter</th><th>GH score</th><th>Actions</th></tr>
<?
foreach($games as $game) {
  if ($game["Game"]["download_status"] == 0) {
    echo "<tr><td>".$html->link($game["Game"]["game_name"],array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]))."</td>";
  } else {
    echo "<tr><td>".$game["Game"]["game_name"]."</td>";
  }
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
<?=$paginator->prev('« Previous ', null, null, array('class' => 'disabled'));?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next(' Next »', null, null, array('class' => 'disabled'));?> &nbsp;
<?=$paginator->counter(); ?>