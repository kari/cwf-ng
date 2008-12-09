<h1>Add World News</h1>
<?
echo $form->create('WorldNews');
echo $form->input('wnews_title');
echo $form->input('wnews_text', array('rows' => '5'));
echo $form->input("wnews_ext_link",array("type"=>"text"));
echo $form->input("wnews_embedded",array("type"=>"text"));
echo $form->hidden('wnews_adder', array('value'=>$user_id));
echo $form->end('Save');
?>