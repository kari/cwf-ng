<cake:nocache>
<?
$games = $this->requestAction('games/random/2');
?>
<h1>Game VS Game</h1>
<?#=$form->create("",array("url"=>"/gvsg/vote")); ?>
<form method="post" action="<?=$html->url("/gvsg/vote")?>"><fieldset style="display:none;"><input type="hidden" name="_method" value="POST" /></fieldset>
<table>
  <tr><td>
<label for="gvsg1"><?=$site->image($games[0]["Screenshot"][0]["image_link"],array("width"=>150,"height"=>150))?></label><br>
<input type="radio" name="data[gvsg][winner]" value="0" id="gvsg1">&nbsp;<?=$html->link($games[0]["Game"]["game_name"],array("controller"=>"games","action"=>"view",$games[0]["Game"]["game_id"]))?>
<?#=$form->hidden("Game.0.game_id",array("value"=>$games[0]["Game"]["game_id"]))?>
<input type="hidden" name="data[Game][0][game_id]" value="<?=$games[0]["Game"]["game_id"]?>">
</td></tr>
<tr><td style="text-align:center"><strong>VS</strong></td></tr>
<tr><td>
<label for="gvsg2"><?=$site->image($games[1]["Screenshot"][0]["image_link"],array("width"=>150,"height"=>150))?></label><br>
<input type="radio" name="data[gvsg][winner]" value="1" id="gvsg2">&nbsp;<?=$html->link($games[1]["Game"]["game_name"],array("controller"=>"games","action"=>"view",$games[1]["Game"]["game_id"]))?>
<?#=$form->hidden("Game.1.game_id",array("value"=>$games[1]["Game"]["game_id"]))?>
<input type="hidden" name="data[Game][1][game_id]" value="<?=$games[1]["Game"]["game_id"]?>">
<?#=$form->hidden("User.user_id",array("value"=>$session->read("Auth.User.user_id")))?>
<input type="hidden" name="data[User][user_id]" value="<?=$session->read("Auth.User.user_id")?>">
</td></tr>
<?#=$form->end("Vote")?>
<tr><td style="text-align:center">
<input type="submit" value="Vote" /></form>
</td></tr>
</table>
</cake:nocache>