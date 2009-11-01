<div class="yui-ge">
  <div class="yui-u first">
<h1>Edit Interview for <?=$this->data["Game"]["game_name"]?></h1>
<?
echo $form->create('Interview');
echo $form->hidden("interview_id");
echo $form->input('interview_title',array("type"=>"text"));
echo $form->input("game_id",array("empty"=>"(No game)"));
echo $form->input("developer_id");
echo $form->input("answerer",array("label"=>"Interviewee","after"=>" (optional)"));
echo $form->input("interviewer_id");
echo $form->input("interview_date",array("timeFormat"=>24,"dateFormat"=>"DMY","minYear"=>2000));
echo $form->input('text', array('rows' => '15',"label"=>false));
echo $form->end('Save');
?>
  </div>
  <div class="yui-u">
    <?=$this->element("spotlight",array("game_id"=>$this->data["Game"]["game_id"],"cache"=>array("key"=>$this->data["Game"]["game_id"],"time"=>"+1 day")));?>
  </div>
</div>