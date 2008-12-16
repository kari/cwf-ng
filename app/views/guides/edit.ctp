<h1>Edit Guide</h1>
<?
echo $form->create('Guide');
echo $form->input('title');
echo $form->input('text', array('rows' => '5'));
echo $form->input('user_id');
echo $form->input("game_id");
echo $form->end('Save');
?>