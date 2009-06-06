<?
  $this->pageTitle = "Review of '".$review["Game"]["game_name"]."': ".$review["Review"]["review_title"];
?>
<div class="yui-ge">
  <div class="yui-u first">
    <div class="hreview" lang="en">
      <h1 class="summary"><?=$review["Review"]["review_title"]?></h1>
      <p>A review of <span class="item"><?=$html->link($review["Game"]["game_name"],array("controller"=>"games","action"=>"view",$review["Game"]["game_id"]),array("class"=>"url fn"))?></span> by <span class="reviewer vcard"><?=$html->link($review["User"]["username"],array("controller"=>"users","action"=>"view",$review["User"]["user_id"]),array("class"=>"fn url"))?></span> on <abbr class="dtreviewed" title="<?=$time->format("c",$review["Review"]["added"])?>"><?=$time->format("d.m.Y",$review["Review"]["added"])?></abbr></p>
      <div class="description">
        <p><?=$bbcode->decode($review["Review"]["review_text"])?></p>
      </div>
    </div>
  </div>
  <div class="yui-u">
  <!-- right bar -->
    <?=$this->element("spotlight",array("game_id"=>$review["Game"]["game_id"],"cache"=>array("key"=>$review["Game"]["game_id"],"time"=>"+1 day")));?>
    <?=$this->element("adbox",array("style"=>"pw-skyscraper"))?>
    
  </div>
</div>