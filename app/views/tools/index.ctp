<h1>Tools</h1>
<ul class="tools">
<?foreach ($tools as $tool) {
  echo "<li>".$html->link($tool["Game"]["game_name"],array("action"=>"view",$tool["Game"]["game_id"]))."</li>";
}
?>
</ul>