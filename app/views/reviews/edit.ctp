<div class="yui-ge">
  <div class="yui-u first">
<h1>Edit Review for <?=$html->link($this->data["Game"]["game_name"],array("controller"=>"games","action"=>"view",$this->data["Game"]["game_name"]))?></h1>
<?
echo $form->create('Review');
echo $form->input("game_id");
echo $form->input('review_title');
echo $form->input('review_text', array('rows' => '15',"label"=>false));
echo "<em>BBCode enabled. Internal links enabled.</em>";
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