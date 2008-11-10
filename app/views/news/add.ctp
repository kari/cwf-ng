<h1>Add News</h1>
<?
echo $form->create('News');
echo $form->input('news_title');
echo $form->input('news_text', array('rows' => '5'));
echo $form->hidden('poster_id', array('value'=>$user_id));
echo $form->end('Save');
?>