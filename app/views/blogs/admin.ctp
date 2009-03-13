<h1>Blog posts</h1>
<ul class="blogs">
<? foreach($blogs as $blog) {
  echo "<li><strong>";
  echo $time->timeAgoInWords($blog["Blog"]["created"],array("format"=>"d.m.Y"));
  echo " - ".$html->link($blog["Blog"]["title"],array("controller"=>"blogs","action"=> "edit",$blog["Blog"]["entry_id"]))." by ".$blog["User"]["username"];
  echo "</strong><br>".$text->trim($bbcode->strip($blog["Blog"]["content"]),200,"...",false);
  echo "</li>";  
}?>
</ul>
<?=$paginator->prev();?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next();?> &nbsp;
<?=$paginator->counter(); ?>