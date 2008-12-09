<h1>Guides</h1>
<ul class="blogs">
<?foreach ($guides as $guide) {
  echo "<li>".$html->link($guide["Guide"]["title"],array("action"=>"view",$guide["Guide"]["id"]))."</li>";
}
?>
</ul>