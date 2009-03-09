<div class="yui-ge">
  <div class="yui-u first">
<h1>Edit comment</h1>
<?
echo $form->create('Comment');
# echo $form->input('title');
# debug($this->data);
echo "Written by ".$html->link($this->data["User"]["username"],array("controller"=>"users","action"=>"view",$this->data["User"]["user_id"]));
echo " ".$time->timeAgoInWords($this->data["Comment"]["created"],array("format"=>"d.m.Y"))."<br>";
echo $form->input('text', array('rows' => '5',"label"=>false,));
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