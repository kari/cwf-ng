<? # View initialization
		$html->css("jquery.fancybox","stylesheet",array("media"=>"screen"),false);
		$javascript->link("/js/jquery.fancybox-1.2.0.js",false);
		$html->meta("atom","index.atom",array("title"=>"Recent games","rel"=>"alternate"),false);
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
<p>Sort by <?=$paginator->link("Game name",array("sort"=>"game_name","direction"=>"asc"))?>, 
 <?=$paginator->link("Score",array("sort"=>"site_rating","direction"=>"desc"))?>, <?=$paginator->link("Date added",array("sort"=>"created","direction"=>"desc"))?>, <?=$paginator->link("Release date",array("sort"=>"year","direction"=>"desc"))?><br>
<?=$form->create("",array("type"=>"post","action"=>"index"))?>
Platform <?=$form->select("platform",$OSYSTEM,$session->read("Game.platform"),array(),true)?>, 
Min. Score <?=$form->select("score",array(0,1,2,3,4,5,6),($session->check("Game.score") ? $session->read("Game.score") : 0),array(),false)?>, 
Genre <?=$form->select("genre",$GENRE,$session->read("Game.genre"),array(),true)?>
<?=$form->end("Filter")?>
<?=$form->create("",array("type"=>"post","action"=>"index"))?>
<?=$form->hidden("platform",array("value"=>""))?>
<?=$form->hidden("score",array("value"=>"0"))?>
<?=$form->hidden("genre",array("value"=>""))?>
<?=$form->end("Clear filters")?>
</p>

<table class="clean">
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
		<h4><?=$html->link($game['Game']['game_name'], '/games/view/'.$game['Game']['game_id'],array(),null,false);?></h4>
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
      <p><?=$text->trim($bbcode->strip($game['Game']['description']),300,"...",false)?></p>
	</td></tr>
	<? } ?>
</table>

<?=$paginator->prev("Previous");?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next("Next");?>&nbsp;
Page&nbsp;<?=$paginator->counter("pages"); ?>