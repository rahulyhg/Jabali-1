<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage App Conroller
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.04
* @link https://docs.jabalicms.org/controller/
* @license MIT - https://opensource.org/licenses/MIT
**/

/**
* Start user session
* Destroy if user logs out*/
session_start();
if ( isset( $_GET['logout'] ) ) {
  session_destroy();
}

/**
* Redirect to setup page if configuration has not beeen done yet
**/
if ( !file_exists( 'app/config.php' ) ) {
  header( "Location: setup.php" );
}

/**
* Load the app initialization module
* Check if app is being updated and display appropriate message
**/
require 'init.php';
require 'load.php';
updatingJabali();

/**
* Create uploads directories by year/month/date
**/
$year = date( "Y" );
$month = date( "m" );
$day = date( "d" );
$directory = "uploads/$year/$month/$day/";

if ( !is_dir( $directory) ) {
  mkdir( $directory, 0775, true );
}

/**
* Handle form actions for login/register/reset/confirmation/email/comments
**/
if ( isset( $_POST['login'] ) && $_POST['user'] !== "" && $_POST['password'] !== "" ) {
  if ( isset( $_GET['r'] ) ) {
  	$USERS -> login( $_GET['r'] );
  } else {
  	$USERS -> login('admin/index?page=my dashboard');
  }
}

if ( isset( $_POST['create'] ) ) {
  $USERS -> register();
}

if ( isset( $_POST['reset'] ) && $_POST['password'] !== "" ) {
  $USERS -> forgot();
}

if ( isset( $_POST['forgot'] ) && $_POST['email'] !== "" ) {
  $USERS ->reset();
}

if ( isset( $_POST['contact'] ) && $_POST['email'] !== "" ) {
	$recipients = $_POST['email'];
	$subject = !empty( $_POST['subject']) ? $_POST['subject'] : "Contact Message From". getOption('name');
	$message = "";
	$cc = "";
	$attachments = "";
	$mail = eMail( $recipients, $subject, $message, $cc, $attachments );
  	if( $mail['status'] == "fail" ) {
	  echo '<div class="etoast">Sorry but we could not send your message at this time. Try again</div>';
	} else {
	  echo '<div class="toast">Message successfully sent. Thank you.</div>';
	}
}

/**
* Set site-wide app color theme for primary, accent, primary text and secondary text colors
*/
if ( isset( $_SESSION[JBLSALT.'Code' ] ) ) {
  $skin = $GLOBALS['USERS'] -> getStyle( $_SESSION[JBLSALT.'Code' ] );
  if ( !isset( $skin['error'] ) ) {
    $key = !empty( $skin['style'] ) ? $skin['style'] : "zahra";
  } else {
    if ( defined('APP_SKIN') ) {
    	$key = APP_SKIN;
    } else {
    	$key = "zahra";
    }
  }
} else {
    if ( defined('APP_SKIN') ) {
    	$key = APP_SKIN;
    } else {
    	$key = "zahra";
    }
}

$GUSkin = $GLOBALS['SKINS'][$key];
$GLOBALS['GPrimary'] = $GUSkin['primary'];
$GLOBALS['GAccent'] = $GUSkin['accent'];
$GLOBALS['GTextP'] = $GUSkin['textp'];
$GLOBALS['GTextS'] = $GUSkin['texts'];

/**
* This is the Jabali controller. It routes all requests directed to it by the .htaccess file.
**/
if ( isLocalhost() && ( $_SERVER['DOCUMENT_ROOT'] !== __DIR__ ) ) {
	$dir = '/'.basename( __DIR__ ).'/';
	$l = strlen( $dir );
	$url = substr($_SERVER['REQUEST_URI'], $l );
} else {
  $url = ltrim( '/', $_SERVER['REQUEST_URI'] );
}

$elements = explode('/', $url );
$match = $elements[0];
array_shift( $elements );

if( !isset( $match ) || empty( $match ) || $match == "?logout" ) {
	getHeader();
	if ( getOption( 'homepage' ) == "posts" ) {
		echo( '<title> Home - '. getOption( 'name' ) .'</title>' );
		blog();
	} else {
		fetchSingle( getOption( 'homepage' ) );
	}
	getFooter();
} elseif ( isset( $GLOBALS['GRules'][$match] ) ) {
	rewriteRules( $match, $elements );
} else switch ( $match ) {
	case "login":
		if ( isset( $_SESSION[JBLSALT.'Code'] ) ) {
			header( 'Location: '. _ROOT .'/admin/index?page=my dashboard' );
			exit();
		}

		login( $elements[0] );
		break;
	case "register":
		register( $elements[0] );
		break;
	case "keygen":
		keyGen( $elements[0] );
		break;
	case "dash":
		header( "Location: admin/index?page=my dashboard");
		break;
	case "dashboard":
		header( "Location: admin/index?page=my dashboard");
		break;
	case "reset":
		theHeader();
		reset( $elements[0], $elements[1] );
		theFooter();
		break;
	case "forgot":
		forgot();
		break;
	case 'portfolio':
		getHeader();
		portfolio( $elements );
		getFooter();
		break;
	case "authors":
		getHeader();
		authors( $elements[0] );
		getFooter();
		break;
	case "categories":
		getHeader();
		category( $elements[0], $elements[1] );
		getFooter();
		break;
	case "comments":
		getHeader();
		comments( $elements );
		getFooter();
	case "archive":
		getHeader();
		archive( $elements );
		getFooter();
		break;
	case "tags":
		getHeader();
		tag( $elements[0] );
		getFooter();
		break;
	case "users":
		getHeader();
		users( $elements[0] );
		getFooter();
		break;
	case "api":
		$key = isset( $_GET['k'] ) ? $_GET['k'] : null;
	    $secret = isset( $_GET['s'] ) ? $_GET['s'] : null;
	    $data = file_get_contents("php://input");
	    $api = new Jabali\Lib\REST( $elements, $key, $secret, $data );

	    header("Access-Control-Allow-Origin: *");
	    header('Content-Type:Application/json' );

	    echo( json_encode( $api -> retval ) );
		break;
	case "feed":
		feed( $elements[0] );
		break;
	case 'manifest':
		manifest();
		break;
	default:
		getHeader();
		fetchSingle( $match );
		getFooter();
}