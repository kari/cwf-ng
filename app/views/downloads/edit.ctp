<h1>Add Download</h1>
<?
echo $form->create('Download');
echo $form->input('download_link');
echo $form->input("game_id");
echo $form->input("file_platform",array("options"=>$PLATFORM));
echo $form->input("package_type",array("options"=>$DL_TYPE));
echo $form->input("size");
echo $form->input("game_submitter_id",array("options"=>$game_submitters));
echo $form->input("explanation");
echo $form->input("download_server");
echo $form->input("uploaded",array("timeFormat"=>24,"dateFormat"=>"DMY","minYear"=>2000));
echo $form->end('Save');
?>