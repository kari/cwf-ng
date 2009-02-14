<? $this->pageTitle = "World News - ".$wnews["WorldNews"]["wnews_title"]; ?>
<h1><?=$wnews["WorldNews"]["wnews_title"]?></h1>
<p>by <?=$html->link($wnews["User"]["username"],array("controller"=>"users","action"=>"view",$wnews["User"]["user_id"]))?> at <?=$time->format("H:i d.m.Y",$wnews["WorldNews"]["wnews_date"])?></p>
<p><?=$bbcode->decode($wnews["WorldNews"]["wnews_text"])?></p>
<?
if (!empty($wnews["WorldNews"]["wnews_embedded"])) {
  echo '<object width="480" height="295"><param name="movie" value="'.$wnews["WorldNews"]["wnews_embedded"].'&hl=en&fs=1&rel=0&color1=0x2b405b&color2=0x6b8ab6"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="'.$wnews["WorldNews"]["wnews_embedded"].'&hl=en&fs=1&rel=0&color1=0x2b405b&color2=0x6b8ab6" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="295"></embed></object>';
}
?>
<h3>Related links</h3>
<ul>
  <? if (!empty($wnews["WorldNews"]["wnews_ext_link"])) { echo "<li>".$html->link("External link related to this news",$wnews["WorldNews"]["wnews_ext_link"])."</li>"; } ?>
  <? if (!empty($wnews["WorldNews"]["wnews_embedded"])) { echo "<li>".$html->link("YouTube video",$wnews["WorldNews"]["wnews_embedded"])."</li>"; } 
  ?>
</ul>