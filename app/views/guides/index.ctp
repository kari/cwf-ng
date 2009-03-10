<h1>Guides</h1>
<ul class="blogs">
<?foreach ($guides as $guide) {
  echo "<li>".$guide["Game"]["game_name"].": ".$html->link($guide["Guide"]["title"],array("action"=>"view",$guide["Guide"]["id"]))." by ".$guide["User"]["username"]."</li>";
}
?>
</ul>
<?=$paginator->prev('« Previous ', null, null, array('class' => 'disabled'));?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next(' Next »', null, null, array('class' => 'disabled'));?> &nbsp;
<?=$paginator->counter(); ?>