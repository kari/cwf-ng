<div class="yui-ge">
  <div class="yui-u first">
<h1>Reviews</h1>
<ul class="reviews">
<?foreach ($reviews as $review) {
  echo "<li>".$review["Game"]["game_name"].": ".$html->link($review["Review"]["review_title"],array("action"=>"view",$review["Review"]["review_id"]))." by ".$review["User"]["username"]."</li>";
}
?>
</ul>
  </div>
  <div class="yui-u">
    <?=$this->element("adbox",array("style"=>"pw-skyscraper"))?>
  </div>
</div>