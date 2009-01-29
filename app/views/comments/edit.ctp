<div class="yui-ge">
  <div class="yui-u first">
<h1>Edit comment</h1>
<?
echo $form->create('Comment');
echo $form->input('title');
echo $form->input('text', array('rows' => '5'));
echo $form->hidden("comment_id");
echo $form->input("validated",array("type"=>"checkbox"));
echo $form->end('Save');
echo $html->link("Delete",array("action"=>"delete",$this->data["Comment"]["comment_id"]),array(),"Proceed with delete?");
?>
  </div>
  <div class="yui-u">
    <?=$this->element("spotlight",array("game_id"=>$this->data["Game"]["game_id"],"cache"=>array("key"=>$this->data["Game"]["game_id"],"time"=>"+1 day")));?>
  </div>
</div>