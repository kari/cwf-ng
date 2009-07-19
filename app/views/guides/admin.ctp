<h1>Guides</h1>
<p><?=$html->link("Add a guide",array("action"=>"add"),array("class"=>"add button"))?></p>
<ul class="blogs">
<?foreach ($guides as $guide) {
  echo "<li>".$html->link($guide["Guide"]["title"],array("action"=>"edit",$guide["Guide"]["id"]))."</li>";
}
?>
</ul>
<?=$paginator->prev();?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next();?> &nbsp;
<?=$paginator->counter(); ?>