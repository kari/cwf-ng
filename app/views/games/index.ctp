<? # View initialization
		$html->css("fancy","stylesheet",array("media"=>"screen"),false);
		$javascript->link("/js/jquery.fancybox.js",false);
?>
<? # Page-specific jQuery code: 
  echo $javascript->codeBlock("
  $(document).ready(function() {
    $('a.thumb').fancybox({
      'hideOnContentClick': true,
      'overlayShow': true,
      'overlayOpacity': 0,  
      });
  });")
?>
<h1>Games</h1>
<p>Order by <b>Name</b>, Score<br>
  Filter by Platform, Score, Genre<br>
  Search <?$form->text("Search")?></p>
<?#=debug($games[0])?>
<table>
	<? foreach ($games as $game) { ?>
	<tr><td>
	 <?
	 if (!empty($game["Screenshot"])) {
	   echo $html->link($site->image($game["Screenshot"][0]["image_link"],array("width"=>150,"height"=>150,"title"=>$game["Game"]["game_name"])),$site->image_url($game["Screenshot"][0]["image_link"]),array("class"=>"thumb","title"=>$game["Game"]["game_name"]),false,false);
   } else {
     echo $html->image("/img/cwf_nosshot.png",array("width"=>150,"height"=>150,"title"=>"No screenshot"));
   }
	   ?>
	  </td><td>
		<h4><?=$html->link($game['Game']['game_name'], '/games/view/'.$game['Game']['game_id']);?></h4>
		  <p><? $first = true;
		    foreach ($game["Genres"] as $genre => $genre_set) {
		      if ($genre == "genre_id") continue;
          if ($genre_set == 1) {
            if (!$first) {
              echo " / ";
            } else {
              $first = false;
            }
            echo $GENRE[$genre];
          }
        } ?>
      (<?=$game["Game"]["year"]?>)<br>
      <?=$html->image("/img/icons/group.png",array("title"=>"Game Hunters' rating"))?> <?=$site->drawStars($game["Game"]["site_rating"],6,false,array("/img/icons/award_star_gold_3.png","/img/icons/award_star_silver_3.png"))?> <?=$html->image("/img/icons/user.png",array("title"=>"Site users' rating"))?>
<?
if (array_key_exists(0,$game["Rating"])) { # FIXME: Ugly way, and might not be Overall (type=0)!
  $average_rating = $game["Rating"][0]["Rating"][0]["average_rating"];
} else {
  $average_rating = 0;
}
?>
<?=$site->drawStars($average_rating,6)?></p>
      <p><?=$text->trim($game['Game']['description'],300,"...",false)?></p>
	</td></tr>
	<? } ?>

</table>

<?=$paginator->prev('« Previous ', null, null, array('class' => 'disabled'));?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next(' Next »', null, null, array('class' => 'disabled'));?> &nbsp;
<?=$paginator->counter(); ?>