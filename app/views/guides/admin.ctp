<h1>Guides</h1>
<p><?=$html->link("Add a guide",array("action"=>"add"),array("class"=>"add button"))?></p>
<ul class="blogs">
<?foreach ($guides as $guide) {
  echo "<li>".$html->link($guide["Guide"]["title"],array("action"=>"edit",$guide["Guide"]["id"]));
  echo " ".$html->link($html->image("/img/icons/application_edit.png",array("alt"=>"Edit","title"=>"Edit")),array("action"=>"edit",$guide["Guide"]["id"]),array(),null,false);
  echo " ".$html->link($html->image("/img/icons/application_delete.png",array("alt"=>"Delete","title"=>"Delete")),array("action"=>"delete",$guide["Guide"]["id"]),array(),"Are you sure you want to delete this guide?",false);
  echo "</li>";
}
?>
</ul>
<?=$paginator->prev();?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next();?> &nbsp;
<?=$paginator->counter(); ?>