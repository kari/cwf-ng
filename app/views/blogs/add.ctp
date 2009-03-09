<h1>Add Post</h1>
<?php
echo $form->create('Blog');
?>
<?
echo $form->input('title');
echo $form->input('content', array('rows' => 15,"label"=>false,"between"=>"<br>"));
echo $form->input('user_id', array('type'=>'hidden','value'=>$session->read("Auth.User.user_id")));
?>
<?
echo $form->end('Save Post');
?>