<h1>Top rated games</h1>
<? $games = $this->requestAction("/games/top/rating");?>
<table class="clean">
  <tr><th>Game</th><th>Rating</th></tr>
<?
foreach($games as $game) {
  echo "<tr><td>".$html->link($text->trim($game["Game"]["game_name"],25),array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]))."</td>";
  # echo "<td>".$site->drawStars($game[0]["average_rating"],6)." ";
  echo "<td>".$number->precision($game[0]["average_rating"],2)."</td></tr>";
}
?>
</table>