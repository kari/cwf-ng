<? $this->pageTitle = "Game Vs. Game Hall of Fame"; ?>
<h1>Game Vs. Game Hall of Fame</h1>
<table>
  <tr><th>Rank</th><th>Game</th><th>Wins</th><th>Points</th></tr>
<?
  $i = 0;
  foreach($games as $game) {
    $i++;
    echo "<tr><td>";
    echo $i."</td><td>";
    echo $html->link($game["Game"]["game_name"],array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]))."</td><td>";
    echo $game["Stats"]["wins"]."</td><td>".$game["Stats"]["points"];
    echo "</td></tr>";
  }

?>
</table>