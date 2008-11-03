<?=$html->docType("html4-strict");?>
<html>
<head>
    <?=$html->charset("utf-8"); ?>
    <title>CWF - <?=$title_for_layout; ?></title>
		<?=$html->meta('icon');?>
    <?=$html->css('default');?>
    <?=$javascript->link("/js/jquery.js");?>
    <?=$scripts_for_layout;?>
</head>
<body>
  <div id="doc">
    <div id="hd"><h1><?=$html->link("CWF-Freeware","/")?></h1></div>
    <div id="bd">
    <? $session->flash()?>
    <?=$content_for_layout ?>
    </div>
    <div id="ft"></div>
  </div>
</body>
</html>
