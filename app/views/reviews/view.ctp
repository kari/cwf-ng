<?
  $this->pageTitle = "Review of '".$review["Game"]["game_name"]."': ".$review["Review"]["review_title"];
?>
<div class="yui-ge">
  <div class="yui-u first">
<h1><?=$review["Review"]["review_title"]?></h1>
<p>A review of <?=$html->link($review["Game"]["game_name"],array("controller"=>"games","action"=>"view",$review["Game"]["game_id"]))?> by <?=$html->link($review["User"]["username"],array("controller"=>"users","action"=>"view",$review["User"]["user_id"]))?> on <?=$time->format("d.m.Y",$review["Review"]["added"])?></p>
<p>
  <?=$bbcode->decode($review["Review"]["review_text"])?>
</p>
  </div>
  <div class="yui-u">
    <!-- right bar -->
    <?=$this->element("spotlight",array("game_id"=>$review["Game"]["game_id"],"cache"=>array("key"=>$review["Game"]["game_id"],"time"=>"+1 day")));?>
    <?=$this->element("adbox",array("style"=>"pw-skyscraper"))?>
    
  </div>
</div>