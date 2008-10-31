<h1>Game Vs Game</h1>
<?=$form->create("",array("action"=>"gvsg")); ?>
<table>
  <tr><td>
<?=$html->image("http://www.curlysworldoffreeware.com/".$games[0]["Screenshot"][0]["thumb_link"],array("width"=>100,"height"=>100))?><br>
<?=$html->link($games[0]["Game"]["game_name"],array("action"=>"view",$games[0]["Game"]["game_id"]))?>
<br><input type="radio" name="data[gvsg][winner]" value="0">
<?=$form->hidden("Game.0.game_id",array("value"=>$games[0]["Game"]["game_id"]))?>
</td><td>
<?=$html->image("http://www.curlysworldoffreeware.com/".$games[1]["Screenshot"][0]["thumb_link"],array("width"=>100,"height"=>100))?><br>
<?=$html->link($games[1]["Game"]["game_name"],array("action"=>"view",$games[1]["Game"]["game_id"]))?>
<br><input type="radio" name="data[gvsg][winner]" value="1">
<?=$form->hidden("Game.1.game_id",array("value"=>$games[1]["Game"]["game_id"]))?>
</td></tr>
</table>
<?=$form->end("Vote")?>