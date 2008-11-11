<h1>Edit game</h1>
<h2>Game info</h2>
<?
  echo $form->create("Game");
  echo $form->input("game_name");
  echo $form->input("year",array("maxLength"=>4));
  echo $form->input("publisher_id",array("empty"=>"(empty publisher)"));
  echo $html->link("Edit publisher",array("controller"=>"publishers","action"=>"edit",$this->data["Publisher"]["publisher_id"]),array(),"This will navigate away from this page. All unsaved changes will be lost.")." ";
  echo $html->link("Add new publisher",array("controller"=>"publishers","action"=>"create",$this->data["Game"]["game_id"]),array(),"This will navigate away from this page. All unsaved changes will be lost.");
  
  echo $form->input("description");
  echo $form->input("site");
  echo $form->input("requirements");
?>
<h2>Genres</h2>
<?
  foreach($GENRE as $genre => $title) {
    echo $form->input("Genres.".$genre,array("type"=>"checkbox","label"=>$title));
  }
?>
<h2>Platforms</h2>
<?
  foreach($OSYSTEM as $os => $title) {
    echo $form->input("Specs.".$os,array("type"=>"checkbox","label"=>$title));
  }
?>
<h2>Site info</h2>
<?
  echo $form->input("forum_link");
  echo $form->input("site_rating");
  
  echo $form->input("download_status",array("type"=>"select","options"=>$DL_STATUS));
  echo $form->input("lisence",array("type"=>"select","options"=>$LICENSE));
  
  echo $form->input("game_proposer_id");
  echo $form->input("game_hunter_id");
  
  echo $form->end("Save");
?>
<h2>Screenshots</h2>
<ul>
<?  
  foreach($this->data["Screenshot"] as $screenshot) {
    echo "<li>".$html->image("http://curlysworldoffreeware.com/".$screenshot["image_link"],array("width"=>100,"height"=>100));
    echo "<br>";
    echo $html->link("Edit",array("controller"=>"screenshots","action"=>"edit",$screenshot["screenshot_id"]),array(),"This will navigate away from this page. All unsaved changes will be lost.")." ";
    echo $html->link("Delete",array("controller"=>"screenshots","action"=>"delete",$screenshot["screenshot_id"]),array(),"This will navigate away from this page. All unsaved changes will be lost. Proceed with delete?");
    echo "</li>";
  }
?>
<li><?=$html->link("Add new screenshot",array("controller"=>"screenshots","action"=>"create",$this->data["Game"]["game_id"]),array(),"This will navigate away from this page. All unsaved changes will be lost.")?></li>
</ui>
<h2>Files</h2>
<ul>
<?
  foreach($this->data["Download"] as $file) {
    echo '<li>'.$file["download_link"].' ('.$number->toReadableSize($file["size"]*1024).')<br><i>'.$file["explanation"].' ('.$PLATFORM[$file["file_platform"]].' '.$DL_TYPE[$file["package_type"]].')</i><br>';
    echo $html->link("Edit",array("controller"=>"downloads","action"=>"edit",$file["file_id"]),array(),"This will navigate away from this page. All unsaved changes will be lost.")." ";
    echo $html->link("Delete",array("controller"=>"downloads","action"=>"delete",$file["file_id"]),array(),"This will navigate away from this page. All unsaved changes will be lost. Proceed with delete?");
    echo '</li>';
  }
?>
<li><?=$html->link("Add new file",array("controller"=>"downloads","action"=>"create",$this->data["Game"]["game_id"]),array(),"This will navigate away from this page. All unsaved changes will be lost.")?></li>
</ul>

<?#=debug($this->data)?>