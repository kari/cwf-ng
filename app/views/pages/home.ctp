<? $this->pageTitle = "CWF-Freeware"; ?>
<div class="yui-g">
<h1>Welcome to CWF-Freeware</h1>
<cake:nocache>
<? 
if ($session->check("Auth.User.user_id")) {
  echo $this->element("gvsg");
} else {
  echo $this->element("adbox",array("style"=>"pw-leaderboard"));
}
?>
</cake:nocache>
</div>
<div class="yui-g">
  <div class="yui-u first">
<h2>Latest site news</h2>
<ul class="news">
<? 
  $first = true;
  foreach($news as $item) {
    echo "<li><strong>";
    echo $time->format("d.m.Y",$item["News"]["post_date"])." - ".$html->link($item["News"]["news_title"],array("controller"=>"news","action"=>"view",$item["News"]["news_id"]))." by ".$item["User"]["username"]."</strong><br>";
    if ($first) {
      echo $text->trim($item["News"]["news_text"],1000,"...",false);
      $first = false;
    } else {
      echo $text->trim($item["News"]["news_text"],200,"...",false);
    }
    echo "</li>";
}?>
</ul>
  </div>
  <div class="yui-u">
<h2>Latest world news</h2>
<ul class="news">
  <? 
    $first = true;
    foreach($worldnews as $item) {
      echo "<li><strong>";
      echo $time->format("d.m.Y",$item["WorldNews"]["wnews_date"])." - ".$html->link($item["WorldNews"]["wnews_title"],array("controller"=>"worldnews","action"=>"view",$item["WorldNews"]["wnews_id"]))." by ".$item["User"]["username"]."</strong><br>";
      if ($first) {
        echo $text->trim($bbcode->strip($item["WorldNews"]["wnews_text"]),1000,"...",false);
        $first = false;
      } else {
        echo $text->trim($bbcode->strip($item["WorldNews"]["wnews_text"]),200,"...",false);
      }
      echo "</li>";
  }?>
</ul>
  </div>
</div>
<div class="yui-g">
  <div class="yui-u first">
<h2>Latest games</h2>
<ul class="games">
<? foreach($games as $game) {
  echo "<li><strong>";
  # echo date("d.m.Y",strtotime($item["News"]["post_date"]))." - ";
  echo $html->link($game["Game"]["game_name"],array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]));
  echo "</strong><br>".$text->trim($game["Game"]["description"],200,"...",false);
  echo "</li>";
}?>
</ul>
  </div>
  <div class="yui-u">
<h2>Latest blogs</h2>
<ul class="blogs">
<? foreach($blogs as $blog) {
  echo "<li><strong>";
  echo $time->format("d.m.Y",$blog["Blog"]["created"]);
  echo " - ".$html->link($blog["Blog"]["title"],array("controller"=>"blogs","action"=> "view",$blog["Blog"]["entry_id"]))." by ".$blog["User"]["username"];
  echo "</strong><br>".$text->trim($bbcode->strip($blog["Blog"]["content"]),200,"...",false);
  echo "</li>";  
}?>
</ul>
  </div>
</div>
<div class="yui-g">
  <div class="yui-u first">
<h2>Latest reviews</h2>
<ul class="reviews">
<? foreach($reviews as $review) {
  echo "<li><strong>";
  echo $time->format("d.m.Y",$review["Review"]["added"]);
  echo " - ".$html->link($review["Review"]["review_title"],array("controller"=>"reviews","action"=> "view",$review["Review"]["review_id"]))." for ".$html->link($review["Game"]["game_name"],array("controller"=>"games","action"=>"view",$review["Game"]["game_id"]))." by ".$review["User"]["username"];
  echo "</strong><br>".$text->trim($bbcode->strip($review["Review"]["review_text"]),200,"...",false);
  echo "</li>";
}?>  
</ul>
  </div>
  <div class="yui-u">
<h2>Latest interviews</h2>
<ul class="reviews">
<? foreach($interviews as $item) {
  echo "<li><strong>";
  echo date("d.m.Y",strtotime($item["Interview"]["interview_date"]))." - ".$html->link($item["Interview"]["interview_title"],array("controller"=>"interviews","action"=>"view",$item["Interview"]["interview_id"]))." by ".$item["Interviewer"]["username"];
  echo "</strong><br>".$text->trim($item["Interview"]["text"],200,"...",false);
  echo "</li>";  
  }
?>
</ul>
  </div>
</div>
<div class="yui-g">

</div>