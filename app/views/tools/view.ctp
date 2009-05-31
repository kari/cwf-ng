<? # View initialization
		$this->pageTitle = $tool["Game"]["game_name"];
		$html->css("jquery.fancybox","stylesheet",array("media"=>"screen"),false);
		$javascript->link("/js/jquery.fancybox-1.2.1.js",false);
?>
<? # Page-specific jQuery code: 
  echo $javascript->codeBlock("$(document).ready(function() {
    $('ul#screenshots li a').fancybox({
      'hideOnContentClick': true,
      'overlayShow': true,
      'overlayOpacity': 0,
      });
    });")
?>
<h1><?=$tool['Game']['game_name']?></h1>
<p><small>by <?=$html->link($tool['Publisher']['name'],$tool["Publisher"]["site"])?></small></p>
<p><?=$bbcode->decode($tool['Game']['description'])?></p>
<h2>Details</h2>
<ul><li>Tool license: <?=$LICENSE[$tool['Game']['lisence']]?></li>
    <li>Game hunter: <?=$html->link($tool['GameHunter']['username'],array("controller"=>"users","action"=>"view",$tool["GameHunter"]["user_id"]))?></li>
    <li>Tool proposer: <?=$html->link($tool['GameProposer']['username'],array("controller"=>"users","action"=>"view",$tool["GameProposer"]["user_id"]))?></li>
    <li>Download count: <?=$tool["Game"]["download_count"]?></li>
    <li><?=$html->link("Forum link",$tool["Game"]["forum_link"])?></li>
    <li><?=$html->link("Tool homepage",$tool["Game"]["site"])?></li>
    <li>System requirements: <?=nl2br($tool["Game"]["requirements"])?></li>
  </ul>

<h2>Platforms</h2>
<ul><?
foreach ($tool["Specs"] as $platform => $platform_set) {
  if ($platform_set == 1) echo "<li>".$OSYSTEM[$platform]."</li>";
}
?></ul>
<h2>Screenshots</h2>
<ul id="screenshots"><?
foreach ($tool["Screenshot"] as $screenshot) {
  echo "<li>".$html->link($site->image($screenshot["image_link"],array("width"=>150,"height"=>150,"title"=>"Screenshot")),$site->image_url($screenshot["image_link"]),array("rel"=>"ssg1","title"=>$tool["Game"]["game_name"]),false,false)."</li>";
  # $html->image => $site->image for resizing.
}
?>
<?
if (empty($tool["Screenshot"])) {
  echo "<li>".$html->image("/img/cwf_nosshot.png",array("width"=>150,"height"=>150,"title"=>"No screenshot"))."</li>";
}
?>
</ul>
<h2>Ratings</h2>
<? 
echo $form->create("Rating",array("controller"=>"ratings","action"=>"vote"));
echo $form->hidden("Game.game_id",array("value"=>$tool["Game"]["game_id"]));
?>
<cake:nocache>
<?
if ($session->check("Auth.User.user_id")) {
  $user_ratings = $this->requestAction("/ratings/user_ratings/".$this->data["cached_game_id"]);
}
?>
</cake:nocache>
<ul>
<li>Game hunters' rating: <?=$site->drawStars($tool["Game"]["site_rating"],6,false,array("/img/icons/award_star_gold_3.png","/img/icons/award_star_silver_3.png"))?> (<?=$tool["Game"]["site_rating"]?> of 6)</li>
<cake:nocache>
<?
$ratings = $this->data["cached_ratings"];
$RATING_TYPE = $this->data["cached_RATING_TYPE"];
$key = 0; # Tool-specific hacks.
$type = $RATING_TYPE[$key];

# foreach ($RATING_TYPE as $key => $type) {
  echo '<li>'.$type.': '; 
  if (array_key_exists($key,$ratings)) { 
    echo $site->drawStars($ratings[$key]["average_rating"],6);
    echo " ".$number->precision($ratings[$key]["average_rating"],2);
    echo ' ('.$ratings[$key]["vote_count"].' vote';
    if ($ratings[$key]["vote_count"] <> 1) echo 's'; // hack pluralization
    echo ')';
  } else {
    echo "No votes";
  };
  # Placeholders for voting.
  if($session->check("Auth.User.user_id")) {
    $allowEmpty = false;
    if (!array_key_exists($key,$user_ratings)) {
      $user_ratings[$key]["value"] = "";
      $allowEmpty = true;
    }
    echo " Your vote: ";
    # echo $form->hidden("Rating.".$key.".rating_type",array("value"=>$key));
    echo '<input type="hidden" name="data[Rating]['.$key.'][rating_type]" value="'.$key.'" id="Rating'.$key.'RatingType" />';
    # echo $form->select("Rating.".$key.".rating_value",array(0=>"0",1=>"1",2=>"2",3=>"3",4=>"4",5=>"5",6=>"6"),$user_ratings[$key]["value"],array(),(false OR $allowEmpty));
    echo '<select name="data[Rating]['.$key.'][rating_value]" id="Rating'.$key.'RatingValue">';
    if ($allowEmpty == true) { echo '<option value=""></option>'; }
    for ($i=1;$i<=6;$i++) { 
      echo '<option value="'.$i.'"';
      if ($user_ratings[$key]["value"]==$i) { echo ' selected="selected"'; }  
      echo '>'.$i.'</option>';
    } 
    echo "</select>";
  } 
  echo '</li>';
# }
?>
</ul>
<? 
if($session->check("Auth.User.user_id")) {
  # echo $form->end("Vote");
  echo '<div class="submit"><input type="submit" value="Vote" /></div></form>';
} else {
  # echo $form->end(array("label"=>"Vote","disabled"=>"disabled"));
  echo '<div class="submit"><input type="submit" disabled="disabled" value="Vote" /></div></form>';
}
?>
</cake:nocache>

<h2>Downloads</h2>
<ul class="downloads"><?
foreach ($tool["Download"] as $file) {
  echo '<li>'.$html->link(basename($file["download_link"]),array("controller"=>"downloads","action"=>"dl",$file["file_id"])).' ('.$number->toReadableSize($file["size"]*1024).')<br><i>'.$file["explanation"].' ('.$PLATFORM[$file["file_platform"]].' '.$DL_TYPE[$file["package_type"]].')</i></li>';
}
?></ul>
<?#=debug($tool)?>