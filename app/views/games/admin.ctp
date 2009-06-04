<?
$this->pageTitle = "Games administration";
echo $javascript->codeBlock("
$(document).ready(function() {
  $('select#game').change(function() {
      var selected = $('select#game option:selected');
      if (selected.val() > 0) {
        window.location.href = '".$html->url(array("action"=>"edit"))."/'+selected.val();
      }
    });
});");

?>
<h1>Game admin</h1>
<? $paginator->options(array("url"=>array("page"=>1))); ?>
Filter by Download status: [<?=$paginator->link("All",array())?>] [<?=$paginator->link("Accepted",array("status"=>1))?>] [<?=$paginator->link("Validation queue",array("status"=>2))?>] [<?=$paginator->link("Others",array("status"=>3))?>]

<?
$paginator->options(array('url' => $this->passedArgs)); 
?><br>
Quick choose: <?=$form->select("game",$allgames,false,array(),true)?>
<table class="clean">
  <tr><th><?=$paginator->sort("Game name","Game.game_name")?></th><th><?=$paginator->sort("Game status","Game.download_status")?></th><th>Game Hunter</th><th>GH score</th><th><?=$paginator->sort("Date added","Game.created")?></th><th>Actions</th></tr>
<?
#debug($games[0]);
foreach($games as $game) {
  if ($game["Game"]["download_status"] == 0) {
    echo "<tr><td>".$html->link($text->trim($game["Game"]["game_name"],35,"..."),array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]),array("title"=>$game["Game"]["game_name"]));
  } else {
    echo "<tr><td>".$game["Game"]["game_name"];
  }
  if (empty($game["Screenshot"])) {
    echo "<br>Game has not screenshots!";
  }
  if (empty($game["Download"])) {
    echo "<br>Game has no files!";
  }
  if (empty($game["Publisher"]["publisher_id"])) {
    echo "<br>Game has no publisher!";
  }
  echo "</td>";
  echo "<td>".$DL_STATUS[$game["Game"]["download_status"]]."</td>";
  echo "<td>".$game["GameHunter"]["username"]."</td>";
  echo "<td>".$game["Game"]["site_rating"]."</td>";
  echo "<td>".$time->format("d.m.Y",$game["Game"]["created"])."</td>";
  echo "<td>".$html->link("Edit",array("action"=>"edit",$game["Game"]["game_id"]))." ";
  echo $html->link("Delete",array("action"=>"delete",$game["Game"]["game_id"]),array(),"Are you sure you want to delete the game '".$game["Game"]["game_name"]."'?")." ";
  if (!empty($game["Game"]["forum_link"])) {
    echo $html->link("Forum",$game["Game"]["forum_link"])." ";
  }
  if (!empty($game["Game"]["site"])) { 
    echo $html->link("Website",$game["Game"]["site"])." ";
  }
  echo "</td></tr>";
}
?>
</table>
<?=$paginator->prev();?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next();?> &nbsp;
<?=$paginator->counter(); ?>