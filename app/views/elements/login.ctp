<?php
    # echo debug($session->read());
    if ($session->check('Message.auth')) $session->flash('auth');
    if ($session->check("Auth.User.user_id")) {
      echo "Hello, ".$html->link($session->read("Auth.User.username"),array("controller"=>"users","action"=>"view",$session->read("Auth.User.user_id"))).". ".$html->link("Logout?",array("controller"=>"users","action"=>"logout"));
    } else {
      /* Surprsingly enough, FormHelper is not available when cached...
      echo $form->create('User', array("url"=>"/users/login")); # FIXME
      echo $form->input('username',array("value"=>"","label"=>"Username"));
      echo $form->input('user_password',array('type' => 'password',"value"=>"","label"=>"Password"));
      echo $form->end('Login'); */
    ?>
    <form method="post" action="/~zyx/cwf-ng/users/login"><fieldset style="display:none;"><input type="hidden" name="_method" value="POST" /></fieldset><div class="input text"><label for="UserUsername">Username</label><input name="data[User][username]" type="text" value="" maxlength="25" id="UserUsername" /></div><div class="input password"><label for="UserUserPassword">Password</label><input type="password" name="data[User][user_password]" value="" id="UserUserPassword" /></div><div class="submit"><input type="submit" value="Login" /></div></form>
    <?
    }
?>