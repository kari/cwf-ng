<?
$this->pageTitle = "Downloading ".$download["Game"]["game_name"];
?>
<h1>Downloading <?=$download["Game"]["game_name"]?>...</h1>
<p><strong>Warning:</strong> This game contains pr0n or strong violence. You probably knew it and that might be the reason you are here in the first place. You shouldn't download this unless you're 18 or therearound - otherwise you will have nightmares and/or problems getting out of the bed quickly in the morning. You have been warned.</p>

<?
echo $form->create(false,array("url"=>"get/".$download["Download"]["file_id"]));
echo $form->hidden("accept",array("value"=>1));
echo$form->end("Download");
?>
<br>
<?=$html->link("Take me back to the bunnies",array("controller"=>"games","action"=>"index"));?>