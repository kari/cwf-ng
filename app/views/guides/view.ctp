<?
  $this->pageTitle = "Guide for '".$guide["Game"]["game_name"]."': ".$guide["Guide"]["title"];
?>
<div class="yui-ge">
  <div class="yui-u first">
<h1><?=$guide["Guide"]["title"]?></h1>
<p>A guide for <?=$html->link($guide["Game"]["game_name"],array("controller"=>"games","action"=>"view",$guide["Game"]["game_id"]))?> by <?=$html->link($guide["User"]["username"],array("controller"=>"users","action"=>"view",$guide["User"]["user_id"]))?> on <?=$time->format("d.m.Y",$guide["Guide"]["created"])?></p>
<p>
  <?=$bbcode->decode($guide["Guide"]["text"])?>
</p>
  </div>
  <div class="yui-u">
    <!-- right bar -->
    <?=$this->element("spotlight",array("game_id"=>$guide["Game"]["game_id"],"cache"=>array("key"=>$guide["Game"]["game_id"],"time"=>"+1 day")));?>
    <?=$this->element("adbox",array("style"=>"pw-skyscraper"))?>
    
  </div>
</div>