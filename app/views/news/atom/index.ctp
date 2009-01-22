<?
$this->set("feedData",array("title"=>"CWF: Recent News"));

foreach($news as $item) {
  $href = $html->url(array("controller"=>"news","action"=>"view",$item["News"]["news_id"]),true);
  echo "<entry>";
  echo "<id>".$href."</id>"; # Required
  echo "<title>".htmlspecialchars($item["News"]["news_title"],ENT_NOQUOTES,"UTF-8")."</title>"; # Required 
  $updated = (isset($item["News"]["last_edit_time"]) ? $item["News"]["last_edit_time"] : $item["News"]["post_date"]);
  echo "<updated>".$time->toAtom($updated)."</updated>"; # Required
  echo "<author><name>".$item["User"]["username"]."</name></author>"; # Recommended
  echo "<published>".$time->toAtom($item["News"]["post_date"])."</published>"; # Optional
  echo "<link rel=\"alternate\" href=\"".$href."\" />"; # Must if no Content
  echo "<content type=\"html\">".htmlspecialchars(nl2br($item["News"]["news_text"]),ENT_NOQUOTES,"UTF-8")."</content>";
  echo "</entry>\n";
}

?>