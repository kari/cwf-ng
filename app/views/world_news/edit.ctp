<h1>Edit World News</h1>
<?
echo $form->create('WorldNews');
echo $form->input('wnews_title',array("label"=>"Title"));
echo $form->input("wnews_adder",array("options"=>$users,"label"=>"Author"));
echo $form->input("wnews_date",array("timeFormat"=>24,"dateFormat"=>"DMY","minYear"=>2000,"label"=>"Post Date"));
echo $form->input("wnews_ext_link",array("type"=>"text","label"=>"External link","after"=>" (optional)"));
echo $form->input("wnews_embedded",array("type"=>"text","label"=>"YouTube link","after"=>" (optional)"));
echo $form->input('wnews_text', array('rows' => '15',"label"=>false));
echo $form->hidden("wnews_id");
echo $form->end('Save');
?>