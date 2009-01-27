<h1>Add Screenshot</h1>
<?
echo $form->create('Screenshot',array("type"=>"file"));
# echo $form->input('image_link'); 
echo $form->file("image");
echo $form->input("game_id",array("default"=>$game_id));
echo $form->input("screenshot_submitter_id",array("options"=>$screenshot_submitters,"default"=>$session->read("Auth.User.user_id")));
echo $form->end('Save');
?>