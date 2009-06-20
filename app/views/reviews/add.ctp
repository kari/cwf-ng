<div class="yui-ge">
  <div class="yui-u first">
<h1>Add a Review for <?=$game["Game"]["game_name"]?></h1>
<p>At CWF, we have some guidelines for reviews. If you haven't read them before, please do so. If you only want to shortly comment on the game, write a comment instead.</p>
<?
echo $form->create('Review');
echo $form->input('review_title');
echo $form->input('review_text', array('rows' => 20,"label"=>false,"between"=>"<br>"));
echo "<em>BBCode enabled. Internal links enabled.</em>";
echo $form->hidden('user_id', array('value'=>$user_id));
echo $form->hidden("game_id",array("value"=>$game["Game"]["game_id"]));
echo $form->end('Save');
?>
  </div>
  <div class="yui-u">
    <?=$this->element("spotlight",array("game_id"=>$game["Game"]["game_id"],"cache"=>array("key"=>$game["Game"]["game_id"],"time"=>"+1 day")));?>
  </div>
</div>