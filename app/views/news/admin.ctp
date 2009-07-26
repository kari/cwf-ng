<h1>Admin News</h1>
<p><?=$html->link("Add new",array("action"=>"add"),array("class"=>"add button"))?></p>
<ul class="news">
<? 
  foreach($news as $item) {
    echo "<li><strong>";
    echo $time->format("d.m.Y",$item["News"]["post_date"])." - ".$html->link($item["News"]["news_title"],array("controller"=>"news","action"=>"edit",$item["News"]["news_id"]))." by ".$item["User"]["username"]."</strong>";
    echo " ".$html->link($html->image("/img/icons/application_edit.png",array("alt"=>"Edit","title"=>"Edit")),array("action"=>"edit",$item["News"]["news_id"]),array(),null,false);
    echo " ".$html->link($html->image("/img/icons/application_delete.png",array("alt"=>"Delete","title"=>"Delete")),array("action"=>"delete",$item["News"]["news_id"]),array(),"Are you sure you want to delete this news item?",false);
    echo "<br>";
    echo $text->trim($bbcode->strip($item["News"]["news_text"]),300,"...",false);
    echo "</li>";
}?>
</ul>
<?=$paginator->prev();?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next();?> &nbsp;
<?=$paginator->counter(); ?>
