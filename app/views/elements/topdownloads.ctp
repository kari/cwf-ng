<h1>Top downloads</h1>
<? $games = $this->requestAction("/games/top/download");?>
<table class="clean">
  <tr><th>Game</th><th>DLs</th></tr>
<?
foreach($games as $game) {
  echo "<tr><td>".$html->link($text->trim($game["Game"]["game_name"],25),array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]))."</td>";
  echo "<td>".$game["Game"]["download_count"]."</td></tr>";
}
?>
</table>
