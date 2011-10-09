<?php
/* SVN FILE: $Id: bootstrap.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 *
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php is loaded
 * This is an application wide file to load any function that is not used within a class define.
 * You can also use this to include or require any files in your application.
 *
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * $modelPaths = array('full path to models', 'second full path to models', 'etc...');
 * $viewPaths = array('this path to views', 'second full path to views', 'etc...');
 * $controllerPaths = array('this path to controllers', 'second full path to controllers', 'etc...');
 *
 */


$referrer = $_SERVER['HTTP_HOST'];

if (preg_match("%demos.exygy.com%",$referrer)) {
	define('BASE_DOMAIN', 'eurekafund.demos.exygy.com');
} else if (preg_match("%alpha.eurekafund.org%",$referrer)) {
	define('BASE_DOMAIN', 'alpha.eurekafund.org');
} else if (preg_match("%testing.eurekafund.org%",$referrer)) {
	define('BASE_DOMAIN', 'testing.eurekafund.org');
} else if (preg_match("%localhost%",$referrer)) {
  define('BASE_DOMAIN', 'eureka.localhost');
} else if (preg_match("%dk.exygy.com%",$referrer)) {
  define('BASE_DOMAIN', 'eureka.dk.exygy.com');
} else if (preg_match("%chimichanga%",$referrer)) {
  // define('BASE_DOMAIN', 'eurekafund.chimichanga:8888');
	define('BASE_DOMAIN', 'eurekafund.chimichanga');
} else if (preg_match("%mfi.sc.exygy.com%",$referrer)) {
	define('BASE_DOMAIN', 'mfi.sc.exygy.com');
} else if (preg_match("%zb.exygy%",$referrer)) {
	define('BASE_DOMAIN', 'eurekafund.zb.exygy.com');
	define('GOOGLE_OAUTH_CONSUMER_SECRET', 'wMLQgiWOHaBhNvc1I8UMqjLp' );
} else if (preg_match("%mp.exygy%",$referrer)) {
	define('BASE_DOMAIN', 'eurekafund.mp.exygy.com');
	define('GOOGLE_OAUTH_CONSUMER_SECRET', 'JVwIpQ4R0JsK4OXHcW7E7zcq' );
} else if (preg_match("%eurekafund.org%",$referrer)) {
	define('BASE_DOMAIN', 'eurekafund.org');
	define('GOOGLE_OAUTH_CONSUMER_SECRET', 'JVwIpQ4R0JsK4OXHcW7E7zcq' );
} else {
	define('BASE_DOMAIN', 'eurekafund.demos.exygy.com'); //insert default here 
}

define( 'HTTP_BASE', 'http://' . BASE_DOMAIN . '/' );
define( 'FB_APIKEY', '81d82a29d6d77f7af8d7f3e797e62429' );
define( 'FB_SECRET', 'e7505d6e01d6ccfefe9c6f1ac2be5226' );

include_once('constants.php');
include_once('languages.php');
 
//EOF
?>