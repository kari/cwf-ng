<h1>Add Interview</h1>
<?
echo $form->create('Interview');
echo $form->input('interview_title',array("type"=>"text","label"=>"Title"));
echo $form->hidden('interviewer_id', array('value'=>$user_id));
echo $form->input("game_id");
echo $form->input("developer_id");
echo $form->input("answerer",array("label"=>"Interviewee","after"=>" (optional)"));
echo $form->input("interview_date",array("timeFormat"=>24,"dateFormat"=>"DMY","minYear"=>2000));
echo $form->input('text', array('rows' => 20,"label"=>false,"between"=>"<br>"));
echo $form->end('Save');
?>