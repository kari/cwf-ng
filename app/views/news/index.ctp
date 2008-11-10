<h1>Site News</h1>
<ul>
<? 
  foreach($news as $item) {
    echo "<li><strong>";
    echo $time->format("d.m.Y",$item["News"]["post_date"])." - ".$html->link($item["News"]["news_title"],array("controller"=>"news","action"=>"view",$item["News"]["news_id"]))." by ".$item["User"]["username"]."</strong> ".$html->link("(edit)",array("controller"=>"news","action"=>"edit",$item["News"]["news_id"]))."<br>";
    echo $text->trim($item["News"]["news_text"],1000,"...",false);
    echo "</li>";
}?>
</ul>
<?=$paginator->prev('« Previous ', null, null, array('class' => 'disabled'));?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next(' Next »', null, null, array('class' => 'disabled'));?> &nbsp;
<?=$paginator->counter(); ?>