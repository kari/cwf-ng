<div class="yui-ge">
  <div class="yui-u first">
<h1>Add Download<?=($game_id?" for ".$html->link($games[$game_id],array("controller"=>"games","action"=>"edit",$game_id)):"")?></h1>
<p>You should first upload your file using FTP to the server. All files in our download directory are listed in the "File" drop-down.</p>
<?
$files = array();
foreach(glob(Configure::read("Site.file_path")."*.*") as $file) {
 $files[basename($file)] = basename($file); 
}
echo $form->create('Download');
echo $form->input('download_link',array("label"=>"File","options"=>$files,"empty"=>"(choose a file)"));
echo $form->input("game_id",array("default"=>$game_id));
echo $form->input("file_platform",array("options"=>$PLATFORM));
echo $form->input("package_type",array("options"=>$DL_TYPE));
# echo $form->input("size",array("after"=>" kB"));
echo $form->input("game_submitter_id",array("label"=>"File uploader","options"=>$game_submitters,"default"=>$session->read("Auth.User.user_id")));
echo $form->input("explanation",array("rows"=>2,"between"=>"<br>","label"=>"File description"));
echo $form->input("uploaded",array("timeFormat"=>24,"dateFormat"=>"DMY","minYear"=>2000));
echo $form->input("download_server",array("disabled"=>true));
echo $form->end('Save');
?>
 </div>
  <div class="yui-u">
    <!-- right bar -->
    <?=$this->element("spotlight",array("game_id"=>$game_id,"cache"=>array("key"=>$game_id,"time"=>"+1 day")));?> 
  </div>
</div>