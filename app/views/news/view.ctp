<? $this->pageTitle = "News - ".$news["News"]["news_title"]; ?>
<h1><?=$news["News"]["news_title"]?></h1>
<p>by <?=$html->link($news["User"]["username"],array("controller"=>"users","action"=>"view",$news["User"]["user_id"]))?> at <?=$time->format("H:i d.m.Y",$news["News"]["post_date"])?>
<?
  if ($news["News"]["edited_by"]) { echo "<br><em>(edited by ".$html->link($news["Editor"]["username"],array("controller"=>"users","action"=>"view",$news["Editor"]["user_id"]))." at ".$time->format("H:i d.m.Y",$news["News"]["last_edit_time"]).")</em>"; }
?>  
</p>
<p><?=$bbcode->decode($news["News"]["news_text"])?></p>