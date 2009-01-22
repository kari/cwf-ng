<?
# Set Feed data.
$this->set("feedData",array("title"=>"Recent Games"));

foreach($games as $game) {
  $href = $html->url(array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]),true);
  if (!empty($game["Screenshot"])) {
    $thumb_url = $site->image_url($game["Screenshot"][0]["image_link"],array("width"=>150,"height"=>150),true); 
  } else {
    $thumb_url = null;
  }
  $description = htmlspecialchars($game['Game']['description'],ENT_NOQUOTES,"UTF-8"); # FIXME: <br>'s and other tags should be encoded. This is part of the bigger MySQL & ISO-8859-
  $game_name = htmlspecialchars($game["Game"]["game_name"],ENT_NOQUOTES,"UTF-8"); # Problem with encodings!
  $publisher_name = htmlspecialchars($game["Publisher"]["name"],ENT_NOQUOTES,"UTF-8");
  echo "<entry>";
  echo "<id>".$href."</id>"; # Required
  echo "<title>".$game_name."</title>"; # Required 
  echo "<updated>".$time->toAtom($game["Game"]["created"])."</updated>"; # Required
  echo "<author><name>".$publisher_name."</name></author>"; # Recommended
  echo "<link rel=\"alternate\" href=\"".$href."\" />"; # Must if no Content
  echo "<summary type=\"html\">".(($thumb_url) ? "<img src=\"".$thumb_url."\"/><br/>" : "").$description."</summary>"; # FIXME: <br>'s and other tags should be encoded. This is part of the bigger MySQL & ISO-8859-1 & UTF-8 & BBCode & XML encoding problem.
  # SearchMonkey DataRSS
  echo '<y:adjunct version="1.0" name="com.curlysworldoffreeware.game">';
  echo '<y:item rel="dc:subject">';
  echo '<y:meta property="dc:title">'.$game["Game"]["game_name"].'</y:meta>';
  if ($thumb_url) echo '<y:item rel="media:Thumbnail" resource="'.$thumb_url.'"><y:meta property="media:width">150</y:meta></y:item>';
  echo '<y:item rel="dc:publisher"><y:meta property="vcard:fn">'.$publisher_name.'</y:meta></y:item>';
  echo '</y:item>';
  echo '</y:adjunct>';
  echo "</entry>\n";
}
?>
