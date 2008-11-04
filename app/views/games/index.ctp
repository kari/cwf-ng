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
	 <?= $html->link($html->image("http://www.curlysworldoffreeware.com/".$game["Screenshot"][0]["thumb_link"],array("width"=>100,"height"=>100,"title"=>$game["Game"]["game_name"])),"http://www.curlysworldoffreeware.com/".$game["Screenshot"][0]["image_link"],array("class"=>"thumb","title"=>$game["Game"]["game_name"]),false,false)?>
	    <!-- <a class="thumb" href="#"><?=$html->image("http://www.curlysworldoffreeware.com/".$game["Screenshot"][0]["thumb_link"],array("width"=>100,"height"=>100))?></a> -->
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
      GH: <?=$site->drawStars($game["Game"]["site_rating"],6)?></p>
      <p><?=$text->trim($game['Game']['description'],300,"...",false)?></p>
	</td></tr>
	<? } ?>

</table>

<?=$paginator->prev('« Previous ', null, null, array('class' => 'disabled'));?>&nbsp;
<?=$paginator->numbers(); ?>&nbsp;
<?=$paginator->next(' Next »', null, null, array('class' => 'disabled'));?> &nbsp;
<?=$paginator->counter(); ?>