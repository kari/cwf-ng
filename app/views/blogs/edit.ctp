<h1>Edit Post</h1>
<?php
	echo $form->create('Blog', array('action' => 'edit'));
	echo $form->input('title');
	echo $form->input('content', array('rows' => '3'));
  echo $form->input('id', array('type'=>'hidden'));
  echo $form->input('user_id', array('type'=>'hidden','value'=>'65'));  
	echo $form->end('Save Post');
?>