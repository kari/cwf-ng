<?
  $html->meta("atom","index.atom",array("title"=>"Recent news","rel"=>"alternate"),false);
?>
<div class="yui-ge">
  <div class="yui-u first">
<h1>Site News</h1>
<ul class="news">
<? 
	$cur_month = null;
  foreach($news as $item) {
		if ($time->format("F Y",$item["News"]["post_date"]) <> $cur_month) {
			$cur_month = $time->format("F Y",$item["News"]["post_date"]);
			echo "<h2>".$cur_month."</h2>";
		}	
    echo "<li><strong>";
    echo $html->link($item["News"]["news_title"],array("controller"=>"news","action"=>"view",$item["News"]["news_id"]))." by ".$item["User"]["username"]." on ".$time->format("d.m.Y",$item["News"]["post_date"])."</strong><br>";
    echo $text->trim($bbcode->strip($item["News"]["news_text"]),1000,"...",false);
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