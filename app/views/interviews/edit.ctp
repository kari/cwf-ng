<h1>Add Interview</h1>
<?
echo $form->create('Interview');
echo $form->input('interview_title');
echo $form->input('text', array('rows' => '5'));
echo $form->input("game_id");
echo $form->input("developer_id");
echo $form->input("answerer");
echo $form->input("interviewer_id");
echo $form->input("interview_date",array("timeFormat"=>24,"dateFormat"=>"DMY","minYear"=>2000));
echo $form->end('Save');
?>