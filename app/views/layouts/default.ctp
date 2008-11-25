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
  <div id="doc">
    <div id="hd">
      <?=$html->link($html->image("/img/cwf_freeware.png",array("title"=>"CWF-Freeware","alt"=>"CWF-Freeware")),"/",array(),false,false)?>
      <ul class="nav">
        <li><?=$html->link("Main","/")?></li>
        <li><?=$html->link("Games","/games/")?></li>
        <li><?=$html->link("Blogs","/blogs/")?></li>
        <li><?=$html->link("News","/news/")?></li>
        <li><?=$html->link("Reviews","/reviews/")?></li>
        <li><?=$html->link("Interviews","/interviews/")?></li>
        <li><?=$html->link("Forums","/forum")?></li>
      </ul>
    <div id="loginbox">
    <?=$this->element("login")?>
    </div>
    </div>
    <div id="bd">
    <?
    	if ($session->check('Message.flash')) {
    		$session->flash();
    	}
    	if ($session->check('Message.auth')) {
    		$session->flash('auth');
    	}
    ?>
    <?=$content_for_layout ?>
    </div>
    <div id="ft"></div>
  </div>
</body>
</html>
