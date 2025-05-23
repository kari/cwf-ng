<?
$this->pageTitle = "Editing '".$this->data["Game"]["game_name"]."'";
echo $javascript->codeBlock("
$(document).ready(function() {
  if (".($this->data["Publisher"]["publisher_id"]?$this->data["Publisher"]["publisher_id"]:"0")." > 0) {
    $('a#edit_pub').attr('href','".$html->url(array("controller"=>"publishers","action"=>"edit",$this->data["Publisher"]["publisher_id"]))."');
  } else {
    $('a#edit_pub').removeAttr('href');
  }
  
  $('select#GamePublisherId').change(function() {
      var selected = $('select#GamePublisherId option:selected');
      if (selected.val() > 0) {
      $('a#edit_pub').attr('href','".$html->url(array("controller"=>"publishers","action"=>"edit"))."/'+selected.val());
      } else {
        $('a#edit_pub').removeAttr('href');
      }
    });
});");
?>
<h1>Edit Game "<?=$html->link($this->data["Game"]["game_name"],array("action"=>"view",$this->data["Game"]["game_id"]))?>"</h1>
<div class="yui-gc">
  <div class="yui-u first">
<?
  echo $form->create("Game");
  echo $form->hidden("game_id");
  echo $form->hidden("Specs.specs_id");
  echo $form->hidden("Genres.genre_id");
?>
<fieldset>
  <legend>Game info</legend>
<?
  echo $form->input("game_name");
  echo $form->input("year",array("maxLength"=>4));
  echo $form->input("site");
  echo $form->input("publisher_id",array("empty"=>"(empty publisher)"));
  echo '<span class="pull">';
  echo $html->link("Edit publisher",array("controller"=>"publishers","action"=>"edit",$this->data["Publisher"]["publisher_id"]),array("id"=>"edit_pub","class"=>"edit button"),"This will navigate away from this page. All unsaved changes will be lost.")." ";
  echo $html->link("Add new publisher",array("controller"=>"publishers","action"=>"add",$this->data["Game"]["game_id"]),array("class"=>"add button"),"This will navigate away from this page. All unsaved changes will be lost.");
  echo '</span>';
  echo $form->input("description",array("between"=>"<br>","rows"=>10));
  echo "<em>BBCode enabled. Internal links enabled.</em>";
  echo $form->input("requirements",array("between"=>"<br>","rows"=>2));
?>
</fieldset>

<fieldset>
  <legend>Genres</legend>
<?
  asort($GENRE);
  $cols = ceil(count($GENRE)/3.0);
  $i = 0;
  echo "<table><tr><td>";
  foreach($GENRE as $genre => $title) {
    if (($i % $cols == 0) && ($i >0)) { echo '</td><td>'; }
    $i++;
    echo $form->input("Genres.".$genre,array("type"=>"checkbox","label"=>$title,"div"=>false,"after"=>"<br>"));
  }
  echo "</td></tr></table>";
?>

</fieldset>

<fieldset>
  <legend>Platforms</legend>
<?
  asort($OSYSTEM);
  $cols = ceil(count($OSYSTEM)/3.0);
  $i = 0;
  echo "<table><tr><td>";
  foreach($OSYSTEM as $os => $title) {
    if (($i % $cols == 0) && ($i >0)) { echo '</td><td>'; }
    $i++;
    echo $form->input("Specs.".$os,array("type"=>"checkbox","label"=>$title,"div"=>false,"after"=>"<br>"));
  }
  echo "</td></tr></table>";
?>
</fieldset>

<fieldset>
  <legend>Site info</legend>
<?
  echo $form->input("forum_link",array("label"=>"Forum topic"));
  echo $form->input("site_rating",array("type"=>"select","label"=>"GH Score","options"=>array(0,1,2,3,4,5,6)));
  
  echo $form->input("download_status",array("type"=>"select","options"=>$DL_STATUS));
  echo $form->input("lisence",array("type"=>"select","options"=>$LICENSE,"label"=>"License"));
  
  echo $form->input("game_proposer_id");
  echo $form->input("game_hunter_id");
  echo $form->input("adult",array("label"=>"Show warnings for adult content","type"=>"checkbox","div"=>false));
?>
</fieldset>

<?  
  echo $form->button("Reset",array("type"=>"reset","div"=>false));
  echo $form->end("Save");
?>
  </div>
  <div class="yui-u">
    <form><fieldset>
<legend>Screenshots</legend>
<ul class="nobullet">
  <li><?=$html->link("Add new screenshot",array("controller"=>"screenshots","action"=>"add",$this->data["Game"]["game_id"]),array("class"=>"button add"),"This will navigate away from this page. All unsaved changes will be lost.")?></li>
<?  
  foreach($this->data["Screenshot"] as $screenshot) {
    echo "<li>".$site->image($screenshot["image_link"],array("width"=>150,"height"=>150));
    echo "<br>";
    echo $html->link("Edit",array("controller"=>"screenshots","action"=>"edit",$screenshot["screenshot_id"]),array("class"=>"button edit"),"This will navigate away from this page. All unsaved changes will be lost.")." ";
    echo $html->link("Delete",array("controller"=>"screenshots","action"=>"delete",$screenshot["screenshot_id"]),array("class"=>"button delete"),"This will navigate away from this page. All unsaved changes will be lost. Proceed with delete?");
    echo "</li>";
  }
?>

</ul>
</fieldset>
<fieldset><legend>Files</legend>
<ul class="nobullet">
  <li><?=$html->link("Add new file",array("controller"=>"downloads","action"=>"add",$this->data["Game"]["game_id"]),array("class"=>"add button"),"This will navigate away from this page. All unsaved changes will be lost.")?></li>
<?
  foreach($this->data["Download"] as $file) {
    echo '<li>'.basename($file["download_link"]).' ('.$number->toReadableSize($file["size"]*1024).')<br><i>'.$file["explanation"].' ('.$PLATFORM[$file["file_platform"]].' '.$DL_TYPE[$file["package_type"]].')</i><br>';
    echo $html->link("Edit",array("controller"=>"downloads","action"=>"edit",$file["file_id"]),array("class"=>"edit button"),"This will navigate away from this page. All unsaved changes will be lost.")." ";
    echo $html->link("Delete",array("controller"=>"downloads","action"=>"delete",$file["file_id"]),array("class"=>"delete button"),"This will navigate away from this page. All unsaved changes will be lost. Proceed with delete?");
    echo '</li>';
  }
?>
</ul>
</fieldset>
  </div>
</div>

<?#=debug($this->validationErrors)?>