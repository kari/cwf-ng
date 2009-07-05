<div class="yui-ge">
  <div class="yui-u first">
<h1>Interviews</h1>
<ul class="reviews">
<?foreach ($interviews as $interview) {
  echo "<li>".$html->link($interview["Interview"]["interview_title"],array("action"=>"view",$interview["Interview"]["interview_id"]))."</li>";
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