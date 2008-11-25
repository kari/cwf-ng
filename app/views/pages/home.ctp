<? $this->pageTitle = "CWF-Freeware"; ?>
<h1>Welcome to CWF-Freeware</h1>

<h2>Latest news</h2>
<ul>
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
<h2>Latest games</h2>
<ul>
<? foreach($games as $game) {
  echo "<li><strong>";
  # echo date("d.m.Y",strtotime($item["News"]["post_date"]))." - ";
  echo $html->link($game["Game"]["game_name"],array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]));
  echo "</strong><br>".$text->trim($game["Game"]["description"],200,"...",false);
  echo "</li>";
}?>
</ul>
<h2>Latest blogs</h2>
<ul>
<? foreach($blogs as $blog) {
  echo "<li><strong>";
  echo $time->format("d.m.Y",$blog["Blog"]["created"]);
  echo " - ".$html->link($blog["Blog"]["title"],array("controller"=>"blogs","action"=> "view",$blog["Blog"]["entry_id"]))." by ".$blog["User"]["username"];
  echo "</strong><br>".$text->trim($bbcode->strip($blog["Blog"]["content"]),200,"...",false);
  echo "</li>";  
}?>
</ul>
<h2>Latest reviews</h2>
<ul>
<? foreach($reviews as $review) {
  echo "<li><strong>";
  echo $time->format("d.m.Y",$review["Review"]["added"]);
  echo " - ".$html->link($review["Review"]["review_title"],array("controller"=>"reviews","action"=> "view",$review["Review"]["review_id"]))." for ".$html->link($review["Game"]["game_name"],array("controller"=>"games","action"=>"view",$review["Game"]["game_id"]))." by ".$review["User"]["username"];
  echo "</strong><br>".$text->trim($review["Review"]["review_text"],200,"...",false);
  echo "</li>";
}?>  
</ul>
<h2>Latest interviews</h2>
<ul>
<?/* foreach($interviews as $item) {
  echo "<li><strong>";
  echo date("d.m.Y",strtotime($item["News"]["post_date"]))." - ".$html->link($item["News"]["news_title"],array("controller"=>"news","action"=>"view",$item["News"]["news_id"]))." by ".$item["User"]["username"];
  echo "</strong><br>".$text->trim($item["News"]["news_text"],200,"...",false);
  echo "</li>";  } */
  echo "<li>Not implemented</li>";
?>
</ul>
<?=$this->element("adbox",array("style"=>"wide")) ?>
<?=$this->element("spotlight")?>