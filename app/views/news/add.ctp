<h1>Add News</h1>
<?
echo $form->create('News');
echo $form->input('news_title',array("title"=>"Title"));
echo $form->input('news_text', array('rows' => 15,"label"=>false,"between"=>"<br>"));
echo $form->hidden('poster_id', array('value'=>$user_id));
echo $form->end('Save');
?>