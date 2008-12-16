<h1>Add Screenshot</h1>
<?
echo $form->create('Screenshot');
echo $form->input('image_link'); // FIXME: We could upload the screenshots here. No need for FTP for that.
echo $form->input("game_id",array("default"=>$game_id));
echo $form->input("screenshot_submitter_id",array("options"=>$screenshot_submitters,"default"=>$session->read("Auth.User.user_id")));
echo $form->end('Save');
?>