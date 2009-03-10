<? $this->pageTitle = $publisher["Publisher"]["name"]; ?>
<h1><?=$publisher["Publisher"]["name"]?></h1>
<h2>Details</h2>
<ul>
  <li>Site: <?=$html->link($publisher["Publisher"]["site"],$publisher["Publisher"]["site"])?></li>
  <? 
  if (!empty($publisher["Publisher"]["email"])) {
    # echo $html->link($publisher["Publisher"]["email"],"mailto:".$publisher["Publisher"]["email"])
    echo "<li>E-mail: ".$recaptcha->hide_mail($publisher["Publisher"]["email"])."</li>"; 
  }
    ?>
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
<ul>
<?
  foreach($publisher["Interview"] as $interview) {
    echo "<li>".$html->link($interview["interview_title"],array("controller"=>"interviews","action"=>"view",$interview["interview_id"]))."</li>";
  }
?>
</ul>