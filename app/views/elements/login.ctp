<?php
    # echo debug($session->read());
    if ($session->check('Message.auth')) $session->flash('auth');
    if ($session->check("Auth.User.user_id")) {
      echo "Hello, ".$html->link($session->read("Auth.User.username"),array("controller"=>"users","action"=>"view",$session->read("Auth.User.user_id"))).". ".$html->link("Logout?",array("controller"=>"users","action"=>"logout"));
    } else {
      echo $form->create('User', array("url"=>"users/login"));
      echo $form->input('username',array("value"=>""));
      echo $form->input('user_password',array('type' => 'password',"value"=>""));
      echo $form->end('Login');
    }
?>