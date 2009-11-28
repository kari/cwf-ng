<? $this->pageTitle = "Sitemap"; ?>
<h1>Sitemap</h1>
<p>Welcome to Curly's World of Freeware, the home for all quality freeware games. This sitemap should aid you navigate around the site.</p>
<h2><?=$html->link("Main page",Router::url("/",true))?></h2>
<ul><li><?=$html->link("Game vs Game","/gvsg/")?></li></ul>
<? # FIXME: Subelements here and to below too. ?>
<h2><?=$html->link("Games","/games/")?></h2>
<h2><?=$html->link("Blogs","/blogs/")?></h2>
<h2><?=$html->link("Site News","/news/")?></h2>
<h2><?=$html->link("World News","/world_news")?></h2>
<h2><?=$html->link("Reviews","/reviews/")?></h2>
<h2><?=$html->link("Guides","/guides/")?></h2>
<h2><?=$html->link("Interviews","/interviews/")?></h2>
<h2><?=$html->link("Tools","/tools/")?></h2>
<h2><?=$html->link("Forums","http://".Configure::read("Forum.url"))?></h2>
