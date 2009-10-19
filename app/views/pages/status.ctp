<? $this->pageTitle = "System Status"; ?>
<h1>CWF-ng status</h1>
<h2>Server Environment</h2>
CWF-ng Version: 1.0-dev<br>
PHP Version: <?=phpversion()?><br>
GD Version: <?
if (!extension_loaded("gd")) {
  echo "<span class=\"notice\">Not installed</span>";
} else {
  echo phpversion("gd");
}
?><br>
CakePHP Version: <?=Configure::version()?><br>
MySQL Server Version: <?
if (mysql_get_server_info()) {
  echo mysql_get_server_info();
} else {
  echo "<span class=\"notice\">Not available</span>";
}
?><br>
Operating system signature: <?=php_uname("a")?><br>
HTTP Server signature: <?=$_SERVER["SERVER_SOFTWARE"]?><br>

<h2>CakePHP Environment</h2>
<p><?php
	if (is_writable(TMP)):
		echo '<span class="notice success">';
			__('tmp directory is writable.');
		echo '</span>';
	else:
		echo '<span class="notice">';
			__('tmp directory is NOT writable.');
		echo '</span>';
	endif;
?>
</p><p>
	<?php
		$settings = Cache::settings();
		if (!empty($settings)):
			echo '<span class="notice success">';
					echo sprintf(__('The %s is being used for caching. To change the config edit APP/config/core.php ', true), '<em>'. $settings['engine'] . 'Engine</em>');
			echo '</span>';
		else:
			echo '<span class="notice">';
					__('Your cache is NOT working. Please check the settings in APP/config/core.php');
			echo '</span>';
		endif;
	?>
</p>
<p>
	<?php
		$filePresent = null;
		if (file_exists(CONFIGS.'database.php')):
			echo '<span class="notice success">';
				__('Your database configuration file is present.');
				$filePresent = true;
			echo '</span>';
		else:
			echo '<span class="notice">';
				__('Your database configuration file is NOT present.');
				echo '<br/>';
				__('Rename config/database.php.default to config/database.php');
			echo '</span>';
		endif;
	?>
</p>
<?php
if (isset($filePresent)):
	uses('model' . DS . 'connection_manager');
	$db = ConnectionManager::getInstance();
	@$connected = $db->getDataSource('default');
?>
<p>
	<?php
		if ($connected->isConnected()):
			echo '<span class="notice success">';
	 			__('Cake is able to connect to the database.');
			echo '</span>';
		else:
			echo '<span class="notice">';
				__('Cake is NOT able to connect to the database.');
			echo '</span>';
		endif;
	?>
</p>
<?php endif;?>
<p>Path to screenshots: <?=Configure::read("Site.screenshot_path")?><br/>
  Path to avatars: <?=Configure::read("Site.avatar_path")?><br>
  Path to downloads: <?=Configure::read("Site.file_path")?><br/>
  Site path: <?=Router::url("/")?></p>
<?=$this->element("license")?>