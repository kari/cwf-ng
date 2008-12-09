<h1>Edit World News</h1>
<?
echo $form->create('WorldNews');
echo $form->input('wnews_title');
echo $form->input("wnews_adder",array("options"=>$users));
echo $form->input("wnews_date",array("timeFormat"=>24,"dateFormat"=>"DMY","minYear"=>2000));
echo $form->input('wnews_text', array('rows' => '5'));
echo $form->input("wnews_ext_link",array("type"=>"text"));
echo $form->input("wnews_embedded",array("type"=>"text"));
echo $form->hidden("wnews_id");
echo $form->end('Save');
?>