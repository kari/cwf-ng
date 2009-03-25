<h1>Edit Download for <?=$html->link($this->data["Game"]["game_name"],array("controller"=>"games","action"=>"edit",$this->data["Game"]["game_id"]))?></h1>
<?
echo $form->create('Download');
echo "<fieldset>";
echo $form->input('download_link');
if (!file_exists(Configure::read("Site.file_path").basename($this->data["Download"]["download_link"]))) {
  echo "<span class=\"pull\">The game file is missing.</span>";
}
echo $form->input("game_id");
echo $form->input("file_platform",array("options"=>$PLATFORM));
echo $form->input("package_type",array("options"=>$DL_TYPE));
echo $form->input("size",array("after"=>" kB","disabled"=>true));
echo $form->input("game_submitter_id",array("options"=>$game_submitters));
# echo $form->input("download_server");
echo $form->input("uploaded",array("timeFormat"=>24,"dateFormat"=>"DMY","minYear"=>2000));
echo $form->input("explanation",array("rows"=>"2","between"=>"<br>"));
echo "</fieldset>";
echo $form->end('Save');
echo $html->link("Delete",array("action"=>"delete",$this->data["Download"]["file_id"]),array(),"Proceed with delete?");
?>