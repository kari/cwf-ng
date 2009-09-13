<?
# Set Feed data.
$this->set("feedData",array("title"=>"Sitemap for CWF","self"=>"http://".Configure::read("Site.url")."/sitemap.atom","id"=>"tag:".Configure::read("Site.url")."/sitemap.atom"));

# Main
echo "<entry<title>Curly's World of Freeware</title><id>".Router::url("/",true)."</id><updated>".$time->toAtom(time())."</updated><link rel=\"alternate\" href=\"".Router::url("/",true)."\" /></entry>\n";

# TODO: How to handle rest of Atom Sitemap. Put everything here (even though XML version does that better), have many different Sitemaps that link (even though that also could be done in XML) (and anyway, in that case there would only be recent objects)

?>
