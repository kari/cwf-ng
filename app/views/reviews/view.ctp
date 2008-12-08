<?
  $this->pageTitle = "Review of '".$review["Game"]["game_name"]."': ".$review["Review"]["review_title"];
?>
<div class="yui-ge">
  <div class="yui-u first">
<h1><?=$review["Review"]["review_title"]?></h1>
<p>A review of <?=$html->link($review["Game"]["game_name"],array("controller"=>"games","action"=>"view",$review["Game"]["game_id"]))?> by <?=$html->link($review["User"]["username"],array("controller"=>"users","action"=>"view",$review["User"]["user_id"]))?> on <?=$time->format("d.m.Y",$review["Review"]["added"])?></p>
<p>
  <?=$bbcode->decode(iconv("ISO-8859-1","UTF-8",$review["Review"]["review_text"]))?>
  <? # FIXME: DB's ISO-8859-1, Site is UTF-8, but we can't just fill the scripts with iconv! Anyway, bbcode chokes on invalid charsets.?>
</p>
  </div>
  <div class="yui-u">
    <!-- right bar -->
    <?=$this->element("spotlight",array("game_id"=>$review["Game"]["game_id"],"cache"=>array("key"=>$review["Game"]["game_id"],"time"=>"+1 day")));?>
    <?=$this->element("adbox",array("style"=>"pw-skyscraper"))?>
    
  </div>
</div>