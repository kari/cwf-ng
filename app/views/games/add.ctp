<h1>Add game</h1>
<h2>Game info</h2>
<?
  echo $form->create("Game");
  echo $form->input("game_name");
  echo $form->input("year",array("maxLength"=>4));
  echo $form->input("publisher_id",array("empty"=>"(empty publisher)"));
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
  echo $form->input("site_rating",array("value"=>0));
  
  echo $form->input("download_status",array("type"=>"select","options"=>$DL_STATUS,"selected"=>-1));
  echo $form->input("lisence",array("type"=>"select","options"=>$LICENSE,"selected"=>1));
  
  echo $form->input("game_proposer_id",array("selected"=>$user_id));
  echo $form->input("game_hunter_id",array("selected"=>$user_id));
  
  echo $form->end("Save");
?>
<?#=debug($this->data)?>