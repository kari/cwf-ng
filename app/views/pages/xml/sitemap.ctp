<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?
# FIXME: Should instead create an array like in sitemapper.php, because there's a 50 000 liimt. Yes, we're far from that right now.
# Main
echo "<url><loc>".Router::url("/",true)."</loc><changefreq>daily</changefreq><priority>1.0</priority></url>\n";

# Pages
$pages = array("/sitemap");
foreach ($pages as $item) {
    echo "<url>";
    echo "<loc>".Router::url($item,true)."</loc>";
    echo "<priority>0.1</priority>";
    echo "</url>\n";  
}

# Games
foreach ($games as $item) {
  echo "<url>";
  echo "<loc>".Router::url(array('controller'=>'games','action'=>'view','id'=>$item['Game']['game_id']),true)."</loc>";
  echo "<lastmod>".$time->toAtom($item['Game']['created'])."</lastmod>";
# echo "<changefreq>weekly</changefreq>";
  echo "<priority>0.9</priority>";
  echo "</url>\n";
}

# Tools
foreach ($tools as $item) {
  echo "<url>";
  echo "<loc>".Router::url(array('controller'=>'tools','action'=>'view','id'=>$item['Game']['game_id']),true)."</loc>";
  echo "<lastmod>".$time->toAtom($item['Game']['created'])."</lastmod>";
# echo "<changefreq>weekly</changefreq>";
  echo "<priority>0.6</priority>";
  echo "</url>\n";
}

# Interviews
foreach ($interviews as $item) {
  echo "<url>";
  echo "<loc>".Router::url(array('controller'=>'interviews','action'=>'view','id'=>$item['Interview']['interview_id']),true)."</loc>";
  echo "<lastmod>".$time->toAtom($item['Interview']['interview_date'])."</lastmod>";
 echo "<changefreq>never</changefreq>";
  echo "<priority>0.7</priority>";
  echo "</url>\n";
}

# Reviews
foreach ($reviews as $item) {
  echo "<url>";
  echo "<loc>".Router::url(array('controller'=>'reviews','action'=>'view','id'=>$item['Review']['review_id']),true)."</loc>";
  echo "<lastmod>".$time->toAtom($item['Review']['added'])."</lastmod>";
 echo "<changefreq>never</changefreq>";
  echo "<priority>0.7</priority>";
  echo "</url>\n";
}

# Guides
foreach ($guides as $item) {
  echo "<url>";
  echo "<loc>".Router::url(array('controller'=>'guides','action'=>'view','id'=>$item['Guide']['id']),true)."</loc>";
  echo "<lastmod>".$time->toAtom($item['Guide']['created'])."</lastmod>";
 echo "<changefreq>never</changefreq>";
  echo "<priority>0.8</priority>";
  echo "</url>\n";
}

# (Site) News
foreach ($news as $item) {
  echo "<url>";
  echo "<loc>".Router::url(array('controller'=>'news','action'=>'view','id'=>$item['News']['news_id']),true)."</loc>";
  echo "<lastmod>".$time->toAtom($item['News']['post_date'])."</lastmod>";
 echo "<changefreq>never</changefreq>";
  echo "<priority>0.4</priority>";
  echo "</url>\n";
}

# World News
foreach ($worldnews as $item) {
  echo "<url>";
  echo "<loc>".Router::url(array('controller'=>'world_news','action'=>'view','id'=>$item['WorldNews']['wnews_id']),true)."</loc>";
  echo "<lastmod>".$time->toAtom($item['WorldNews']['wnews_date'])."</lastmod>";
 echo "<changefreq>never</changefreq>";
  echo "<priority>0.5</priority>";
  echo "</url>\n";
}

# Forums
# FIXME: Add forum code. (see sitemapper.php)
# debug($topics);
foreach ($topics as $item) {
   echo "<url>";
   echo "<loc>"."http://".Configure::read("Site.url")."/viewtopic.php?t=".$item['Topic']['topic_id']."</loc>";
   # echo "<lastmod>".$time->toAtom($item['WorldNews']['wnews_date'])."</lastmod>";
   # echo "<changefreq>never</changefreq>";
   echo "<priority>0.7</priority>";
   echo "</url>\n"; 
}
# Blogs?

?>
</urlset>