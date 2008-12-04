<h1>At Spotlights</h1>
<? $game = $this->requestAction('games/random/1'); ?>
<h2><?=$html->link($game[0]["Game"]["game_name"],array("controller"=>"games","action"=>"view",$game[0]["Game"]["game_id"]))?></h2>
<p>by <?=$html->link($game[0]['Publisher']['name'],array("controller"=>"publishers","action"=>"view",$game[0]["Publisher"]["publisher_id"]))?></p>
<?=$site->image($game[0]["Screenshot"][0]["image_link"],array("width"=>150,"height"=>150))?><br>
<p><?=$bbcode->strip($text->trim($game[0]["Game"]["description"],500,"... ".$html->link("(read more)",array("controller"=>"games","action"=>"view",$game[0]["Game"]["game_id"])),false))?></p>
<p>CWF Crew rating:<br> <?=$site->drawStars($game[0]["Game"]["site_rating"],6,false,array("/img/icons/award_star_gold_3.png","/img/icons/award_star_silver_3.png"))?> (<?=$game[0]["Game"]["site_rating"]?> of 6)</p>