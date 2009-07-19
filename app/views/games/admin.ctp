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
<p><?=$html->link("Add a game",array("action"=>"add"),array("class"=>"add button"))?></p>
<? $paginator->options(array("url"=>array("page"=>1))); ?>
Filter by Download status: [<?=$paginator->link("All",array())?>] [<?=$paginator->link("Accepted",array("status"=>1))?>] [<?=$paginator->link("Validation queue",array("status"=>2))?>] [<?=$paginator->link("Others",array("status"=>3))?>]

<?
$paginator->options(array('url' => $this->passedArgs)); 
?><br>
Quick choose: <?=$form->select("game",$allgames,false,array(),true)?><br/>
<div class="nav">
<?=$paginator->first("First");?>&nbsp;
<?=$paginator->prev();?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next();?> &nbsp;
<?=$paginator->counter(); ?></div>
<table class="clean">
  <tr><th>Actions</th><th><?=$paginator->sort("Game name","Game.game_name")?></th><th><?=$paginator->sort("Game status","Game.download_status")?></th><th>Game Hunter</th><th>GH score</th><th><?=$paginator->sort("Date added","Game.created")?></th></tr>
<?
#debug($games[0]);
foreach($games as $game) {
  echo "<tr>";
  echo "<td>".$html->link($html->image("/img/icons/application_edit.png",array("alt"=>"Edit","title"=>"Edit")),array("action"=>"edit",$game["Game"]["game_id"]),null,null,false)." ";
  echo $html->link($html->image("/img/icons/application_delete.png",array("alt"=>"Delete","title"=>"Delete")),array("action"=>"delete",$game["Game"]["game_id"]),array(),"Are you sure you want to delete the game '".$game["Game"]["game_name"]."'?",null,false)." ";
  if (!empty($game["Game"]["forum_link"])) {
    echo $html->link($html->image("/img/icons/group.png",array("alt"=>"Forum link","title"=>"Forum link")),$game["Game"]["forum_link"],null,null,false)." ";
  }
  if (!empty($game["Game"]["site"])) { 
    echo $html->link($html->image("/img/icons/world.png",array("alt"=>"Website","title"=>"Website")),$game["Game"]["site"],null,null,false)." ";
  }
  echo "</td>";
  if ($game["Game"]["download_status"] == 0) {
    echo "<td><strong>".$html->link($text->trim($game["Game"]["game_name"],35,"..."),array("controller"=>"games","action"=>"view",$game["Game"]["game_id"]),array("title"=>$game["Game"]["game_name"]),null,false)."</strong>";
  } else {
    echo "<td><strong>".$game["Game"]["game_name"]."</strong";
  }
  if (empty($game["Screenshot"])) {
    echo "<br>".$html->image("/img/icons/bullet_error.png",array("title"=>"Error"))."Game has not screenshots!";
  }
  if (empty($game["Download"])) {
    echo "<br>".$html->image("/img/icons/bullet_error.png",array("title"=>"Error"))."Game has no files!";
  }
  if (empty($game["Publisher"]["publisher_id"])) {
    echo "<br>".$html->image("/img/icons/bullet_error.png",array("title"=>"Error"))."Game has no publisher!";
  }
  echo "</td>";
  echo "<td>";
  switch ($game["Game"]["download_status"]) {
    case 0:
      echo $html->image("/img/icons/accept.png",array("title"=>"OK"));
      break;
    case -1:
      echo $html->image("/img/icons/flag_blue.png",array("title"=>"Not validated"));
      break;
    default:
      echo $html->image("/img/icons/stop.png",array("title"=>"Error"));
      break;
  }
  echo $DL_STATUS[$game["Game"]["download_status"]]."</td>";
  echo "<td>".$game["GameHunter"]["username"]."</td>";
  echo "<td>".$game["Game"]["site_rating"]."</td>";
  echo "<td>".$time->format("d.m.Y",$game["Game"]["created"])."</td>";
  echo "</tr>";
}
?>
</table>
<div class="nav">
<?=$paginator->first("First");?>&nbsp;
<?=$paginator->prev();?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next();?> &nbsp;
<?=$paginator->counter(); ?>
</div>