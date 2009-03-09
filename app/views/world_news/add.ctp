<h1>Add World News</h1>
<?
echo $form->create('WorldNews');
echo $form->input('wnews_title',array("label"=>"Title"));
echo $form->input('wnews_text', array('rows' => 15,"label"=>false,"between"=>"<br>"));
echo "<fieldset><legend>Optional</legend>";
echo $form->input("wnews_ext_link",array("type"=>"text","label"=>"External link"));
echo $form->input("wnews_embedded",array("type"=>"text","label"=>"YouTube link"));
echo "<em>example: http://www.youtube.com/watch?v=oHg5SJYRHA0</em>";
echo "</fieldset>";
echo $form->hidden('wnews_adder', array('value'=>$user_id));
echo $form->end('Save');
?>