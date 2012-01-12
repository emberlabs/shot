<?php
/**
 *
 *===================================================================
 *
 *  Shot Library
 *-------------------------------------------------------------------
 * @package     shot
 * @author      emberlabs.org
 * @copyright   (c) 2012 emberlabs.org
 * @license     MIT License
 * @link        https://github.com/emberlabs/shot
 *
 *===================================================================
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 *
 */

namespace emberlabs\shot\Live;
use \emberlabs\shot\Kernel;
use \OpenFlame\Framework\Core\Autoloader;
use \OpenFlame\Framework\Exception\EncryptedHandler as ExceptionHandler;
use \OpenFlame\Framework\Utility\JSON;
use \OpenFlame\Dbal\Connection as DbalConnection;

// get error reporting stuff
$_e_reporting = @error_reporting();

if(!defined('SHOT_INCLUDE_ROOT'))
{
	die('Required constant "SHOT_INCLUDE_ROOT" not defined');
}
if(!defined('SHOT_DEBUG'))
{
	define('SHOT_DEBUG', false);
}

// set up autoloader
require SHOT_INCLUDE_ROOT . 'OpenFlame/Framework/Core/Autoloader.php';
Autoloader::register(SHOT_INCLUDE_ROOT);

// register the exception handler
ExceptionHandler::register();

ExceptionHandler::setPageFormat('
<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8" />
		<title>%1$s</title>
		<style type="text/css">
		* { margin: 0; padding: 0; } html { font-size: 100%%; height: 100%%; margin-bottom: 1px; background-color: #FFFFFF; } body { font-family: "Lucida Grande", Verdana, Helvetica, Arial, sans-serif; color: #825353; background: #FFFFFF; font-size: 62.5%%; margin: 0; padding: 20px; } a:link, a:active, a:visited { color: #AA1F00; text-decoration: none; } a:hover { color: #DD6900; text-decoration: underline; } header { height: 30px; } footer { clear: both; font-size: 1em; text-align: center; }
		#errorpage #wrap { padding: 12px 20px; min-width: 700px; border-radius: 12px; margin: 4px 0; background-color: #FEEFDA; border: solid 1px #F7941D; } #errorpage #content { margin-top: 10px; margin-bottom: 5px; padding-bottom: 5px; color: #333333; font: bold 1.15em "Lucida Grande", Arial, Helvetica, sans-serif; text-decoration: none; line-height: 120%%;} #errorpage #content #backtrace { border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; }
		.syntaxbg { color: #FFFFFF; } .syntaxcomment { color: #FF8000; } .syntaxdefault { color: #0000BB; } .syntaxhtml { color: #000000; } .syntaxkeyword { color: #007700; } .syntaxstring { color: #DD0000; }
		</style>
	</head>
	<body id="errorpage">
		<div id="wrap">
			<header>
				<h2>%1$s</h2>
			</header>
			<section id="content">
				<p>%2$s</p>
			</section>
		</div>
		<footer>
			Powered by <a href="http://emberlabs.org/">ember labs</a>
		</footer>
	</body>
</html>');

// Force full debug on here
@error_reporting(E_ALL);
@ini_set("display_errors", "On");
ExceptionHandler::enableDebug();

// check for blocking requirements
if(@ini_get('register_globals'))
{
	throw new RequirementException('Application will not run with register_globals enabled; please disable register_globals to run this application.');
}
if(@get_magic_quotes_gpc())
{
	throw new RequirementException('Application will not run with magic_quotes_gpc enabled; please disable magic_quotes_gpc to run this application.');
}
if(@get_magic_quotes_runtime())
{
	throw new RequirementException('Application will not run with magic_quotes_runtime enabled; please disable magic_quotes_runtime to run this application.');
}

require SHOT_INCLUDE_ROOT . 'emberlabs/shot/Live/Functions.php';
require SHOT_INCLUDE_ROOT . 'emberlabs/shot/Live/Injectors.php';
require SHOT_INCLUDE_ROOT . 'emberlabs/shot/Live/Listeners.php';

// do we leave debug on, or...
if(!SHOT_DEBUG)
{
	@error_reporting($_e_reporting);
	@ini_set("display_errors", "Off");
	ExceptionHandler::disableDebug();
}
