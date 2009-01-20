<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?
# Main
echo "<url><loc>".Router::url("/",true)."</loc><changefreq>daily</changefreq><priority>1.0</priority></url>\n";

# Games
foreach ($games as $item) {
  echo "<url>";
  echo "<loc>".Router::url(array('controller'=>'games','action'=>'view','id'=>$item['Game']['game_id']),true)."</loc>";
  echo "<lastmod>".$time->toAtom($item['Game']['created'])."</lastmod>";
# echo "<changefreq>weekly</changefreq>";
  echo "<priority>0.9</priority>";
  echo "</url>\n";
}

?>
</urlset>