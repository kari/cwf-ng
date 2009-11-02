<?php
    if ($session->check("Auth.User.user_id")) {
      echo "<table class=\"slim\"><tr><td>";
      echo $site->avatar($session->read("Auth.User"),array("width"=>48,"height"=>48,"align"=>"left"));
      echo "</td><td>";
      echo "Hello, ".$html->link($session->read("Auth.User.username"),array("controller"=>"users","action"=>"view",$session->read("Auth.User.user_id"))).".<br><small> ".$html->link("Logout?",array("controller"=>"users","action"=>"logout"));
			# echo "</td></tr><tr><td colspan=\"2\">"
			echo "<br><br>";
      if ($session->read("Auth.User.user_new_privmsg") > 0) { 
        # echo $html->image("/img/icons/email.png")." ".
				echo $html->link("New private messages","http://".Configure::read("Forum.url")."/privmsg.php?folder=inbox",null,null,false);
 				echo "<br>";
      }
			echo $html->link("New forum posts","http://".Configure::read("Forum.url")."/search.php?search_id=newposts",null,null,false);
			echo "</small></td></tr></table>";
    } else {
      # Surprsingly enough, FormHelper is not available when cached...
      echo "<table class=\"slim\"><tr><td>";
 			echo $form->create('User', array("url"=>"/users/login")); # FIXME
      echo $form->input('username',array("value"=>"","label"=>"Username","class"=>"short"));
      echo $form->input('user_password',array('type' => 'password',"value"=>"","label"=>"Password","class"=>"short"));
      echo "</td><td>";
      echo $form->button("Login",array("type"=>"submit"));
      echo "<hr><p>".$html->link("Register","/signup",array("class"=>"x-button"))."</p>";
			echo $form->end();      
			echo "</td></tr></table>";
    }
?>