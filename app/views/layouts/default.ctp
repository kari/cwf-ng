<?=$html->docType("html4-strict");?>
<html>
<head>
    <?=$html->charset(); ?>
    <title>CWF - <?=$title_for_layout; ?></title>
		<?=$html->meta('icon',$html->url("/favicon.ico"));?> <? # FIXME ?>
		<link rel="home" href="<?=$html->url("/")?>">
		<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/yui/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/yui/2.7.0/build/base/base-min.css">
    <?=$html->css('default');?>
    <?=$javascript->link("http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js");?>
    <?=$scripts_for_layout;?>
</head>
<body>
  <div id="doc4" class="yui-t2">
    <div id="hd">
      <div class="yui-ge">
        <div class="yui-u first"> <?=$html->link($html->image("/img/cwf_freeware.png",array("title"=>"CWF-Freeware","alt"=>"CWF-Freeware")),"/",array(),false,false)?>
        </div>
        <div class="yui-u">
          <div id="loginbox">
            <cake:nocache>
            <?=$this->element("login")?>
            </cake:nocache>
          </div>
        </div>
      </div>
        <ul class="nav">
          <li><?=$html->link("Main","/")?></li>
          <li><?=$html->link("Games","/games/")?></li>
          <li><?=$html->link("Site News","/news/")?></li>
          <li><?=$html->link("World News","/world_news")?></li>
          <li><?=$html->link("Reviews","/reviews/")?></li>
          <li><?=$html->link("Guides","/guides/")?></li>
          <li><?=$html->link("Interviews","/interviews/")?></li>
          <li><?=$html->link("Tools","/tools/")?></li>
          <li><?=$html->link("Forums","/forum")?></li>
          <li><?=$html->link("About us","/about")?></li>
          <? 
          if (isset($admin_mode) AND $admin_mode==true) {
          ?>
          <li class="admin"><?=$html->link("Admin",array("action"=>"admin"))?></li>
          <? 
            if (isset($this->params["pass"][0]) && $this->params["action"]=="view") { ?>    
          <li class="admin"><?=$html->link("Edit this",array("action"=>"edit",$this->params["pass"][0]))?></li>
          <? 
            } 
          }
          ?>
        </ul>  
          
        <div id="flash">
          <cake:nocache>
          <?
          	if ($session->check('Message.flash')) {
          		$session->flash();
          	}
          	if ($session->check('Message.auth')) {
          		$session->flash('auth');
          	}
          ?>
          </cake:nocache>
        </div>
    </div>
    <div id="bd">
      <div id="yui-main">
        <div class="yui-b">
         <!-- Main block -->
          <!-- can be split with yui-u div-classes -->
            <?=$content_for_layout ?>
          <div class="yui-g adbox">
            <p>&nbsp;</p>
            <cake:nocache>
            <?=$this->element("adbox",array("style"=>"pw-footer")) ?>
            </cake:nocache>
            <p>&nbsp;</p>
          </div>
        </div>
      </div>
      <div class="yui-b" id="sidebar">
        <!-- Sidebar content -->
        <cake:nocache>
        <?=$this->element("search",array("cache"=>array("key"=>"","time"=>"+1 hour")))?>
        <?=$this->element("spotlight",array("cache"=>array("key"=>"","time"=>"+1 hour")))?>
        <?
        if ($session->check("Auth.User.user_id")) {
          echo $this->element("gvsg");
        }
        ?>
        <?#=$this->element("toplatest",array("cache"=>array("key"=>"","time"=>"+1 hour")))?>
        <?=$this->element("toprated",array("cache"=>array("key"=>"","time"=>"+6 hour")))?>
        <?=$this->element("topdownloads",array("cache"=>array("key"=>"","time"=>"+1 day")))?>
        <?#=$this->element("adbox",array("style"=>"pw-square"))?>
        <?=$this->element("link_exchange",array("cache"=>array("key"=>"","time"=>"+1 day")))?>
        </cake:nocache>
      </div>
    </div>
    <div id="ft">
      <!-- Footer conent -->
      <p>All trademarks and copyrights on this page are owned by their respective owners. User generated content is owned by their authors.<br/> Site &copy; 2009 CWF-Freeware. <?=$html->link("Terms of Service and Privacy Policy",array("controller"=>"pages","action"=>"disclaimer"))?>. <?=$html->link("Copyright and Acknowledgments",array("controller"=>"pages","action"=>"acknowledgments"))?>.</p>
      <?
      if (Configure::read("Site.track") == true) echo $this->element("ga");
      ?>
    </div>
  </div>
</body>
</html>
