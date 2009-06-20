<?
if ($game_redirect) {
  echo "<h1>Add Publisher for ".$game["Game"]["game_name"]."</h1>";
  echo "<p>You'll be redirected back to editing ".$html->link($game["Game"]["game_name"],array("controller"=>"games","action"=>"edit",$game_redirect))." after saving.</p>";
  echo $form->create("Publisher",array("action"=>"add/".$game_redirect));
} else {
  echo "<h1>Add Publisher</h1>";
  echo $form->create('Publisher');
}
echo $form->input('name');
echo $form->input("site");
echo $form->input("email");
echo $form->end('Save');
?>