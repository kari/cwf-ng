<?=$html->docType("html4-strict");?>
<html>
<head>
    <?=$html->charset("utf-8"); ?>
    <title>CWF - <?=$title_for_layout; ?></title>
		<?=$html->meta('icon',"/~zyx/cwf-ng/img/icons/sport_shuttlecock.png");?> <? # FIXME ?>
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
              <?=$this->element("login")?>
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
            <?=$this->element("adbox",array("style"=>"pw-leaderboard")) ?>
          </div>
        </div>
      </div>
      <div class="yui-b" id="sidebar">
        <!-- Sidebar content -->
        <?=$this->element("spotlight")?>
        <?=$this->element("toplatest")?>
        <?=$this->element("toprated")?>
        <?=$this->element("topdownloads")?>
        <?=$this->element("adbox",array("style"=>"pw-skyscraper"))?>
      </div>
    </div>
    <div id="ft">
      <!-- Footer content -->
    </div>
  </div>
</body>
</html>
