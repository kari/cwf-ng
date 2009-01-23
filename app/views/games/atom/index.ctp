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
  $description = htmlspecialchars($game['Game']['description'],ENT_NOQUOTES,"UTF-8"); # FIXME: description should be parsed by BBCode.
  $game_name = htmlspecialchars($game["Game"]["game_name"],ENT_NOQUOTES,"UTF-8");
  $publisher_name = htmlspecialchars($game["Publisher"]["name"],ENT_NOQUOTES,"UTF-8");
  echo "<entry>";
  echo "<id>".$href."</id>"; # Required
  echo "<title>".$game_name."</title>"; # Required 
  echo "<updated>".$time->toAtom($game["Game"]["created"])."</updated>"; # Required
  echo "<author><name>".$publisher_name."</name></author>"; # Recommended
  echo "<link rel=\"alternate\" href=\"".$href."\" />"; # Must if no Content
  echo "<summary type=\"html\">".(($thumb_url) ? "<img src=\"".$thumb_url."\"/><br/>" : "").$description."</summary>"; 
  
  # SearchMonkey DataRSS
  echo '<y:adjunct version="1.0" name="com.curlysworldoffreeware.game">';
  echo '<y:item rel="dc:subject">';
  echo '<y:meta property="dc:title">'.$game_name.'</y:meta>';
  if ($thumb_url) echo '<y:item rel="media:Thumbnail" resource="'.$thumb_url.'"><y:meta property="media:width">150</y:meta></y:item>';
  echo '<y:item rel="dc:publisher"><y:meta property="vcard:fn">'.$publisher_name.'</y:meta></y:item>';
  echo '</y:item>';
  echo '</y:adjunct>';
  echo "</entry>\n";
/* TODO: Maybe simpler way to do this with a (own) AtomHelper. Problem is SearchMonkey DataRSS Adjuncts.  
  $entry = array(
    "id"=>$href,
    "title"=>$game["Game"]["game_name"],
    "updated"=>$game["Game"]["created"],
    "authors"=>array(array("name"=>$game["Publisher"]["name"])),
    "links"=>array(array("rel"=>"alternate","href"=>$href)),
    "summary"=>array("type"=>"html","content"=>$summary),
    "adjunct"=> ...
    ); 
    $atom->entry($entry);
*/
}
?>
