<?php
    if ($session->check("Auth.User.user_id")) {
      echo "<table class=\"slim\"><tr><td>";
      echo $site->avatar($session->read("Auth.User"),array("width"=>48,"height"=>48,"align"=>"left"));
      echo "</td><td>";
      echo "Hello, ".$html->link($session->read("Auth.User.username"),array("controller"=>"users","action"=>"view",$session->read("Auth.User.user_id"))).".<br> ".$html->link("Logout?",array("controller"=>"users","action"=>"logout"));
      echo "</td></tr></table>";
      if ($session->read("Auth.User.user_new_privmsg") > 0) { 
        echo $html->image("/img/icons/email.png")." ".$html->link("New private messages.","http://".Configure::read("Site.url")."/privmsg.php?folder=inbox",null,null,false); 
      }
    } else {
      # Surprsingly enough, FormHelper is not available when cached...
      echo $form->create('User', array("url"=>"/users/login")); # FIXME
      echo "<table class=\"slim\"><tr><td>";
      echo $form->input('username',array("value"=>"","label"=>"Username","class"=>"short"));
      echo $form->input('user_password',array('type' => 'password',"value"=>"","label"=>"Password","class"=>"short"));
      echo "</td><td>";
      echo $form->end('Login');
      echo "<br>".$html->link("Register","/signup",array("class"=>"x-button"));
      echo "</td></tr></table>";
    }
?>