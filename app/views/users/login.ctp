<h1>Login</h1>
<?php
    if ($session->check('Message.auth')) $session->flash('auth');
    echo $form->create('User', array('action' => 'login'));
    # echo "<fieldset><legend>Login</legend>";
    echo $form->input('username',array("label"=>"User name"));
    echo $form->input('user_password',array('type' => 'password',"label"=>"Password"));
    # echo "</fieldset>";
    echo $form->end('Login');
?>
<p><a href="/resetpassword">Forgot your password?</a></p>
<h2>Not a user yet? Sign up!</h2>
<p>Registering at CWF will give you lots of added benefits. As a registered user, you can take part in our freeware community in many ways. You'll be able discuss about games and other things in our forums, write reviews for games you love and you also get a free blog where you can write about pretty much anything you want. <a href="/signup">So, sign-up already!</a></p>