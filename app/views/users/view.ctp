<? $this->pageTitle = $user["User"]["username"]; ?>
<div class="vcard">
<h1 class="fn nickname"><?=$user['User']['username']?></h1>
<div class="yui-gf">
  <div class="yui-u first">
<?=$site->avatar($user["User"])?>
  </div>
  <div class="yui-u">
<ul>
<?
if ($session->read("Auth.User.user_id")==$this->data["cached_user_id"]) {
  echo "<li>".$html->link("Edit profile","/forum/editprofile")."</li>";
}
?>
  <li class="site"><?=$html->link("Website",$user["User"]["user_website"],array("rel"=>"me"),array("class"=>"url"))?></li>
  <li>Location: <span class="adr label"><?=$user["User"]["user_from"]?></span> <?=$html->image("http://curlysworldoffreeware.com/images/flags/".$user["User"]["user_from_flag"])?></li>
  <li>Occupation: <?=$user["User"]["user_occ"]?></li>
  <li>Birthday: <?=date("d.m.Y",strtotime("+".$user["User"]["user_birthday"]." days",0))?></li> 
  <li>Last visit: <?=date("d.m.Y",$user["User"]["user_lastvisit"])?></li>
  <li>User since: <?=date("d.m.Y",$user["User"]["user_regdate"])?></li>
  <li>Forum posts: <?=$user["User"]["user_posts"]?></li>
  <li><?=$html->link("Forum profile","http://curlysworldoffreeware.com/profile.php?mode=viewprofile&u=".$user["User"]["user_id"])?></li>
  <li>Interests: <?=$user["User"]["user_interests"]?></li>
  <li>User timzeone: <span class="tz"><?=sprintf("%+1.1f",$user["User"]["user_timezone"])?> </span>
<?
 # echo date_format(date_create("now",timezone_open(timezone_name_from_abbr("",$user["User"]["user_timezone"]*60*60,0))),"T")." (like ".timezone_name_from_abbr("",$user["User"]["user_timezone"]*60*60,0).")";
 
?> 
 </li>
  <li>Forum signature: <blockquote><?=$bbcode->decode($user["User"]["user_sig"],$user["User"]["user_sig_bbcode_uid"])?></blockquote></li>
</ul>
  </div>
</div>
</div>

<div class="yui-g">
  <div class="yui-u first">
<h2>Proposed games (<?=count($user["Game_Proposed"])?>)</h2>
<ul class="games">
  <?
if (count($user["Game_Proposed"])>0) {
  $i = 0;
  shuffle($user["Game_Proposed"]); # FIXME: Is this really useful? Default oder is DESC by date.
  foreach($user["Game_Proposed"] as $game) {
    if ($i++>=10) { echo "<li>and many more...</li>"; break; };
    echo "<li>".$html->link($game["game_name"],array("controller"=>"games","action"=>"view",$game["game_id"]))."</li>";     
  }
} else {
  echo "<li>No proposed games</li>";
}
  ?>
</ul>
  </div>
  <div class="yui-u">
<h2>Hunted games (<?=count($user["Game_Hunted"])?>)</h2>
<ul class="games">
  <?
if (count($user["Game_Hunted"])>0) {
  $i = 0;
  shuffle($user["Game_Hunted"]); # FIXME: See above.
  foreach($user["Game_Hunted"] as $game) {
    if ($i++>=10) { echo "<li>and many more...</li>"; break; };
    echo "<li>".$html->link($game["game_name"],array("controller"=>"games","action"=>"view",$game["game_id"]))."</li>";
  }
} else {
  echo "<li>No hunted games</li>";
}
  ?>
</ul>
  </div>
</div>
<div class="yui-g">
  <div class="yui-u first">
<h2>Reviews</h2>
<ul class="reviews">  <?
if (count($user["Review"])>0) {
  foreach($user["Review"] as $review) {
    echo "<li>".$html->link($review["review_title"],array("controller"=>"reviews","action"=>"view",$review["review_id"]))."</li>";
  }
} else {
  echo "<li>".$user["User"]["username"]." hasn't written any reviews… yet.</li>";
}  
  ?></ul>
</div>
<div class="yui-u">
<h2>Groups</h2>
<ul class="groups">
  <?
if (count($user["Group"])>0) {
  foreach($user["Group"] as $group) {
    echo "<li>".$group["group_name"]." <i>(".$group["group_description"].")</i></li>";
  }
} else {
  echo "<li>".$user["User"]["username"]." doesn't belong to any groups.</li>";
}
  ?>
</ul>
</div>
</div>