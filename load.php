<?php
/**
* Declare gobal variables and load theme/extension module functions
* @package Jabali - The Plug-N-Play Framework
* @subpackage Load Globals
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.09
* @link https://docs.jabalicms.org/load/
* @license MIT - https://opensource.org/licenses/MIT
**/

/**
* For security, we flush the $server variable(set in init.php) here so 
* configuration details are not available beyond this point
**/
$server = [];

/**
* Set initial values for Loopy
**/
$GLOBALS['grecords'] = $GLOBALS['POSTS'] -> sweep();
array_shift( $GLOBALS['grecords']);
$GLOBALS['grecord'] = null;
$GLOBALS['grecord_count'] = 0;
$GLOBALS['grecord_index'] = 0;

/**
* Define global variables
**/
$GLOBALS['GRules'] = array();
$GLOBALS['GActions'] = array();
$GLOBALS['GSettings'] = array();
$GLOBALS['GSettingsField'] = array();

$GLOBALS['GTypes'] = array();
$GLOBALS['GTypes']['users'] = isOption ( 'usertypes' ) ? getOption( 'usertypes' ) : "{}";
$GLOBALS['GTypes']['posts'] = isOption ( 'usertypes' ) ? getOption( 'posttypes' ) : "{}";
$GLOBALS['GTypes']['resources'] = isOption ( 'usertypes' ) ? getOption( 'resourcetypes') : "{}";
$GLOBALS['GTypes']['comments'] = isOption ( 'usertypes' ) ? getOption( 'commenttypes') : "{}";
$GLOBALS['GTypes']['messages'] = isOption ( 'usertypes' ) ? getOption( 'messagetypes') : "{}";

$GLOBALS['gattribution'] = getOption('attribution');
$GLOBALS['gattributionlink'] = getOption('attribution_link');
$GLOBALS['gcopyright'] = getOption('copyright');
$GLOBALS['gemail'] = getOption('email');
$GLOBALS['gphone'] = getOption('phone');

/**
* Load color skins - sets the $GLOBALS['SKINS'] variable
**/
loadSkins();

/**
* For rest API Clients
**/
$GLOBALS['CLIENTS'] = array();
setClients();

/**
* Set the Cros-Site Request Forgery protection variable
**/
if ( !isset( $_SESSION['CSRF'] ) ) {
	$_SESSION['CSRF'] = md5( date("Y-m-d") );
}

define( 'CSRF', $_SESSION['CSRF'] );

//
if ( $_SERVER['REQUEST_METHOD'] !== "GET" ) {
	if ( !isset( $_REQUEST['csrf_token'] ) || $_REQUEST['csrf_token'] !== $_SESSION['CSRF'] ) {
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}

	if ( isset( $_REQUEST['k'] ) && $_REQUEST['s'] !== "") {
		if( $GLOBALS['CLIENTS'][$_REQUEST['k']] !== $GLOBALS['CLIENTS'][$_REQUEST['s']] ){
			header( 'HTTP/1.1 403 Forbidden' );
			exit("Invalid app client key/secret");
		}
	}
}

/**
* Load Active Extension Modules first so they are accessible by themes.
**/
if ( isOption ( 'modules' ) ) {
	$exts = getOption( 'modules' );
	foreach ( $exts as $ext ) {
		if ( file_exists( _ABSX_.$ext.'/functions.php' ) ) {
			require_once ( _ABSX_.$ext.'/functions.php' );
		}
		
		require_once ( _ABSX_.$ext.'/'.$ext.'.php' );
	}
}

/**
* Load Theme Functions, if any
**/
$themefiles = array();
if ( isOption ( 'activetheme' ) ) {
	$GLOBALS['GTheme'] = getOption( 'activetheme' );
	$themefiles[] = _ABSTHEMES_ . $GLOBALS['GTheme'] . '/functions.php';
	$themefiles[] = _ABSTHEMES_ . $GLOBALS['GTheme'] . '/'. $GLOBALS['GTheme'] . '.php';
} else {
	$themefiles[] = _ABSTHEMES_ . 'eventually/functions.php';
	$themefiles[] = _ABSTHEMES_ . 'eventually/eventually.php';
}

foreach ($themefiles as $themefuncfile) {
	if ( file_exists( $themefuncfile ) ){
		require_once( $themefuncfile );
	}
}