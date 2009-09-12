<? $this->pageTitle = "World News - ".$wnews["WorldNews"]["wnews_title"]; ?>
<h1><?=$wnews["WorldNews"]["wnews_title"]?></h1>
<p>by <?=$html->link($wnews["User"]["username"],array("controller"=>"users","action"=>"view",$wnews["User"]["user_id"]))?> at <?=$time->format("H:i d.m.Y",$wnews["WorldNews"]["wnews_date"])?></p>
<p><?=$bbcode->decode($wnews["WorldNews"]["wnews_text"])?></p>
<?
$youtube_id = false;
$pattern = "/v[\/\=]([A-Za-z0-9]+)/";
if (!empty($wnews["WorldNews"]["wnews_embedded"]) and preg_match($pattern,$wnews["WorldNews"]["wnews_embedded"],$youtube_id)) {
	$youtube_id = $youtube_id[1];
  echo '<object width="480" height="295"><param name="movie" value="http://www.youtube.com/v/'.$youtube_id.'&hl=en&fs=1&rel=0&color1=0x2b405b&color2=0x6b8ab6"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$youtube_id.'&hl=en&fs=1&rel=0&color1=0x2b405b&color2=0x6b8ab6" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="295"></embed></object>';
}
?>
<h3>Related links</h3>
<ul>
  <? if (!empty($wnews["WorldNews"]["wnews_ext_link"])) { echo "<li>".$html->link("More at ".parse_url($wnews["WorldNews"]["wnews_ext_link"],PHP_URL_HOST),$wnews["WorldNews"]["wnews_ext_link"])."</li>"; } ?>
  <? if ($youtube_id) { echo "<li>".$html->link("YouTube video","http://www.youtube.com/watch?v=".$youtube_id)."</li>"; } 
  ?>
</ul>