<h1><?=$publisher["Publisher"]["name"]?></h1>
<h2>Details</h2>
<ul>
  <li>Site: <?=$html->link($publisher["Publisher"]["site"],$publisher["Publisher"]["site"])?></li>
  <li>E-mail: <?=$html->link($publisher["Publisher"]["email"],"mailto:".$publisher["Publisher"]["email"])?></li>
</ul>
<h2>Games</h2>
<ul>
<?
  foreach($publisher["Game"] as $game) {
    echo "<li>".$html->link($game["game_name"],array("controller"=>"games","action"=>"view",$game["game_id"]))."</li>";
  }
?>
</ul>
<h2>Interviews</h2>
<ul><li>Not implemented yet</li></ul>