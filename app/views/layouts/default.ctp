<?=$html->docType("html4-strict");?>
<html>
<head>
    <?=$html->charset("utf-8"); ?>
    <title>CWF - <?=$title_for_layout; ?></title>
		<?=$html->meta('icon',"/~zyx/cwf-ng/favicon.ico");?> <? # FIXME ?>
    <?=$html->css('default');?>
    <?=$javascript->link("http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js");?>  
    <?#=$javascript->link("http://ajax.googleapis.com/ajax/libs/yui/2.6.0/build/yuiloader/yuiloader-min.js"); ?>
    <?=$scripts_for_layout;?>
</head>
<body>
  <div id="doc4" class="yui-t2">
    <div id="hd">
            <?=$html->link($html->image("/img/cwf_freeware.png",array("title"=>"CWF-Freeware","alt"=>"CWF-Freeware")),"/",array(),false,false)?>
            <div id="loginbox">
              <cake:nocache>
              <?=$this->element("login")?>
              </cake:nocache>
            </div>
          <ul class="nav">
            <li><?=$html->link("Main","/")?></li>
            <li><?=$html->link("Games","/games/")?></li>
            <li><?=$html->link("Blogs","/blogs/")?></li>
            <li><?=$html->link("News","/news/")?></li>
            <li><?=$html->link("Reviews","/reviews/")?></li>
            <li><?=$html->link("Interviews","/interviews/")?></li>
            <li><?=$html->link("Tools","/tools/")?></li>
            <li><?=$html->link("Forums","/forum")?></li>
          </ul>
        <div id="flash">
          <?
          	if ($session->check('Message.flash')) {
          		$session->flash();
          	}
          	if ($session->check('Message.auth')) {
          		$session->flash('auth');
          	}
          ?>
        </div>  
    </div>
    <div id="bd">
      <div id="yui-main">
        <div class="yui-b">
         <!-- Main block -->
          <!-- can be split with yui-u div-classes -->
            <?=$content_for_layout ?>
          <div class="yui-g">
            <cake:nocache>
            <?=$this->element("adbox",array("style"=>"pw-leaderboard")) ?>
            </cake:nocache>
          </div>
        </div>
      </div>
      <div class="yui-b" id="sidebar">
        <!-- Sidebar content -->
        <cake:nocache>
        <?=$this->element("spotlight",array("cache"=>array("key"=>"frontpage","time"=>"+1 hour")))?>
        <?=$this->element("toplatest",array("cache"=>array("key"=>"frontpage","time"=>"+1 hour")))?>
        <?=$this->element("toprated",array("cache"=>array("key"=>"frontpage","time"=>"+6 hour")))?>
        <?=$this->element("topdownloads",array("cache"=>array("key"=>"frontpage","time"=>"+1 day")))?>
        <?=$this->element("adbox",array("style"=>"pw-square"))?>
        </cake:nocache>
      </div>
    </div>
    <div id="ft">
      <!-- Footer content -->
    </div>
  </div>
</body>
</html>
