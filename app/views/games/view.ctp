<? # View initialization
		$this->pageTitle = $game["Game"]["game_name"];
		$html->css("fancy","stylesheet",array("media"=>"screen"),false);
		$javascript->link("/js/jquery.fancybox.js",false);
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
<h1><?=$game['Game']['game_name']?> (<?=$game["Game"]["year"]?>)</h1>
<p><small>by <?=$html->link($game['Publisher']['name'],array("controller"=>"publishers","action"=>"view",$game["Publisher"]["publisher_id"]))?></small></p>
<p><?=nl2br($game['Game']['description'])?></p>
<h2>Details</h2>
<ul><li>Game license: <?=$LICENSE[$game['Game']['lisence']]?></li>
    <li>Game hunter: <?=$html->link($game['GameHunter']['username'],array("controller"=>"users","action"=>"view",$game["GameHunter"]["user_id"]))?></li>
    <li>Game proposer: <?=$html->link($game['GameProposer']['username'],array("controller"=>"users","action"=>"view",$game["GameProposer"]["user_id"]))?></li>
    <li>Reviews: <?=$game["Game"]["review_amount"]?></li>
    <li>Download count: <?=$game["Game"]["download_count"]?></li>
    <li><?=$html->link("Forum link",$game["Game"]["forum_link"])?></li>
    <li><?=$html->link("Game homepage",$game["Game"]["site"])?></li>
    <li>System requirements: <?=nl2br($game["Game"]["requirements"])?></li>
  </ul>
<h2>Genres</h2>
<ul><?
foreach ($game["Genres"] as $genre => $genre_set) {
  if ($genre_set == 1) echo "<li>".$GENRE[$genre]."</li>";
}
?>  
</ul>
<h2>Platforms</h2>
<ul><?
foreach ($game["Specs"] as $platform => $platform_set) {
  if ($platform_set == 1) echo "<li>".$OSYSTEM[$platform]."</li>";
}
?></ul>
<h2>Screenshots</h2>
<ul id="screenshots"><?
foreach ($game["Screenshot"] as $screenshot) {
  echo "<li>".$html->link($site->image($screenshot["image_link"],array("width"=>100,"height"=>100,"title"=>"Screenshot")),$site->image_url($screenshot["image_link"]),array("rel"=>"ssg1","title"=>$game["Game"]["game_name"]),false,false)."</li>";
  # $html->image => $site->image for resizing.
}
?>
<?
if (empty($game["Screenshot"])) {
  echo "<li>".$html->image("/img/cwf_nosshot.png",array("width"=>100,"height"=>100,"title"=>"No screenshot"))."</li>";
}
?>
</ul>
<h2>Ratings</h2>
<? 
if(!empty($user_id)) { 
  echo $form->create("Rating",array("controller"=>"ratings","action"=>"vote"));
  echo $form->hidden("Game.game_id",array("value"=>$game["Game"]["game_id"]));
}
?>
<ul>
<li>Game hunters' rating: <?=$site->drawStars($game["Game"]["site_rating"],6,false,array("/img/icons/award_star_gold_3.png","/img/icons/award_star_silver_3.png"))?> (<?=$game["Game"]["site_rating"]?> of 6)</li>
<?
# Rewriting arrays for better traversal in foreach loops.
$ratings = array();
$user_rating = array();
foreach ($game["Rating"] as $rating) {
  $ratings[$rating["rating_type"]]["average_rating"] = $rating["Rating"][0]["average_rating"];
  $ratings[$rating["rating_type"]]["vote_count"] = $rating["Rating"][0]["vote_count"];
}
foreach ($user_ratings as $rating) {
  $user_rating[$rating["Rating"]["rating_type"]]["value"] = $rating["Rating"]["rating_value"];
  $user_rating[$rating["Rating"]["rating_type"]]["vote_id"] = $rating["Rating"]["vote_id"];
}
foreach ($RATING_TYPE as $key => $type) {
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
  if(!empty($user_id)) {
    $allowEmpty = false;
    if (!array_key_exists($key,$user_rating)) {
      $user_rating[$key]["value"] = "";
      $allowEmpty = true;
    }
    echo " Your vote: ";
    echo $form->hidden("Rating.".$key.".rating_type",array("value"=>$key));
    echo $form->select("Rating.".$key.".rating_value",array(0=>"0",1=>"1",2=>"2",3=>"3",4=>"4",5=>"5",6=>"6"),$user_rating[$key]["value"],array(),(false OR $allowEmpty));
  }
  echo '</li>';
}
?>
</ul>
<? if(!empty($user_id)) echo $form->end("Vote"); ?>
<h2>Downloads</h2>
<ul><?
foreach ($game["Download"] as $file) {
  echo '<li>'.$html->link(basename($file["download_link"]),array("controller"=>"downloads","action"=>"dl",$file["file_id"])).' ('.$number->toReadableSize($file["size"]*1024).')<br><i>'.$file["explanation"].' ('.$PLATFORM[$file["file_platform"]].' '.$DL_TYPE[$file["package_type"]].')</i></li>';
}
?></ul>

<h2>Reviews</h2>
<?
foreach ($game["Review"] as $review) {
 echo '<h3>'.$review["review_title"].'</h3>';
 echo "written by ".$review["User"]["username"]. " in ".$review["review_lang"]."<br/>";
 echo nl2br($review["review_text"]); # TODO: encoding (DB iso, site utf-8)
 # print_r($review);
}
if (count($game["Review"]) == 0) {
  echo "<p>No reviews.</p>";
}
?>

<h2>Comments</h2>
<p>Not implemented yet</p>

<?#=debug($game)?>