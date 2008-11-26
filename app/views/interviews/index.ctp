<h1>Interviews</h1>
<ul>
<?foreach ($interviews as $interview) {
  echo "<li>".$html->link($interview["Interview"]["interview_title"],array("action"=>"view",$interview["Interview"]["interview_id"]))."</li>";
}
?>
</ul>