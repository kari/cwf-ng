<?
# Set Feed data.
$this->set("feedData",array("title"=>$user["User"]["username"]."'s Blog"));

foreach($blogs as $blog) {
  $href = $html->url(array("controller"=>"blogs","action"=>"view",$blog["Blog"]["entry_id"]),true);
  $content = htmlspecialchars($blog['Blog']['content'],ENT_NOQUOTES,"UTF-8"); # FIXME: description should be parsed by BBCode.
  $title = htmlspecialchars($blog["Blog"]["title"],ENT_NOQUOTES,"UTF-8");
  $user = htmlspecialchars($blog["User"]["username"],ENT_NOQUOTES,"UTF-8");
  echo "<entry>";
  echo "<id>".$href."</id>"; # Required
  echo "<title>".$title."</title>"; # Required 
  echo "<published>".$time->toAtom($blog["Blog"]["created"])."</published>"; # Optional
  echo "<updated>".$time->toAtom($blog["Blog"]["modified"])."</updated>"; # Required
  echo "<author><name>".$user."</name></author>"; # Recommended
  echo "<link rel=\"alternate\" href=\"".$href."\" />"; # Must if no Content
  echo "<content type=\"html\">".$content."</content>";
  echo "</entry>";
  

}
?>
