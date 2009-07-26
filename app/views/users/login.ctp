<h1>Login</h1>
<?php
    if ($session->check('Message.auth')) $session->flash('auth');
    echo "<br";
    echo $form->create('User', array('action' => 'login'));
    # echo "<fieldset><legend>Login</legend>";
    echo $form->input('username',array("label"=>"User name"));
    echo $form->input('user_password',array('type' => 'password',"label"=>"Password"));
    echo "<br>";
    echo $form->input("remember_me",array("type"=>"checkbox","label"=>"Remember login"));
    # echo "</fieldset>";
    echo $form->end('Login');
?>
<p><?=$html->link("Forgot your password?","/resetpassword",array("class"=>"button"))?> <?=$html->link("Register a new account","/signup",array("class"=>"button"))?></p>
<h2>Not a user yet? Sign up!</h2>
<p>Registering at CWF will give you lots of added benefits. As a registered user, you can take part in our freeware community in many ways. You'll be able discuss about games and other things in our forums, write reviews for games you love and you also get a free blog where you can write about pretty much anything you want. <?=$html->link("So, sign-up already!","/signup")?></p>