<?  # This could also live as some kind of an Element.
    $this->pageTitle = "Game vs. Game"; ?>
<h1>Game Vs Game</h1>
<?=$form->create("",array("controller"=>"gvsg","action"=>"vote")); ?>
<table>
  <tr><td>
<?=$site->image($games[0]["Screenshot"][0]["image_link"],array("width"=>100,"height"=>100))?><br>
<?=$html->link($games[0]["Game"]["game_name"],array("controller"=>"games","action"=>"view",$games[0]["Game"]["game_id"]))?>
<br><input type="radio" name="data[gvsg][winner]" value="0">
<?=$form->hidden("Game.0.game_id",array("value"=>$games[0]["Game"]["game_id"]))?>
</td><td>
vs.
</td><td>
<?=$site->image($games[1]["Screenshot"][0]["image_link"],array("width"=>100,"height"=>100))?><br>
<?=$html->link($games[1]["Game"]["game_name"],array("controller"=>"games","action"=>"view",$games[1]["Game"]["game_id"]))?>
<br><input type="radio" name="data[gvsg][winner]" value="1">
<?=$form->hidden("Game.1.game_id",array("value"=>$games[1]["Game"]["game_id"]))?>
<?=$form->hidden("User.user_id",array("value"=>$session->read("Auth.User.user_id")))?>
</td></tr>
</table>
<?=$form->end("Vote")?>