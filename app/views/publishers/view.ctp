<? $this->pageTitle = $publisher["Publisher"]["name"]; ?>
<div class="vcard">
<h1 class="fn"><?=$publisher["Publisher"]["name"]?></h1>
<h2>Details</h2>
<ul>
  <li class="site"><?=$html->link($publisher["Publisher"]["site"],$publisher["Publisher"]["site"],array("class"=>"url"))?></li>
  <? 
  if (!empty($publisher["Publisher"]["email"])) {
    # echo $html->link($publisher["Publisher"]["email"],"mailto:".$publisher["Publisher"]["email"])
    echo "<li class=\"email\">".$recaptcha->hide_mail($publisher["Publisher"]["email"])."</li>"; 
  }
    ?>
</ul>
</div>
<h2>Games on CWF</h2>
<ul class="games">
<?
  foreach($publisher["Game"] as $game) {
    echo "<li>".$html->link($game["game_name"],array("controller"=>"games","action"=>"view",$game["game_id"]))."</li>";
  }
?>
</ul>
<h2>Interviews</h2>
<ul class="reviews">
<?
  foreach($publisher["Interview"] as $interview) {
    echo "<li>".$html->link($interview["interview_title"],array("controller"=>"interviews","action"=>"view",$interview["interview_id"]))."</li>";
  }
?>
</ul>