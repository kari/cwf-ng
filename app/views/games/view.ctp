<h1><?=$game['Game']['game_name']?> (<?=$game["Game"]["year"]?>)</h1>
<p><small>by <?=$html->link($game['Publisher']['name'],array("controller"=>"publishers","action"=>"view",$game["Publisher"]["publisher_id"]))?></small></p>
<p><?=nl2br($game['Game']['description'])?></p>

<h2>Details</h2>
<ul><li>Game license: <?=$LICENSE[$game['Game']['lisence']]?></li>
    <li>Game hunter: <?=$html->link($game['Game_Hunter']['username'],array("controller"=>"users","action"=>"view",$game["Game_Hunter"]["user_id"]))?></li>
    <li>Game proposer: <?=$html->link($game['Game_Proposer']['username'],array("controller"=>"users","action"=>"view",$game["Game_Proposer"]["user_id"]))?></li>
    <li>Reviews: <?=$game["Game"]["review_amount"]?></li>
    <li>Download count: <?=$game["Game"]["download_count"]?></li>
    <li><?=$html->link("Forum link",$game["Game"]["forum_link"])?></li>
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
<ul><?
foreach ($game["Screenshot"] as $screenshot) {
  echo '<li><a href="http://www.curlysworldoffreeware.com/'.$screenshot["image_link"].'"><img src="http://www.curlysworldoffreeware.com/'.$screenshot["thumb_link"].'"></a></li>';
}
?>
</ul>
<h2>Ratings</h2><ul>
<li>Game hunters' rating: <?=$game["Game"]["site_rating"]?></li>
<?
foreach ($RATING_TYPE as $key => $type) {
  echo '<li>'.$type.': ';
  if (array_key_exists($key,$ratings)) {
    printf("%01.2f",$ratings[$key][0]["average_rating"]);
    echo ' ('.$ratings[$key][0]["vote_count"].' votes)';
  } else {
    echo "No votes";
  }
  echo '</li>';
}
?>
</ul>
<h2>Downloads</h2>
<ul><?
foreach ($game["Download"] as $file) {
  echo '<li>'.$html->link($file["download_link"],array("controller"=>"downloads","action"=>"dl",$file["file_id"])).' ('.$file["size"].' kB)<br><i>'.$file["explanation"].' ('.$PLATFORM[$file["file_platform"]].' '.$DL_TYPE[$file["package_type"]].')</i></li>';
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
<p>Not entirely sure what these would be for.</p>