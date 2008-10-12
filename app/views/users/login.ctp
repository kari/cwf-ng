<?php
    if ($session->check('Message.auth')) $session->flash('auth');
    echo $form->create('User', array('action' => 'login'));
    echo $form->input('username');
    echo $form->input('user_password',array('type' => 'password'));
    echo $form->end('Login');
?>