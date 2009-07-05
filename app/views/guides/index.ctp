<div class="yui-ge">
  <div class="yui-u first">
<h1>Guides</h1>
<ul class="blogs">
<?foreach ($guides as $guide) {
  echo "<li>".$guide["Game"]["game_name"].": ".$html->link($guide["Guide"]["title"],array("action"=>"view",$guide["Guide"]["id"]))." by ".$guide["User"]["username"]."</li>";
}
?>
</ul>
<?=$paginator->prev();?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next();?> &nbsp;
<?=$paginator->counter(); ?>
  </div>
  <div class="yui-u">
    <?=$this->element("adbox",array("style"=>"pw-skyscraper"))?>
  </div>
</div>