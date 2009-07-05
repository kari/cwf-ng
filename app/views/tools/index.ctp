<div class="yui-ge">
  <div class="yui-u first">
<h1>Tools</h1>
<ul class="tools">
<?foreach ($tools as $tool) {
  echo "<li>".$html->link($tool["Game"]["game_name"],array("action"=>"view",$tool["Game"]["game_id"]))."<br>";
  echo $text->trim($bbcode->strip($tool["Game"]["description"]),600,"...",false);
  echo "</li>";
}
?>
</ul>
  </div>
  <div class="yui-u">
    <?=$this->element("adbox",array("style"=>"pw-skyscraper"))?>
  </div>
</div>