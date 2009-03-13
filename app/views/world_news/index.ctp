<div class="yui-ge">
  <div class="yui-u first">
<h1>World News</h1>
<ul class="news">
<? 
  foreach($wnews as $item) {
    echo "<li><strong>";
    echo $time->format("d.m.Y",$item["WorldNews"]["wnews_date"])." - ".$html->link($item["WorldNews"]["wnews_title"],array("controller"=>"world_news","action"=>"view",$item["WorldNews"]["wnews_id"]))." by ".$item["User"]["username"]."</strong><br>";
    echo $text->trim($bbcode->strip($item["WorldNews"]["wnews_text"]),1000,"...",false);
    echo "</li>";
}?>
</ul>
<?=$paginator->prev();?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next();?> &nbsp;
<?=$paginator->counter(); ?>
  </div>
  <div class="yui-u">
    <?=$this->element("adbox",array("style"=>"pw-skyscraper"))?>
  </div>
</div>