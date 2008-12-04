<h1>Site News</h1>
<ul class="news">
<? 
  foreach($news as $item) {
    echo "<li><strong>";
    echo $time->format("d.m.Y",$item["News"]["post_date"])." - ".$html->link($item["News"]["news_title"],array("controller"=>"news","action"=>"view",$item["News"]["news_id"]))." by ".$item["User"]["username"]."</strong><br>";
    echo $text->trim($bbcode->strip($item["News"]["news_text"]),1000,"...",false);
    echo "</li>";
}?>
</ul>
<?=$paginator->prev('« Previous ', null, null, array('class' => 'disabled'));?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next(' Next »', null, null, array('class' => 'disabled'));?> &nbsp;
<?=$paginator->counter(); ?>