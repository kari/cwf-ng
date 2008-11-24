<?=$html->docType("html4-strict");?>
<html>
<head>
    <?=$html->charset("utf-8"); ?>
    <title>CWF - <?=$title_for_layout; ?></title>
		<?=$html->meta('icon',"/img/icons/sport_shuttlecock.png");?> <? # FIXME ?>
    <?=$html->css('default');?>
    <?=$javascript->link("http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js");?>  
    <?#=$javascript->link("http://ajax.googleapis.com/ajax/libs/yui/2.6.0/build/yuiloader/yuiloader-min.js"); ?>
    <?=$scripts_for_layout;?>
</head>
<body>
  <div id="doc">
    <div id="hd"><h1><?=$html->link("CWF-Freeware","/")?></h1></div>
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
