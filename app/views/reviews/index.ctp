<h1>Reviews</h1>
<ul>
<?foreach ($reviews as $review) {
  echo "<li>".$html->link($review["Review"]["review_title"],array("action"=>"view",$review["Review"]["review_id"]))."</li>";
}
?>
</ul>