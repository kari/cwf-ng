<?
$this->pageTitle = "Site admininstartion";
?>
<h1>Site administartion</h1>
<p>Welcome to the admin interface of CWF. Here you can manage all essential features of the site.</p>
<h2>Validation queues</h2>
<ul>
  <li><?=$html->link("Game validation queue","/games/queue")?><br>
    Manage game validation queue</li>
  <li><?=$html->link("Comment validation queue","/comments/queue")?><br>
    Manage game comment validation queue</li>
  <li><?=$html->link("Review validation queue","/reviews/queue")?></li>
</ul>
<h2>Object management</h2>
<ul>
  <li><?=$html->link("Manage games and tools","/games/admin")?><br>
    Add, edit or delete games (and tools) and related data (publishers, files, screenshots, …)</li>
  <li><?=$html->link("Manage game comments","/comments/admin")?><br>
    Moderate game comments</li>
  <li><?=$html->link("Manage blogs","/blogs/admin")?></li>
  <li><?=$html->link("Manage news","/news/admin")?></li>
  <li><?=$html->link("Manage world news","/world_news/admin")?></li>  
  <li><?=$html->link("Manage reviews","/reviews/admin")?></li>
  <li><?=$html->link("Manage guides","/guides/admin")?></li>
  <li><?=$html->link("Manage interviews","/interviews/admin")?></li>
  <li><?=$html->link("Manage group rights","/groups/")?><br>
    Add or remove rights to user groups</li>
</ul>
<h2>View site <?=$html->link("status",array("action"=>"status"))?></h2>