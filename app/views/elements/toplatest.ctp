<h1>Latest games</h1>
<? $games = $this->requestAction("/games/top/latest");?>
<table>
  <tr><th>Game</th><th>Time</th></tr>
<?
foreach($games as $game) {
  echo "<tr><td>".$html->link($text->trim($game["Game"]["game_name"],25),array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]))."</td>";
  echo "<td>".$time->format("d.m.Y",$game["Game"]["created"])."</td></tr>";
}
?>
</table>
