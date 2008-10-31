<? $this->pageTitle = $user["User"]["username"]; ?>
<h1><?=$user['User']['username']?></h1>
<?
switch ($user['User']['user_avatar_type']) {
  case 0:
    echo "no avatar";
    break;
  case 1:
    echo $html->image("http://curlysworldoffreeware.com/images/avatars/".$user["User"]["user_avatar"]);
    break;
  case 2:
    echo $html->image($user["User"]["user_avatar"]);
    break;
}
?>
<ul>
  <li><?=$html->link("Website",$user["User"]["user_website"])?></li>
  <li>Location: <?=$user["User"]["user_from"]?> <?=$html->image("http://curlysworldoffreeware.com/images/flags/".$user["User"]["user_from_flag"])?></li>
  <li>Occupation: <?=$user["User"]["user_occ"]?></li>
  <li>Last visit: <?=date("d.m.Y",$user["User"]["user_lastvisit"])?></li>
  <li>User since: <?=date("d.m.Y",$user["User"]["user_regdate"])?></li>
  <li>Forum posts: <?=$user["User"]["user_posts"]?></li>
  <li><?=$html->link("Forum profile","http://curlysworldoffreeware.com/profile.php?mode=viewprofile&u=".$user["User"]["user_id"])?></li>
  <li>Interests: <?=$user["User"]["user_interests"]?></li>
  <li>User timzeone: <?=sprintf("%+1.1f",$user["User"]["user_timezone"])?> <?=date_format(date_create("now",timezone_open(timezone_name_from_abbr("",$user["User"]["user_timezone"]*60*60,0))),"T")?> (like <?=timezone_name_from_abbr("",$user["User"]["user_timezone"]*60*60,0)?>)</li>
  <li>Forum signature: <blockquote><?=$bbcode->decode($user["User"]["user_sig"],$user["User"]["user_sig_bbcode_uid"])?></blockquote></li>
</ul>
<h2>Proposed games</h2>
<ul>
  <?
  foreach($user["Game_Proposed"] as $game) {
    echo "<li>".$html->link($game["game_name"],array("controller"=>"games","action"=>"view",$game["game_id"]))."</li>"; 
  }
  ?>
</ul>
<h2>Hunted games</h2>
<ul>
  <?
  foreach($user["Game_Hunted"] as $game) {
    echo "<li>".$html->link($game["game_name"],array("controller"=>"games","action"=>"view",$game["game_id"]))."</li>";
  }
  ?>
</ul>
<h2>Reviews</h2>
<ul>  <?
  foreach($user["Review"] as $review) {
    echo "<li>".$html->link($review["review_title"],array("controller"=>"reviews","action"=>"view",$review["review_id"]))."</li>";
  }
  
  ?></ul>
<h2>Groups</h2>
<ul>
  <? 
  foreach($user["Group"] as $group) {
    echo "<li>".$group["group_name"]."</li>";  
  }
  ?>
</ul>