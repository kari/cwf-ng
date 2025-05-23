<?php
/* SVN FILE: $Id: routes.php 7296 2008-06-27 09:09:03Z gwoo $ */
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app.config
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 7296 $
 * @modifiedby		$LastChangedBy: gwoo $
 * @lastmodified	$Date: 2008-06-27 02:09:03 -0700 (Fri, 27 Jun 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.thtml)...
 */
	# Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	Router::connect("/",array("controller" => "pages", "action" => "home"));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	# Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
/**
 * Then we connect url '/test' to our test controller. This is helpful in
 * developement.
 */
	# Router::connect('/tests', array('controller' => 'tests', 'action' => 'index'));
	
	// CWF routes
	Router::connect("/admin",array("controller"=>"pages","action"=>"admin"));
	Router::connect("/sitemap",array("controller"=>"pages","action"=>"sitemap"));
	Router::connect("/signup",array("controller"=>"users","action"=>"signup"));
	Router::connect("/about",array("controller"=>"pages","action"=>"about"));
	Router::connect("/game_info.php",array("controller"=>"games","action"=>"legacy"));
	Router::parseExtensions('atom','xml');
?>