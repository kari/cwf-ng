<h1>Edit News</h1>
<?
echo $form->create('News');
echo $form->input('news_title');
echo "Created by";
echo $form->select("poster_id",$users);
echo $form->input("post_date",array("timeFormat"=>24,"dateFormat"=>"DMY","minYear"=>"2008"));
echo $form->input('news_text', array('rows' => '5'));
# echo $form->hidden('poster_id');
echo $form->hidden('edited_by', array('value'=>$user_id));
echo $form->hidden("news_id");
echo $form->end('Save');
?>