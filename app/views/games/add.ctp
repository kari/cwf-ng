<h1>Add game</h1>
<p>On this screen just fill in the basic information. Add as much (or as little) as you know about the game. You willll be able to edit everything and add screenshots and files later on the next screen.</p> 
<?
  echo $form->create("Game");
  echo "<fieldset><legend>Basic information</legend>";
  echo $form->input("game_name",array("label"=>"Game name"));
  echo $form->input("year",array("maxLength"=>4));
  echo $form->input("publisher_id",array("empty"=>"(empty publisher)"));
  echo "<em>If publisher is not listed, leave this empty. You can add new publishers in the next screen.</em>";
  echo $form->input("site",array("label"=>"Website","value"=>($this->data["Game"]["site"] ? $this->data["Game"]["site"] : "http://")));
  echo $form->input("description",array("between"=>"<br>","rows"=>10));
  echo $form->input("requirements",array("label"=>"Requirements (optional)","between"=>"<br>","rows"=>2));
  echo "</fieldset>";
?>
<fieldset>
  <legend>Genres</legend>
<?
  asort($GENRE);
  $cols = ceil(count($GENRE)/3.0);
  $i = 0;
  echo "<table></tr><td>";
  foreach($GENRE as $genre => $title) {
    if (($i % $cols == 0) && ($i >0)) { echo '</td><td>'; }
    $i++;
    echo $form->input("Genres.".$genre,array("type"=>"checkbox","label"=>$title,"div"=>false,"after"=>"<br>"));
  }
  echo "</td></tr></table>";
?>

</fieldset>

<fieldset>
  <legend>Platforms</legend>
<?
  asort($OSYSTEM);
  $cols = ceil(count($OSYSTEM)/3.0);
  $i = 0;
  echo "<table></tr><td>";
  foreach($OSYSTEM as $os => $title) {
    if (($i % $cols == 0) && ($i >0)) { echo '</td><td>'; }
    $i++;
    echo $form->input("Specs.".$os,array("type"=>"checkbox","label"=>$title,"div"=>false,"after"=>"<br>"));
  }
  echo "</td></tr></table>";
?>
</fieldset>
<fieldset><legend>Site info</legend>
<?
  echo $form->input("forum_link",array("label"=>"Forum topic","value"=>($this->data["Game"]["forum_link"] ? $this->data["Game"]["forum_link"] : "http://")));
  echo $form->input("site_rating",array("type"=>"select","label"=>"GH Score","options"=>array(0,1,2,3,4,5,6)));
  
  echo $form->input("download_status",array("type"=>"select","options"=>$DL_STATUS,"selected"=>-1,"disabled"=>true));
  echo $form->input("lisence",array("label"=>"License","type"=>"select","options"=>$LICENSE,"selected"=>1));
  
  echo $form->input("game_proposer_id",array("selected"=>$user_id));
  echo $form->input("game_hunter_id",array("selected"=>$user_id));
?>
</fieldset>
<?
  echo $form->end("Save");
?>
<p>The game will be saved to the database when you click "Save", but will not be visible on the site until you have set its download status.</p>