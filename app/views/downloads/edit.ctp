<div class="yui-ge">
  <div class="yui-u first">
<h1>Edit Download for <?=$html->link($this->data["Game"]["game_name"],array("controller"=>"games","action"=>"edit",$this->data["Game"]["game_id"]))?></h1>
<?
$files = array();
foreach(glob(Configure::read("Site.file_path")."*.*") as $file) {
 $files[basename($file)] = basename($file); 
}
echo $form->create('Download');
echo "<fieldset>";
echo $form->input("download_link",array("options"=>$files,"label"=>"File","default"=>$this->data["Download"]["download_link"],"empty"=>true));
if (!file_exists(Configure::read("Site.file_path").basename($this->data["Download"]["download_link"]))) {
  echo "<div class=\"error-message\">The game file (".basename($this->data["Download"]["download_link"]).") is missing. Please reupload the file or delete this download.</div>";
}
echo $form->input("game_id");
echo $form->input("file_platform",array("options"=>$PLATFORM));
echo $form->input("package_type",array("options"=>$DL_TYPE));
echo $form->input("size",array("after"=>" kB","disabled"=>true));
echo $form->input("game_submitter_id",array("options"=>$game_submitters));
# echo $form->input("download_server");
echo $form->input("uploaded",array("timeFormat"=>24,"dateFormat"=>"DMY","minYear"=>2000));
echo $form->input("explanation",array("rows"=>"2","between"=>"<br>","label"=>"File description"));
echo "</fieldset>";
echo $form->end('Save');
echo $html->link("Delete",array("action"=>"delete",$this->data["Download"]["file_id"]),array("class"=>"delete button"),"Proceed with delete?");
echo $html->link("Add new file",array("action"=>"add",$this->data["Game"]["game_id"]),array("class"=>"add button"));
?>
 </div>
  <div class="yui-u">
    <!-- right bar -->
    <?=$this->element("spotlight",array("game_id"=>$this->data["Game"]["game_id"],"cache"=>array("key"=>$this->data["Game"]["game_id"],"time"=>"+1 day")));?> 
  </div>
</div>