<?
  $this->pageTitle = $interview["Interview"]["interview_title"];
?>
<div class="yui-ge">
  <div class="yui-u first">
<h1><?=$interview["Interview"]["interview_title"]?></h1>
<p><em>or, where <?=$interview["Interviewer"]["username"]?> interviews 
<? # Come up with who is being interviewed.
if (!empty($interview["Interview"]["answerer"])) {
  echo $interview["Interview"]["answerer"];
}
if (!empty($interview["Interview"]["answerer"]) && !empty($interview["Interview"]["developer_id"])) {
  echo " of ".$html->link($interview["Publisher"]["name"],array("controller"=>"publishers","action"=>"view",$interview["Publisher"]["publisher_id"]));
} elseif (!empty($interview["Interview"]["developer_id"])) {
  echo $html->link($interview["Publisher"]["name"],array("controller"=>"publishers","action"=>"view",$interview["Publisher"]["publisher_id"]));
}
?>
<? # is this about a game or just about the dev?
if (!empty($interview["Interview"]["game_id"])) {
  echo " about ".$html->link($interview["Game"]["game_name"],array("controller"=>"games","action"=>"view",$interview["Game"]["game_id"]));
}
?>
.</em></p>
<p>
<?=$bbcode->decode($interview["Interview"]["text"])?>
</p>
<h3>Related links</h3>
<ul>
<?
if (!empty($interview["Interview"]["game_id"])) echo "<li>".$html->link($interview["Game"]["game_name"]." on CWF",array("controller"=>"games","action"=>"view",$interview["Game"]["game_id"]))."</li>";
if (!empty($interview["Publisher"])) echo "<li>".$html->link("More games from ".$interview["Publisher"]["name"]." on CWF",array("controller"=>"publishers","action"=>"view",$interview["Publisher"]["publisher_id"]))."</li>";
if (!empty($interview["Game"]["forum_link"])) echo "<li>".$html->link("Discussion about ".$interview["Game"]["game_name"]." on CWF Forums",$interview["Game"]["forum_link"])."</li>";
if (!empty($interview["Game"]["site"])) echo "<li>".$html->link("Official site for ".$interview["Game"]["game_name"],$interview["Game"]["site"])."</li>";
if (!empty($interview["Publisher"]["site"])) echo "<li>".$html->link("Official site of ".$interview["Publisher"]["name"],$interview["Publisher"]["site"])."</li>";

?>
</ul>
  </div>
  <div class="yui-u">
  <!-- right bar -->
  <? 
  if (!empty($interview["Game"])) {
    echo $this->element("spotlight",array("game_id"=>$interview["Game"]["game_id"],"cache"=>array("key"=>$interview["Game"]["game_id"],"time"=>"+1 day")));
  }
  ?>
  <?=$this->element("adbox",array("style"=>"pw-skyscraper"))?>
  </div>
</div>