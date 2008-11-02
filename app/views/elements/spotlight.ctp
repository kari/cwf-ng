<h1>At Spotlights</h1>
<? $game = $this->requestAction('games/view'); ?>
<h2><?=$html->link($game[0]["Game"]["game_name"],array("controller"=>"games","action"=>"view",$game[0]["Game"]["game_id"]))?></h2>
<p><small>by <?=$html->link($game[0]['Publisher']['name'],array("controller"=>"publishers","action"=>"view",$game[0]["Publisher"]["publisher_id"]))?></small></p>
<?=$html->image("http://www.curlysworldoffreeware.com/".$game[0]["Screenshot"][0]["thumb_link"],array("width"=>100,"height"=>100))?><br>
<p><?=nl2br($text->trim($game[0]["Game"]["description"],500,"... ".$html->link("(read more)",array("controller"=>"games","action"=>"view",$game[0]["Game"]["game_id"])),false))?></p>
<p>CWF Crew rating <?=$game[0]["Game"]["site_rating"]?> of 6</p>