<?php
    # echo debug($Auth);
    if ($session->check('Message.auth')) $session->flash('auth');
    if (isset($Auth["User"])) {
      echo "Hello, ".$html->link($Auth["User"]["username"],array("controller"=>"users","action"=>"view",$Auth["User"]["user_id"])).". ".$html->link("Logout?",array("controller"=>"users","action"=>"logout"));
    } else {
      echo $form->create('User', array("controller"=>"users",'action' => 'login'));
      echo $form->input('username');
      echo $form->input('user_password',array('type' => 'password'));
      echo $form->end('Login');
    }
?>