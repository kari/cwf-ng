<h1>Top Game vs. Game</h1>
<? $games = $this->requestAction("/gvsg/stats");?>
<table>
  <tr><th>Game</th><th>Points</th></tr>
<?
foreach($games as $game) {
  echo "<tr><td>".$html->link($text->trim($game["Game"]["game_name"],25),array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]))."</td>";
  echo "<td>".$game["Stats"]["points"]."</td></tr>";
}
?>
</table>
