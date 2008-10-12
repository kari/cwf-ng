<?=$html->docType("html4-trans");?>
<html>
<head>
    <?=$html->charset("utf-8"); ?>
    <title><?=$title_for_layout; ?></title>
		<?=$html->meta('icon');?>
		<?=$html->css('blueprint/screen.css',"text/css",array("media"=>"screen, projection"));?>
		<!--[if IE]><?=$html->css('blueprint/ie.css',"text/css",array("media"=>"screen, projection")); ?><![endif]-->
    <?=$html->css('gh');?>
    <?=$scripts_for_layout;?>
</head>
<body>
<? # header ?>
<div class="container">
<div id="header" class="span-24">
	<div id="header_inner">
		<?=$html->image('header.jpg',array("alt"=>"Gamehippo United")); ?>
		<a href="/forum/">FORUMS</a> | <a href="#">CHAT</a> | <a href="#">DONATE</a> | <a href="#">STAFF</a>
	</div>
</div>

<div id="menu" class="span-4">
			<h3>GAME CATEGORIES</h3>
			<p><a href="#">THE BEST</a></p>
			<p><a href="#">ACTION</a></p>
			<p><a href="#">ADVENTURE</a></p>
			<p><a href="#">ARCADE/CLASSIC</a></p>
			<p><a href="#">BOARD</a></p>
			<p><a href="#">CARD</a></p>
			<p><a href="#">CASINO</a></p>
			<p><a href="#">DICE</a></p>
			<p><a href="#">EDUCATIONAL</a></p>
			<p><a href="#">LOGIC/PUZZLE</a></p>
			<p><a href="#">SIMULATION</a></p>
			<p><a href="#">SPORTS</a></p>
			<h3>MOST POPULAR</h3>
			<p><a href="#">TOP 20 DOWNLOADS</a></p>
			<p><a href="#">TOP 20 RATED</a></p>
			<p><a href="#">TOP 10 REVIEWERíS PICK</a></p>
			<h3>MISCELLANEOUS</h3>
			<p><a href="#">PREVIEWS (39)</a></p>
			<p><a href="#">BROWSER GAMES (12)</a></p>
			<p><a href="#">HIGH SCORES</a></p>
			<p><a href="#">CHEATS &lt; HINTS</a></p>
			<p><a href="#">FAQ</a></p>
			<p><a href="#">REVIEW GUIDE</a></p>
			<p><a href="#">FILES &lt; LIBRARIES</a></p>
			<p><a href="#">SUBMIT A GAME</a></p>
			<p><a href="#">NEWSLAETTER</a></p>
			<p><a href="#">RSS NEWSFEED</a></p>
			<h3>COMMUNITY</h3>
			<p><a href="#">MESSAGEBOARD</a></p>
			<p><a href="#">CHAT</a></p>
			<p><a href="#">GAMEHIPPO CLAN</a></p>
			<p><a href="#">CONTACT</a></p>
			<p><a href="#">GAMEHIPPO STAFF BIOS</a></p>
</div>
<? # content ?>
<div id="main" class="span-20 last">
<?php echo $content_for_layout ?>
</div>
<? # footer ?>
</div>
</body>
</html>
