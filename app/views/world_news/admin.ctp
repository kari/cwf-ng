<h1>World News</h1>
<p><?=$html->link("Add new",array("action"=>"add"),array("class"=>"add button"))?></p>
<ul class="news">
<? 
  foreach($wnews as $item) {
    echo "<li><strong>";
    echo $time->format("d.m.Y",$item["WorldNews"]["wnews_date"])." - ".$html->link($item["WorldNews"]["wnews_title"],array("controller"=>"world_news","action"=>"edit",$item["WorldNews"]["wnews_id"]))." by ".$item["User"]["username"]."</strong><br>";
    echo $text->trim($bbcode->strip($item["WorldNews"]["wnews_text"]),300,"...",false);
    echo "</li>";
}?>
</ul>
<?=$paginator->prev();?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next();?> &nbsp;
<?=$paginator->counter(); ?>