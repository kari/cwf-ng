<div class="yui-ge">
  <div class="yui-u first">
<h1>Edit Guide for <?=$this->data["Game"]["game_name"]?></h1>
<?
echo $form->create('Guide');
echo $form->hidden("id");
echo $form->input('title',array("type"=>"text"));
echo $form->input('user_id');
echo $form->input("game_id");
echo $form->input('text', array('rows' => '15',"label"=>false));
echo $form->end('Save');
?>
  </div>
  <div class="yui-u">
    <?=$this->element("spotlight",array("game_id"=>$this->data["Game"]["game_id"],"cache"=>array("key"=>$this->data["Game"]["game_id"],"time"=>"+1 day")));?>
  </div>
</div>
