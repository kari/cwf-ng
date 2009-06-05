<h1>Report a mistake in <?=$html->link($game["Game"]["game_name"],array("action"=>"view",$game["Game"]["game_id"]))?></h1>
<?=$form->create("Comment");?>
<?=$form->hidden("flag",array("value"=>true))?>
<?=$form->hidden("title",array("value"=>"FLAGGED: There's a mistake here"));?>
<?=$form->input("text",array("label"=>false,"rows"=>3));?>
<cake:nocache>
<? 
if ($session->check("Auth.User.user_id")) {
  # If user is logged in, we think he's a human
  echo $form->hidden("user_id",array("value"=>$session->read("Auth.User.user_id")));
} else {
  # ...otherwise he gets the reCAPTCHA challenge.
   echo $recaptcha->display_form();
}
?>
</cake:nocache>
<?=$form->hidden("game_id",array("value"=>$game["Game"]["game_id"]));?>
<?=$form->end("Submit")?>