<?
# Debug view for download

?>
<h1>File download</h1>
File to download: <?=APP.$path.$id?> 
<?
if (file_exists(APP.$path.$id)) {
  echo "(File exists)";
} else {
  echo "(File missing)";
}
?>
<br>
File type: <?=$extension?><br>