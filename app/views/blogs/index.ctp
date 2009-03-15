<?
if (isset($user)) {
  $this->pageTitle = $user["User"]["username"]."'s Blog";
  $html->meta("atom","index/".$user["User"]["user_id"].".atom",array("title"=>$this->pageTitle,"rel"=>"alternate"),false);
} else {
  $this->pageTitle = "Blogs";
}
?>
<h1><?=$this->pageTitle?></h1>
<cake:nocache>
<?
if ($session->check("Auth.User.user_id")) { ?>
<p><?php echo $html->link('Write a new Blog Entry', '/blogs/add'); ?></p>
<? } ?>
</cake:nocache>
<ul class="blogs">
<? foreach($blogs as $blog) {
  echo "<li><strong>";
  echo $time->timeAgoInWords($blog["Blog"]["created"],array("format"=>"d.m.Y"));
  echo " - ".$html->link($blog["Blog"]["title"],array("controller"=>"blogs","action"=> "view",$blog["Blog"]["entry_id"]))." by ".$blog["User"]["username"];
  echo "</strong><br>".$text->trim($bbcode->strip($blog["Blog"]["content"]),200,"...",false);
  echo "</li>";  
}?>
</ul>
<?=$paginator->prev();?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next();?> &nbsp;
<?=$paginator->counter(); ?>