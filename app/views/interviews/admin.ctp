<h1>Interviews</h1>
<ul class="reviews">
<?foreach ($interviews as $interview) {
  echo "<li>".$html->link($interview["Interview"]["interview_title"],array("action"=>"edit",$interview["Interview"]["interview_id"]))."</li>";
}
?>
</ul>
<?=$paginator->prev('« Previous ', null, null, array('class' => 'disabled'));?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next(' Next »', null, null, array('class' => 'disabled'));?> &nbsp;
<?=$paginator->counter(); ?>