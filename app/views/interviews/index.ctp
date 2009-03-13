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