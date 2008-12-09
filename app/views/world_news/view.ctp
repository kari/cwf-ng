<? $this->pageTitle = "World News - ".$wnews["WorldNews"]["wnews_title"]; ?>
<h1><?=$wnews["WorldNews"]["wnews_title"]?></h1>
<p>by <?=$html->link($wnews["User"]["username"],array("controller"=>"users","action"=>"view",$wnews["User"]["user_id"]))?> at <?=$time->format("H:i d.m.Y",$wnews["WorldNews"]["wnews_date"])?></p>
<p><?=$bbcode->decode(iconv("ISO-8859-1","UTF-8",$wnews["WorldNews"]["wnews_text"]))?></p>
<h3>Related links</h3>
<ul>
  <? if (!empty($wnews["WorldNews"]["wnews_ext_link"])) { echo "<li>".$html->link("External link related to this news",$wnews["WorldNews"]["wnews_ext_link"])."</li>"; } ?>
  <? if (!empty($wnews["WorldNews"]["wnews_embedded"])) { echo "<li>".$html->link("YouTube video",$wnews["WorldNews"]["wnews_embedded"])."</li>"; } 
  # TODO: Embed YouTube-link into the webpage.
  ?>
</ul>