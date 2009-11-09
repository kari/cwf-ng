<? 
/*
  In a view, you can assign $this->set("feedData",array("id"=>...)) to set feed information
  id  required  Feed ID, should be globally unique. Default "tag:" + feed's url
  title  required Human-readable title for feed. Default CakePHP's $title_for_layout
  updated required  Time when feed was substantially updated. Defaults now.
  alternate  optional  URL to alternate (e.g. HTML) view of content. Default feed's url - ".atom"
  self  optional  URL to this feed. Default discover self using Router::url()
  
  Output <entry>s in view. This layout does nothing to them.
  
  FIXME: All URLs are should be escaped properly for XML.
*/
echo '<?xml version="1.0" encoding="utf-8"?>'; 
echo '<?profile http://search.yahoo.com/searchmonkey-profile ?>'; # FIXME: This screws up in caching, because of php short tags.
?>
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:y="http://search.yahoo.com/datarss/">
  <id><?=(isset($feedData["id"]) ? $feedData["id"] : Router::url(null,true))?></id>
  <title type="text"><?=(isset($feedData["title"]) ? $feedData["title"] : $title_for_layout) ?></title>
  <updated><?=(isset($feedData["updated"]) ? $time->toAtom($feedData["updated"]) : $time->toAtom(time()))?></updated>
  <link href="<?=(isset($feedData["alternate"]) ? $feedData["alternate"] : substr(Router::url(null,true),0,-5))?>" rel="alternate"/>
  <link href="<?=(isset($feedData["self"]) ? $feedData["self"] : Router::url(null,true))?>" rel="self"/>
  <author>
    <name>Curly's World of Freeware</name>
    <uri><?="http://".Configure::read("Site.url")."/"?></uri>
  </author>
  <icon><?=$html->url("/favicon.ico",true)?></icon>
  <generator uri="<?="http://".Configure::read("Site.url")."/"?>">CWF CMS</generator>
  <rights type="text">http://creativecommons.org/licenses/by-nc-nd/3.0/</rights>
<? echo $content_for_layout ?>
</feed>
