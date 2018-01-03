<?php
/**
* Fetch configuration, define basic constants and instantiate global classes
* @package Jabali - The Plug-N-Play Framework
* @subpackage Initialization
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.09
* @link https://docs.jabalicms.org/init/
* @license MIT - https://opensource.org/licenses/MIT
**/

/**
* Load app configuration
**/
require_once ( 'app/config.php' );

/**
* Script Directories.
**/
define( '_ABS_', __DIR__ );
define( '_ABSAD_', _ABS_ . '/admin/' );
define( '_ABSRES_', _ABS_ . '/app/' );
define( '_ABSLIB_', _ABSRES_ . 'lib/' );
define( '_ABSX_', _ABSRES_ . 'modules/' );
define( '_ABSTHEMES_', _ABSRES_ . 'themes/' );
define( '_ABSVIEWS_', _ABSRES_ . 'views/' );
define( '_ABSDB_', _ABSRES_ . 'data/bases/' );
define( '_ABSUP_', _ABS_ . '/uploads/' );
define( '_ABSTEMP_', _ABSUP_. 'temp/' );

/**
* URL Paths.
**/
define( '_ADMIN', _ROOT .'/admin/' );
define( '_RES', _ROOT .'/app/' );
define( '_UPLOADS', _ROOT .'/uploads/' );
define( '_X', _RES .'/modules/' );
define( '_THEMES', _RES.'themes/' );

/**
* Assets
**/
define( '_ASSETS', _ROOT.'/'.'app/assets/' );
define( '_STYLES', _ASSETS.'css/' );
define( '_SCRIPTS', _ASSETS.'js/' );
define( '_IMAGES', _ASSETS.'images/' );
define( '_FONTS', _ASSETS.'fonts/' );

/**
* Endpoints
**/
define( '_LOGIN', _ROOT.'/login/' );
define( '_REGISTER', _ROOT.'/register/' );
define( '_API', _ROOT.'/api/' );

/**
* Default contacts
**/
define( '_EMAIL', 'jabali@mauko.co.ke' );
define( '_PHONE', '+254 20 440 4993' );

spl_autoload_register( function( $class ) {
	$classname = str_replace( "Jabali\\", "", $class );
	$classpath = strtolower( str_replace( "\\", "/", $classname ) );

	require_once ( 'app/' . $classpath . '.php');
});

/**
* Load external libraries
**/
require_once('app/lib/guzzle/vendor/autoload.php');
require_once('app/lib/phpmailer/vendor/autoload.php');

/**
* Load common Jabali functions
**/
require_once ( 'app/functions.php' );

/**
* Load correct database, according to type selected in cofiguration file.
**/
switch ( $server["dbtype"] ) {
	case 'MySQL':
		$GLOBALS['JBLDB'] = new Jabali\Data\Access\Layers\MySQLDB( $server["dbhost"] , $server["dbuser"] , $server["dbpass"] , $server["dbname"] );
		break;

	case 'SQLite':
		$GLOBALS['JBLDB'] = new Jabali\Data\Access\Layers\SQLiteDB( $server["dbname"] );
		break;

	case 'PostgreSQL':
		$GLOBALS['JBLDB'] = new Jabali\Data\Access\Layers\PostgreDB( $server["dbhost"] , $server["dbuser"] , $server["dbpass"] , $server["dbname"], $server["dbport"] );
		break;

	case 'CouchDB':
		$GLOBALS['JBLDB'] = new Jabali\Data\Access\Layers\CouchDB( $server["dbhost"] , $server["dbuser"] , $server["dbpass"] , $server["dbname"], $server["dbport"] );
		break;

	default:
		$GLOBALS['JBLDB'] = new Jabali\Data\Access\Layers\MySQLDB( $server["dbhost"] , $server["dbuser"] , $server["dbpass"] , $server["dbname"] );
		break;
}

/**
* Set default timezone.
**/
if ( isOption ( 'timezone' ) ) {
	date_default_timezone_set( getOption ( 'timezone' ) );
} else {
	date_default_timezone_set( 'Africa/Nairobi' );
}

/**
* Custom error handling for Jabali
**/
function jError($errno, $errstr, $file, $line, $x ) {
	$r = fopen(_ABS_.'/error.log', 'a');
	$y = json_encode( $x );
	fwrite ( $r, "Error [$errno] on ". date('Y-m-d H:i:s').": $errstr in $file on line $line.\n" );
	fclose($r);
}

/**
* Delegate error handling only if debug mode is off/not defined
**/
if ( !defined('APP_DEBUG') ) {
	set_error_handler("jError");
}

/**
* Autoload Classes
**/
$GLOBALS['USERS'] = new Jabali\Data\Access\Objects\Users;
$GLOBALS['POSTS'] = new Jabali\Data\Access\Objects\Posts;
$GLOBALS['RESOURCES'] = new Jabali\Data\Access\Objects\Resources;
$GLOBALS['COMMENTS'] = new Jabali\Data\Access\Objects\Comments;
$GLOBALS['MESSAGES'] = new Jabali\Data\Access\Objects\Messages;
$GLOBALS['OPTIONS'] = new Jabali\Data\Access\Objects\Options;
$GLOBALS['MENUS'] = new Jabali\Data\Access\Objects\Menus;
$GLOBALS['GUZZLE'] = new \GuzzleHttp\Client;
$GLOBALS['MAILER'] = new \PHPMailer\PHPMailer\PHPMailer;
$hGlobal = new Jabali\Lib\Uniform();
$GLOBALS['UNI'] = new Jabali\Lib\Uniform();

$tables = [ 'USERS', 'POSTS', 'RESOURCES', 'COMMENTS', 'MESSAGES', 'OPTIONS', 'MENUS' ];
foreach ($tables as $table ) {
	$GLOBALS['N'.$table] = new Data\Bases\MySQL\SANDAL( strtolower( $table ) );
}