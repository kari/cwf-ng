<div class="yui-ge">
  <div class="yui-u first">
<h1>Add Screenshot<?=($game_id?" for ".$html->link($games[$game_id],array("controller"=>"games","action"=>"edit",$game_id)):"")?></h1>
<?
echo $form->create('Screenshot',array("type"=>"file"));
# echo $form->input('image_link'); 
echo "<fieldset><legend>Upload image</legend>";
echo "<p></p>";
echo $form->file("image");
echo "</fieldset>";
echo "<fieldset>";
echo $form->input("game_id",array("default"=>$game_id));
echo $form->input("screenshot_submitter_id",array("options"=>$screenshot_submitters,"default"=>$session->read("Auth.User.user_id"),"label"=>"Submitter"));
echo "</fieldset>";
echo $form->end('Save');
?>
 </div>
  <div class="yui-u">
    <!-- right bar -->
    <?=$this->element("spotlight",array("game_id"=>$game_id,"cache"=>array("key"=>$game_id,"time"=>"+1 day")));?> 
  </div>
</div>