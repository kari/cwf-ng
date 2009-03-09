<h1>Add Guide</h1>
<?
echo $form->create('Guide');
echo $form->input("game_id");
echo $form->input('title',array("type"=>"text","label"=>"Guide title"));
echo $form->input('text', array('rows' => 20,"label"=>false));
echo $form->hidden('user_id', array('value'=>$user_id));
echo $form->end('Save');
?>