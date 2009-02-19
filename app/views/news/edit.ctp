<h1>Edit News</h1>
<?
echo $form->create('News');
echo $form->input('news_title',array("label"=>"Title"));
echo $form->input("poster_id",array("label"=>"Author"));
echo $form->input("post_date",array("timeFormat"=>24,"dateFormat"=>"DMY","minYear"=>2000));
echo $form->input('news_text', array('rows' => '15',"label"=>false));
echo $form->hidden('edited_by', array('value'=>$user_id));
echo $form->hidden("news_id");
echo $form->end('Save');
?>