<? 
if(!isset($game_id)) { 
  $game = $this->requestAction('games/random/1');
  $title = "At Spotlights";
} else {
  $game = $this->requestAction("games/get/".$game_id);
  $title = $html->link($game["Game"]["game_name"],array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]));
}
?>
<h1><?=$title?></h1>
<? if (!isset($game_id)) {?>
<h2><?=$html->link($game["Game"]["game_name"],array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]))?></h2>
<? } ?>
<p>by <?=$html->link($game['Publisher']['name'],array("controller"=>"publishers","action"=>"view",$game["Publisher"]["publisher_id"]))?></p>
<?=$html->link($site->image($game["Screenshot"][0]["image_link"],array("width"=>150,"height"=>150,"title"=>$game["Game"]["game_name"],"alt"=>"Screenshot of ".$game["Game"]["game_name"])),array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]),array(),null,false)?><br>
<p><?=$bbcode->strip($text->trim($game["Game"]["description"],500,"... ".$html->link("(read more)",array("controller"=>"games","action"=>"view",$game["Game"]["game_id"])),false))?></p>
<p>CWF Crew rating:<br> <?=$site->drawStars($game["Game"]["site_rating"],6,false,array("/img/icons/award_star_gold_3.png","/img/icons/award_star_silver_3.png"))?> (<?=$game["Game"]["site_rating"]?> of 6)</p>
<?#=debug($game)?>