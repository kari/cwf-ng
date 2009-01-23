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
<div class="yui-ge">
  <div class="yui-u first">
<h1><?=$game['Game']['game_name']?> (<?=$game["Game"]["year"]?>)</h1>
<p>by <?=$html->link($game['Publisher']['name'],array("controller"=>"publishers","action"=>"view",$game["Publisher"]["publisher_id"]))?></p>
<?# FIXME: A bigger thumbnail of "featured" (or first) screenshot would be nice here! ?>
<p><?=$bbcode->decode($game['Game']['description'])?></p>
<h2>Details</h2>
<ul><li>Game license: <?=$LICENSE[$game['Game']['lisence']]?></li>
    <li>Game hunter: <?=$html->link($game['GameHunter']['username'],array("controller"=>"users","action"=>"view",$game["GameHunter"]["user_id"]))?></li>
    <li>Game proposer: <?=$html->link($game['GameProposer']['username'],array("controller"=>"users","action"=>"view",$game["GameProposer"]["user_id"]))?></li>
    <li>Reviews: <?=$game["Game"]["review_amount"]?></li>
    <li>Download count: <?=$game["Game"]["download_count"]?></li>
    <li><?=$html->link("Forum link",$game["Game"]["forum_link"])?></li>
    <li><?=$html->link("Game homepage",$game["Game"]["site"])?></li>
    <li>Platforms:<ul><?
        foreach ($game["Specs"] as $platform => $platform_set) {
          if ($platform_set == 1) echo "<li>".$OSYSTEM[$platform]."</li>";
        }
        ?></ul></li>
    <li>System requirements: <?=nl2br($game["Game"]["requirements"])?></li>
  </ul>
<h2>Genres</h2>
<ul><?
foreach ($game["Genres"] as $genre => $genre_set) {
  if ($genre_set == 1) echo "<li>".$GENRE[$genre]."</li>";
}
?>  
</ul>
<h2>Screenshots</h2>
<ul id="screenshots"><?
foreach ($game["Screenshot"] as $screenshot) {
  echo "<li>".$html->link($site->image($screenshot["image_link"],array("width"=>150,"height"=>150,"title"=>"Screenshot")),$site->image_url($screenshot["image_link"]),array("rel"=>"ssg1","title"=>$game["Game"]["game_name"]),false,false)."</li>";
  # $html->image => $site->image for resizing.
}
?>
<?
if (empty($game["Screenshot"])) {
  echo "<li>".$html->image("/img/cwf_nosshot.png",array("width"=>150,"height"=>150,"title"=>"No screenshot"))."</li>";
}
?>
</ul>
<h2>Ratings</h2>
<? 
echo $form->create("Rating",array("action"=>"vote"));
echo $form->hidden("Game.game_id",array("value"=>$game["Game"]["game_id"]));
?>
<cake:nocache>
<?
if ($session->check("Auth.User.user_id")) {
  $user_ratings = $this->requestAction("/ratings/user_ratings/".$this->data["cached_game_id"]);
}
?>
</cake:nocache>
<ul>
<li>Game hunters' rating: <?=$site->drawStars($game["Game"]["site_rating"],6,false,array("/img/icons/award_star_gold_3.png","/img/icons/award_star_silver_3.png"))?> (<?=$game["Game"]["site_rating"]?> of 6)</li>
<cake:nocache>
<?
$ratings = $this->data["cached_ratings"];
$RATING_TYPE = $this->data["cached_RATING_TYPE"];

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
}
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
foreach ($game["Download"] as $file) {
  echo '<li>'.$html->link(basename($file["download_link"]),array("controller"=>"downloads","action"=>"get",$file["file_id"])).' ('.$number->toReadableSize($file["size"]*1024).')<br><i>'.$file["explanation"].' ('.$PLATFORM[$file["file_platform"]].' '.$DL_TYPE[$file["package_type"]].')</i></li>';
}
?></ul>
<? if (!empty($game["Guide"])) { ?>
<h2>Guides</h2>
<ul class=""><?
foreach ($game["Guide"] as $guide) {
  echo "<li>".$html->link($guide["title"],array("controller"=>"guides","action"=>"view",$guide["id"]))."</li>";
}
?>
</ul>
<? } ?>
<h2>Reviews</h2>
<ul class="reviews">
<?
foreach ($game["Review"] as $review) {
 echo '<li><h3>'.$html->link($review["review_title"],array("controller"=>"reviews","action"=>"view",$review["review_id"])).' by '.$review["User"]["username"].'</h3>';
 echo "<p>".nl2br($text->trim($review["review_text"],300))."</p></li>";
}
if (count($game["Review"]) == 0) {
  echo "<p>No reviews. ".$html->link("Write one?",array("controller"=>"reviews","action"=>"add",$game["Game"]["game_id"]))."</p>";
}
?>
</ul>

<h2>Comments</h2>
<ul class="reviews">
<?
foreach ($comments as $comment) {
  echo "<li><strong>".$comment["Comment"]["title"]."</strong> by ";
  if ($comment["Comment"]["user_id"] <> -1) {
    echo $html->link($comment["User"]["username"],array("controller"=>"users","action"=>"view",$comment["User"]["user_id"]));
  } else {
    echo "Anonymous";
  }
  echo " ".$time->timeAgoInWords($comment["Comment"]["created"],array("format"=>"d.m.Y"));
  echo "<br>".nl2br($comment["Comment"]["text"])."</li>";
}
?>
</ul>
<?=$paginator->prev('« Previous ', null, null, array('class' => 'disabled'));?>&nbsp;
<?=$paginator->next(' Next »', null, null, array('class' => 'disabled'));?>
<h3>Add a comment</h3>
<?=$form->create("Comment");?>
<?=$form->input("title");?>
<?=$form->input("text",array("rows"=>3));?>
<cake:nocache>
<? 
if ($session->check("Auth.User.user_id")) {
  # If user is logged in, we think he's a human
  echo $form->hidden("user_id",array("value"=>$session->read("Auth.User.user_id")));
} else {
  # ...otherwise he gets the reCAPTCHA challenge.
   echo $recaptcha->display_form();
}
?>
</cake:nocache>
<?=$form->hidden("game_id",array("value"=>$game["Game"]["game_id"]));?>
<?=$form->end("Submit")?>

<br><p>Do we have a mistake on this page? <?=$html->link("Let us know.",array("action"=>"flag",$game["Game"]["game_id"]))?></p>
<?#=debug($game)?>
  </div>
  <div class="yui-u">
    <?=$this->element("adbox",array("style"=>"pw-skyscraper"))?>
  </div>
</div>