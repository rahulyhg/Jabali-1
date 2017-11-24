<?php
/**
* Declare gobal variables and load theme/extension module functions
* @package Jabali - The Plug-N-Play Framework
* @subpackage Load Globals
* @author Mauko Maunde
* @since 0.17.09
* @link https://docs.jabalicms.org/load/
* @license MIT - https://opensource.org/licenses/MIT
**/

/**
* For security, we flush the $server variable(set in init.php) here so 
* configuration details are not available beyond this point
**/
unset( $server );

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

/**
* Load color skins - sets the $GLOBALS['SKINS'] variable
**/
loadSkins();

/**
* Set the Cros-Site Request Forgery protection variable
**/
if ( !isset( $_SESSION['CSRF'] ) ) {
	$_SESSION['CSRF'] = md5( date("Y-m-d") );
}

define( 'CSRF', $_SESSION['CSRF'] );

if ( $_SERVER['REQUEST_METHOD'] !== "GET" ) {
	if ( !isset( $_REQUEST['csrf_token'] ) || $_REQUEST['csrf_token'] !== $_SESSION['CSRF'] ) {
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
}

/**
* Load Active Extension Modules first so they are accessible by themes.
**/
if ( isOption ( 'modules' ) ) {
	$exts = getOption( 'modules' );
	foreach ( $exts as $ext ) {
		require_once ( _ABSX_.$ext.'/'.$ext.'.php' );
	}
}

/**
* Load Theme Functions, if any
**/
if ( isOption ( 'activetheme' ) ) {
	$GLOBALS['GTheme'] = getOption( 'activetheme' );
	$themefile = _ABSTHEMES_ . $GLOBALS['GTheme'] . '/' . $GLOBALS['GTheme'] . '.php';
} else {
	$themefile = _ABSTHEMES_ . 'eventually/eventually.php';
}

if ( file_exists( $themefile ) ){
	require_once( $themefile );
}