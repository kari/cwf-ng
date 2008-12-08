<? $this->pageTitle = $blog["User"]["username"]."'s Blog: ".$blog["Blog"]["title"];?>
<div class="yui-ge">
  <div class="yui-u first">
<h1><?=$blog['Blog']['title']?></h1>
<p>Created by <?=$blog['User']['username']?> at <?=$time->format("d.m.Y H:i",$blog['Blog']['created'])?></p>
<p><?=$bbcode->decode($blog['Blog']['content'])?></p>
<? #TODO: Comments? ?>
  </div>
  <div class="yui-u">
  <? # right bar, next/previous, earlier blog posts...?>
  <h1>Other entries</h1>
  </div>
</div>