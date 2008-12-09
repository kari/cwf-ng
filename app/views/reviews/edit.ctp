<div class="yui-ge">
  <div class="yui-u first">
<h1>Edit Review for <?=$this->data["Game"]["game_name"]?></h1>
<?
echo $form->create('Review');
echo $form->input("game_id");
echo $form->input('review_title');
echo $form->input('review_text', array('rows' => '5'));
echo $form->hidden("review_id");
# echo $form->input('user_id');
# echo $form->input("review_rating");
echo $form->end('Save');
?>
  </div>
  <div class="yui-u">
    <?=$this->element("spotlight",array("game_id"=>$this->data["Game"]["game_id"],"cache"=>array("key"=>$this->data["Game"]["game_id"],"time"=>"+1 day")));?>
  </div>
</div>