<? # Page initalization
$this->pageTitle = "CWF-Freeware"; 
$html->css("jquery.scrollable","stylesheet",array("media"=>"screen"),false);
$javascript->link("/js/jquery.tools.min.js",false);
$html->meta("atom","/games/index.atom",array("title"=>"CWF – Recent games","rel"=>"alternate"),false);
?>
<? # Page-specific jQuery code: 
  echo $javascript->codeBlock("$(document).ready(function() {
    $('div.scrollable').scrollable({
      size: 4,
    }).navigator();
    });")
?>
<div class="yui-g">
<h1>Welcome to CWF-Freeware</h1>
<cake:nocache>
<? 
# Show different content to registered users.
if ($session->check("Auth.User.user_id")) {
  # echo $this->element("gvsg");
} else {
  echo $this->element("adbox",array("style"=>"pw-leaderboard"));
}
?>
</cake:nocache>

<h2>Latest games</h2>
<!-- navigator --> 
<div class="navi"></div>  
<!-- prev link --> 
<a class="prev"></a>
<!-- root element for scrollable --> 
<div class="scrollable"> 
    <!-- root element for the items --> 
    <div class="items"> 
      <? 
      foreach($scrollable_games as $game) {
        if (!empty($game["Screenshot"])) {
          echo "<div>".$site->image($game["Screenshot"][0]["image_link"],array("width"=>150,"height"=>150,"title"=>$game["Game"]["game_name"])).$html->link("<h3>".$game["Game"]["game_name"]."</h3>",array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]),array(),false,false)."</div>";
        } else {
          echo "<div>".$html->image("/img/cwf_nosshot.png",array("width"=>150,"height"=>150,"title"=>"No screenshot")).$html->link("<h3>".$game["Game"]["game_name"]."</h3>",array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]),array(),false,false)."</div>";
        }
      }
      ?>
    </div>
</div>
<!-- next link --> 
<a class="next"></a>

</div>
<div class="yui-g">
  <div class="yui-u first">
<h2>Latest site news</h2>
<ul class="news">
<? 
  $first = true;
  foreach($news as $item) {
    echo "<li><strong>";
    echo $time->format("M Y",$item["News"]["post_date"])." - ".$html->link($item["News"]["news_title"],array("controller"=>"news","action"=>"view",$item["News"]["news_id"]))." by ".$item["User"]["username"]."</strong><br>";
    if ($first) {
      echo $text->trim($bbcode->strip($item["News"]["news_text"]),1000,"...",false);
      $first = false;
    } else {
      echo $text->trim($bbcode->strip($item["News"]["news_text"]),200,"...",false);
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
      echo $time->format("M Y",$item["WorldNews"]["wnews_date"])." - ".$html->link($item["WorldNews"]["wnews_title"],array("controller"=>"world_news","action"=>"view",$item["WorldNews"]["wnews_id"]))." by ".$item["User"]["username"]."</strong><br>";
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
<h2>Latest reviews</h2>
<ul class="reviews">
<? foreach($reviews as $review) {
  echo "<li><strong>";
  # echo $time->format("M Y",$review["Review"]["added"])." - ";
  echo $html->link($review["Review"]["review_title"],array("controller"=>"reviews","action"=> "view",$review["Review"]["review_id"]))." for ".$html->link($review["Game"]["game_name"],array("controller"=>"games","action"=>"view",$review["Game"]["game_id"]))." by ".$review["User"]["username"];
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
  # echo date("M Y",strtotime($item["Interview"]["interview_date"]))." - ";
	echo $html->link($item["Interview"]["interview_title"],array("controller"=>"interviews","action"=>"view",$item["Interview"]["interview_id"]))." by ".$item["Interviewer"]["username"];
  echo "</strong><br>".$text->trim($bbcode->strip($item["Interview"]["text"]),200,"...",false);
  echo "</li>";  
  }
?>
</ul>
  </div>
</div>
<div class="yui-g">
<? # Nothing here... ?>
</div>