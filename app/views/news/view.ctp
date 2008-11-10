<h1><?=$news["News"]["news_title"]?></h1>
<p>by <?=$html->link($news["User"]["username"],array("controller"=>"users","action"=>"view",$news["User"]["user_id"]))?> at <?=$time->format("H:i d.m.Y",$news["News"]["post_date"])?></p>
<p><?=nl2br($news["News"]["news_text"])?></p>