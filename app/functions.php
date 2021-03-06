<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Common functions
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.09
* @link https://code.jabalicms.org/functions/
* @license MIT - https://opensource.org/licenses/MIT
**/

/**
* Install main instance of Jabali
* @param string $db The type of database management system as per app configuration
* @param string $prefix = Database prefix, defined in the config.php file.
* @param array $tables = Array of the default database tables required by the app.
**/
function installSQLDB( $dbtype = "MySQL")
{
	$dbtables = new Jabali\Lib\DBTables( $dbtype );

	foreach ( $dbtables -> tables as $table ) {
		if( !$GLOBALS['JBLDB'] -> execute( $table ) ){
			return false;
		}
	}

	return true;
} 

/**
* Load stylesheet
* @param string $link Path/link to script, relative if from theme, absolute if otherwise.
* @param string $theme (OPTIONAL) parent theme from where style is being loaded. 
* You can also ignore it if the style is from an external source.
**/
function loadStyle( $link, $theme = false )
{
	if ( $theme !== false ) {
	 	$themes = _THEMES.$theme.'/assets/';
	 } else {
	 	$themes = '';
	 } ?>

	<link rel="stylesheet" type="text/css" href="<?php echo $themes.$link; ?>"><?php 
}

/**
* Load single script
* @param $link Path/link to script, relative if from theme, absolute if otherwise.
* @param $theme (OPTIONAL) parent theme from where script is being loaded.
* You can also ignore it if the script is from an external source.
**/
function loadScript( $link, $theme = false )
{
	if ( $theme !== false ) {
		$themes = _THEMES.$theme.'/assets/';
	} else {
		$themes = '';
	} ?>

	<script type="text/javascript" src="<?php echo $themes.$link; ?>"></script><?php 
}

/**
* Load image
* @param string $link Path/link to image, relative if from theme, absolute if otherwise.
* @param string/bool $theme (OPTIONAL) parent theme from where image is being loaded.
* @param int $width The width of the image
* @param int $height The height of the image
* @param string $alt The alternative text to be shown if image cannot be found
* @param string $class Optional CSS class to style the image
* You can also ignore it if the image is from an external source.
**/
function loadImage( $link, $theme = false, $width = "100%", $height ="", $alt = "Image", $class = "" )
{
	$themes = ( $theme !== false ) ? _THEMES.$theme.'/assets/' : ''; ?>

	<img src="<?php echo $themes.$link; ?>" width="<?php echo( $width ); ?>" alt="<?php echo( $alt )?>" class="<?php echo $class; ?>" /><?php 
}

/**
* Load multiple stylesheets at once
* @param string $link Path/link to script, relative if from theme, absolute if otherwise.
* @param string $theme (OPTIONAL) parent theme from where style is being loaded. 
* You can also ignore it if the style is from an external source.
**/
function loadStyles( $links, $theme = false )
{
	if ( $theme !== false ) {
		$themes = $theme;
	} else {
		$themes = false;
	}

	foreach ( $links as $link ) {
		loadStyle( $link, $themes );
	}
}

/**
* Load multiple scripts at once
* @param $link Path/link to script, relative if from theme, absolute if otherwise.
* @param $theme (OPTIONAL) parent theme from where script is being loaded.
* You can also ignore it if the script is from an external source.
**/
function loadScripts( $links, $theme = false )
{
	if ( $theme !== false ) {
		$themes = $theme;
	} else {
		$themes = false;
	}

	foreach ( $links as $link ) {
		loadScript( $link, $themes );
	}
}

/**
* Display home logo
* @param int $width The width of the image.
* @param string $class Optional css class to style the image link
**/
function frontlogo( $width = "250px;", $class = "" )
{
	echo ( '<a class = "'.$class.'" href="' ._ROOT. '"><img src="' . getOption( 'homelogo' ) . '" width="' . $width . '"></a>' );
}

/**
* Display home logo
* @param int $width The width of the image.
* @param string $class Optional css class to style the image link
**/
function jblLogo( $width = "250px;", $class = "" )
{
	echo ( '<a class = "'.$class.'" href="' ._ROOT. '"><img src="' . _IMAGES . 'logo.png" width="' . $width . '"></a>' );
}

/**
* Display header logo
* @param int $width The width of the image.
* @param string $class Optional css class to style the image link
**/
function headerLogo( $width = "150px;", $class = ""  )
{
	echo ( '<a class = "'.$class.'" href="' ._ROOT. '"><img src="' . getOption( 'headerlogo' ) . '" width="' . $width . '"></a>' );
}

/**
* Wrapper function for outputting alerts
* @param string $what The text/message to alert
* @param string $type The type of alert: informative alert, warning, error or success
**/
function _shout_( $what, $type = "alert" )
{
	switch ( $type ) {
	 	case 'alert':
	 		$color = "blue";
	 		break;
	 	case 'warning':
	 		$color = "orange";
	 		break;
	 	case 'error':
	 		$color = "red";
	 		break;
	 	case 'success':
	 		$color = "green";
	 		break;
	 	default:
	 		$color = "blue";
	 		break;
	 } ?>
	<div class="row alert" id="alert_box">
	  <div class="col s12 m12">
	    <div class="card <?php echo $color; ?> darken-1">
	      <div class="row">
	        <div class="col s12 m10">
	          <div class="card-content white-text">
	            <p><?php echo $what; ?></p>
	        </div>
	      </div>
	      <div class="col s12 m2">
	        <i class="material-icons" id="alert_close" aria-hidden="true" style="position: absolute; right: 10px; top: 10px; font-size: 20px; color: white; cursor:pointer;">clear</i>
	      </div>
	    </div>
	   </div>
	  </div>
	</div><?php
}

/**
* Wrapper function for Javascript Window Alert
* @param string $message The message to alert
**/
function showAlert( $message )
{
	?>
	<script>
		function showText() {
		    alert( "<?php echo $message; ?>" );
		}

		showText();
	</script><?php 
}

/**
* Wrapper function for Javascript Window Confirm
**/
function showConf( $message, $yes = "confirm", $no = "cancel", $where = "" )
{
	?>
	<script>
		function confirmAcion() {
	    var txt;
	    if ( confirm( "<?php echo $message; ?>" ) == true ) {
	        txt = "<?php echo $yes; ?>";
	    } else {
	        txt = "<?php echo $no; ?>";
	    }
	    document.getElementById( "<?php echo $where; ?>" ).innerHTML = txt;
		}

		confirmAcion();
	</script><?php 
}

function home()
{
	echo( _ROOT.'/' );
}

/**
* Check if user has appropriate permisions
* @param $cap The capability/level against which to check
* @return bool
**/
function isCap( $cap )
{
	return ( $_SESSION[JBLSALT.'Cap'] == $cap ) ? true : false;
}

/**
* Check if current user is the record author
* @param int $author The user ID against which to check
* @return bool
**/
function isAuthor( $author )
{
	return ( $_SESSION[JBLSALT.'Code'] == $author ) ? true : false;
}

/**
* Check of user email exists in database
* @param $email The email to check for
* @return bool
**/
function emailExists( $email )
{
	$theEmail = $GLOBALS['JBLDB'] -> select('users', 'email', ['email' => 'mail']);
	return ( $GLOBALS['JBLDB'] -> numRows( $theEmail ) > 0 ) ? true : false;
}

/**
* Check if user is viewing own profile
* @param int $profile The user ID to check
* @return bool
**/
function isProfile( $profile )
{
	return ( $_SESSION[JBLSALT.'Code'] == $profile ) ? true : false;
}

/**
* Uploading files. TODO: Add accepted types.
* @param $file The file to upload
* @return bool
**/
function uploadFile( $file )
{
	$upload = _UPLOADS . date('Y/m/d/') . basename( $file );

	if ( file_exists( $upload) ) {
    	return array( 
    		"status" => "fail",
    		"message" => "Sorry, file already exists."
    	);
	} else {
		return move_uploaded_file( $file, $upload) ? true : false;
	}
}

/**
* Get the number of unread messages for currently logged in users
* @return int
**/
function getMsgCount()
{
	//select('messages', '*', ['status' => 'unread', 'for' => $_SESSION[JBLSALT.'Code']])
    $getMessages = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages WHERE (status = 'unread' AND receipient = '".$_SESSION[JBLSALT.'Code']."' )" );
    if ( $getMessages && $GLOBALS['JBLDB'] -> numRows( $getMessages ) > 0 ) {
      return $GLOBALS['JBLDB'] -> numRows( $getMessages );
    } else {
      return 0;
    }
}

/**
* Get number of unread notifications for logged in user
* @return int
**/
function getNoteCount()
{
	//select('messages', '*', [ 'type' => 'notification', 'status' => 'unread', 'receipient' => $_SESSION[JBLSALT.'Code']])
    $getMessages = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages WHERE (type = 'notification' AND status = 'unread' AND receipient = '".$_SESSION[JBLSALT.'Code']."' )" );
	if ( $getMessages && $GLOBALS['JBLDB'] -> numRows( $getMessages ) > 0 ) {
      return $GLOBALS['JBLDB'] -> numRows( $getMessages );
    } else {
      return 0;
    }
}

/**
* Load color skins and set $GLOBALS['SKINS'] variable
**/
function loadSkins()
{
	$skins = array();
	$skins['zahra'] = array( "name" => "Zahra's Fade", "primary" => "teal", "accent" => "red", "textp" => "white", "texts" => "black" );
	$skins['love'] = array( "name" => "Love, Olive", "primary" => "cyan", "accent" => "magenta", "textp" => "white", "texts" => "black" );
	$skins['wiz'] = array( "name" => "Wiz' o' Oz", "primary" => "yellow", "accent" => "black", "textp" => "white", "texts" => "black" );
	$skins['pint'] = array( "name" => "The Bluepint", "primary" => "blue", "accent" => "pink", "textp" => "white", "texts" => "black" );
	$skins['stack'] = array( "name" => "Needle In A Haystack", "primary" => "grey", "accent" => "brown", "textp" => "white", "texts" => "black" );
	$skins['indie'] = array( "name" => "Indie Go", "primary" => "indigo", "accent" => "brown", "textp" => "white", "texts" => "black" );
	$skins['haze'] = array( "name" => "Purple Haze", "primary" => "purple", "accent" => "green", "textp" => "white", "texts" => "black" );
	$skins['hot'] = array( "name" => "Red Hot", "primary" => "red", "accent" => "blue", "textp" => "white", "texts" => "black" );
	$skins['princess'] = array( "name" => "Princess Zahra", "primary" => "pink", "accent" => "cyan", "textp" => "white", "texts" => "black" );
	$skins['sky'] = array( "name" => "Blue Sky", "primary" => "blue", "accent" => "brown", "textp" => "white", "texts" => "black" );
	$skins['greene'] = array( "name" => "Robert Greene", "primary" => "green", "accent" => "red", "textp" => "white", "texts" => "black" );
	$skins['vegan'] = array( "name" => "I'm Vegan", "primary" => "light-green", "accent" => "green", "textp" => "white", "texts" => "black" );
	$skins['lemon'] = array( "name" => "Life's Lemons", "primary" => "lime", "accent" => "brown", "textp" => "white", "texts" => "black" );
	$skins['wait'] = array( "name" => "The Wait", "primary" => "amber", "accent" => "brown", "textp" => "white", "texts" => "black" );
	$skins['orange'] = array( "name" => "Orange Tan", "primary" => "orange", "accent" => "yellow", "textp" => "white", "texts" => "black" );
	$skins['sun'] = array( "name" => "Orange Sun", "primary" => "orange", "accent" => "cyan", "textp" => "white", "texts" => "black" );
	$skins['earth'] = array( "name" => "Down To Earth", "primary" => "brown", "accent" => "orange", "textp" => "white", "texts" => "black" );
	$skins['ghost'] = array( "name" => "Ghosting Blues", "primary" => "blue-grey", "accent" => "red", "textp" => "white", "texts" => "black" );
	$skins['bred'] = array( "name" => "Born & Bred", "primary" => "black", "accent" => "red", "textp" => "white", "texts" => "black" );
	$skins['prince'] = array( "name" => "Dark Prince", "primary" => "purple", "accent" => "lime", "textp" => "white", "texts" => "black" );
	$skins['peachy'] = array( "name" => "Peachy", "primary" => "peachpuff", "accent" => "maroon", "textp" => "white", "texts" => "black" );
	$skins['queen'] = array( "name" => "Queen Bee", "primary" => "purple", "accent" => "light-green", "textp" => "white", "texts" => "black" );
	$skins['madge'] = array( "name" => "Madge Sony", "primary" => "madge", "accent" => "sony", "textp" => "white", "texts" => "black" );
	$skins['yvy'] = array( "name" => "Madge Sony", "primary" => "ebony", "accent" => "purple", "textp" => "white", "texts" => "black" );
	$skins['fuchsia'] = array( "name" => "Fuchsia", "primary" => "pink", "accent" => "purple", "textp" => "white", "texts" => "black" );
	$skins['creamy'] = array( "name" => "Cream Pie", "primary" => "cream", "accent" => "yellow", "textp" => "white", "texts" => "black" );
	$skins['grace'] = array( "name" => "Grace", "primary" => "silver", "accent" => "gold", "textp" => "black", "texts" => "black" );
	$skins['nude'] = array( "name" => "Nude Strip", "primary" => "nude", "accent" => "red", "textp" => "white", "texts" => "black" );
	$skins['christian'] = array( "name" => "Christian Gold", "primary" => "silver", "accent" => "gold", "textp" => "black", "texts" => "black" );
	$skins['snow'] = array( "name" => "Snow White", "primary" => "white", "accent" => "snow", "textp" => "black", "texts" => "black" );
	$skins['mshindi'] = array( "name" => "Mshindi", "primary" => "yellow", "accent" => "orange", "textp" => "black", "texts" => "black" );
	$skins['olive'] = array( "name" => "Olive Branches", "primary" => "olive", "accent" => "blue", "textp" => "black", "texts" => "black" );
	$skins['hues'] = array( "name" => "Khaki Pants", "primary" => "khaki", "accent" => "blue", "textp" => "black", "texts" => "black" );
	$skins['high'] = array( "name" => "High & Mighty", "primary" => "cream", "accent" => "turquoise", "textp" => "black", "texts" => "black" );
	$skins['muddle'] = array( "name" => "Muddle", "primary" => "mudd", "accent" => "red", "textp" => "black", "texts" => "black" );
	$skins['nana'] = array( "name" => "Nana", "primary" => "pink", "accent" => "magenta", "textp" => "black", "texts" => "black" );
	$skins['sly'] = array( "name" => "Sly", "primary" => "yellow", "accent" => "brown", "textp" => "black", "texts" => "black" );
	$skins['blues'] = array( "name" => "Blue Indians", "primary" => "cyan", "accent" => "indigo", "textp" => "black", "texts" => "black" );

	$GLOBALS['SKINS'] = $skins;
}

/**
* Adds skin to global array $GLOBALS['SKINS']
* @param $skin slug of skin to add
* @param $colors Array of skin details - name, primary, accent, textp, texts
**/
function addSkin( $skin, $colors )
{
	$GLOBALS['SKINS'][$skin] = array( "primary" => $colors[0], "accent" => $colors[1], "textp" => $colors[2], "texts" => $colors[3]);
}

/**
* Echoes out the global primary color
**/
function primaryColor()
{
	echo $GLOBALS['GPrimary'];
}

/**
* Echoes out the global accent color
**/
function secondaryColor()
{
	echo $GLOBALS['GAccent'];
}

/**
* Echoes out the global primary text color
**/
function textColor()
{
	echo $GLOBALS['GTextP'];
}

/**
* Echoes out the global secondary text color
**/
function textSColor()
{
	echo $GLOBALS['GTextS'];
}

/**
* Fetches a specified app setting/option
* @param $code The code/slug of the option to fetch
* @return The value of specified app option, null if option does not exist
**/
function getOption( $code, $default = "N/A" )
{
	$option = "";
    $getOptions = $GLOBALS['JBLDB'] -> select('options', ['code','details'], ['code' => $code]);
    if ( $getOptions && $GLOBALS['JBLDB'] -> numRows($getOptions) > 0 ) {
        while ( $siteOption = $GLOBALS['JBLDB'] -> fetchAssoc($getOptions) ) { 
			if ( substr( $siteOption['details'], 0,1 ) == "[" || substr( $siteOption['details'], 0,1 ) == "{" ) {
				$option = json_decode( $siteOption['details'], true );
			} else {
				$option = ( $siteOption['details'] !== "" ) ? $siteOption['details'] : $default;
			}
        }
    } else {
    	$option = null;
    }
    
    return $option;
}

/**
* Echoes a specified app setting/option
* @param $code The code/slug of the option to fetch
**/
function showOption( $code )
{
    echo( getOption( $code ) );
}

/**
* Check if option exists in databases
* @param $code The code/slug of the option to fetch
* @return bool
**/
function isOption( $code )
{
    return !is_null( getOption( $code ) ) ? true : false;

    //return $GLOBALS['OPTIONS'] -> optionExists( $code );
}

/**
* Include jabali header
**/
function theHeader()
{
	require_once( _ABSVIEWS_ . 'header.php' );
	echo( '
		<style>
			.toast{
				bottom: 5px;
				right: 5px;
				position: absolute;
				color: green;
			}
			.etoast{
				bottom: 5px;
				right: 5px;
				position: absolute;
				color: red;
			}
		</style>' );
}

/**
* Include Jabali footer
**/
function theFooter()
{
	require_once( _ABSVIEWS_ .'footer.php' );
}

/**
* Echoes out the app attribution text, linked to the App's attribution link
* @param $class Optional class to style the link
**/
function theAttribution( $class = "" )
{
    echo( '<a href="'.$GLOBALS['gattributionlink'].'" class="'.$class.'">'.$GLOBALS['gattribution'].'</a>' );
}

/**
* Echoes out the app copyright text
* @param $class Optional class to style the link
**/
function theCopyright()
{
    echo( $GLOBALS['gcopyright'] );
}

/**
* Echoes out the app copyright text
* @param $class Optional class to style the link
**/
function appEmail( $text = null )
{
	$text = is_null( $text ) ? $GLOBALS['gemail'] : $text;
    echo( '<a href="mailto:'.$GLOBALS['gemail'].'">'.$text.'</a>' );
}

/**
* Echoes out the app copyright text
* @param $class Optional class to style the link
**/
function appPhone( $text = null )
{
	$text = is_null( $text ) ? $GLOBALS['gphone'] : $text;
    echo( '<a href="mailto:'.$GLOBALS['gphone'].'">'.$text.'</a>' );
}

/**
* Include active theme's header
**/
function getHeader()
{
	require_once( _ABSTHEMES_ . getOption( 'activetheme' ) . '/header.php' );
	echo( '
		<style>
			.toast{
				bottom: 5px;
				right: 5px;
				position: absolute;
				color: green;
			}
			.etoast{
				bottom: 5px;
				right: 5px;
				position: absolute;
				color: red;
			}
		</style>' );
}

/**
* Include active theme's footer
**/
function getFooter()
{
	$theme = getOption( 'activetheme' );
	require_once( _ABSTHEMES_ .$theme. '/footer.php' );
}

/**
* Render theme sidebar
**/
function sideBar( $file = "sidebar" )
{
	$theme = getOption( 'activetheme' );
	require_once( _ABSTHEMES_ .$theme. '/'.$file.'.php' );
}

/**
* Outputs the html document title depending on current page
* @param $class The surrent page/file to use as base
**/
function showTitle( $class = "dashboard" )
{ ?>
    <title><?php

    $class = ucwords( $class );
	//Viewing
	if ( isset( $_GET['view'] ) ) {
		if ( $_GET['view'] == "list" ) {
			if ( isset( $_GET['type'] ) ) {
				echo ucwords($_GET['type'])."s List";
			} else {
			if ( isset( $_GET['key'])) {
				$key = $_GET['key'];
			} elseif ( isset( $_GET['status'])) {
				$key = $_GET['status'];
			}
		  		echo ucwords( $class .': '.$key." List" );
			}
		} elseif ( $_GET['view'] == "pending" ) {
			echo "Pending ".$class;
		} else {
			if ( isset( $_GET['key'] ) ) {
				echo $_GET['key'];
			} else {
				echo $class;
			}
		} 
	} elseif ( isset( $_GET['profile'] ) ) {
		if ( isset( $_GET['key'] ) ) {
			echo $_GET['key'];
		} else {
			echo "Viewing ".$class;
		}
	} elseif ( isset( $_GET['status'] ) ) {
		echo ucwords($_GET['status']).' '.$class;
	} elseif ( isset( $_GET['type'] ) ) {
		echo ucwords($_GET['type'])."s List";
	//Creating 
	} elseif ( isset( $_GET['create'] ) ) {
		if ( isset( $_GET['key'] ) ) {
			echo "Create ".$_GET['key'];
		} else {
			echo "Create ".$_GET['create'];
		}

	//Deleting
	} elseif ( isset( $_GET['delete'] ) ) {
		if ( isset( $_GET['key'] ) ) {
			echo "Delete ".$_GET['key'];
		} else {
			echo "Delete ".$class;
		}

	// Editing
	} elseif ( isset( $_GET['edit'] ) ) {
		if ( isset( $_GET['key'] ) ) {
			echo "Edit ".$_GET['key'];
		} else {
			echo "Edit ".$class;
		}
	} elseif ( isset( $_GET['copy'] ) ) {
		if ( isset( $_GET['key'] ) ) {
			echo "Copy ".$_GET['key'];
		} else {
			echo "Copy ".$class;
		}
	} ?> 
	- <?php
	showOption( 'name' ); ?>
    </title><?php
}

/**
* Outputs specific html document title
* @param $text The text to output as title
**/
function headTitle( $text )
{
    echo( '<title>'.ucwords( $text ).' - '.getOption( 'name' ).'</title>' );
}

/**
* Outputs specific html document title
* @param $text The text to output as title
**/
function htmlTitle( $text )
{
    echo( '<title>'.ucwords( $text ).' - '.getOption( 'name' ).'</title>' );
}

/**
* Renders a responsive table header
* @param array $collums The collums to use for the table head
**/
function tableHeader( $collums )
{ ?>
	<div class="mdl-cell mdl-cell--12-col">
		<div class="pmd-card pmd-z-depth pmd-card-custom-view">
			<div class="pmd-table-card">
				<table class="table pmd-table mdl-shadow--2dp <?php primaryColor(); ?> sortable">
					<thead>
						<tr>
						<?php foreach ( $collums as $collum ): ?>
							<th class="mdl-data-table__cell--non-numeric"><?php echo( strtoupper( $collum ) ); ?></th>
						<?php endforeach; ?>
						</tr>
					</thead>
					<tbody><?php
}

/**
* Outputs the body of table with defined data variables
* @param array $results Array of records from a database query
* @param array $fields Array of table collunms to display
* @param array $names Array of names to use as labels for table header
* @param $error Error message to sho when no records are found
* @param array $actions Array of actions with links and icons for each record
**/
function tableBody( $results, $fields, $names, $error = "No Records Found", $actions = null )
{
	if ( $results['status'] !== 'fail' ) {
		array_shift( $results );
		foreach ($results as $item ) {
			echo( '<tr>' );
			$data = array_combine( $fields, $names );
			foreach ( $data as $field => $name ) {
				echo '<td class="mdl-data-table__cell--non-numeric" data-title="' . strtoupper( $name ) . '">'. $item[$field] .'</td>';
			}
			if ( !is_null( $actions )) {
				 if ( isCap( 'admin' ) ) {
					echo( '<td class="mdl-data-table__cell--non-numeric" data-title="Actions">');
					foreach( $actions as $action => $link ) {
						switch ( $action ) {
							case 'edit':
								$icon = 'edit';
								break;

							case 'view':
								$icon = 'open_in_new';
								break;

							case 'email':
								$icon = 'email';
								break;

							case 'call':
								$icon = 'phone';
								break;

							case 'copy':
								$icon = 'content_copy';
								break;

							case 'profile':
								$icon = 'perm_identity';
								break;

							case 'reply':
								$icon = 'reply';
								break;
							
							default:
								$icon = 'perm_identity';
								break;
						}
						echo( '<a class="mdl-button mdl-button--icon" href="?'.$action.'='.$item[$link[0]].'&key='.$item['title'].'"><i class="material-icons">'.$icon.'</i></a>');
					}
					echo( '<form action="" method="POST" style="display: inline;" >');
					csrf();
					echo ( '<button class="mdl-button mdl-button--icon" type="submit" name="delete" value='.$item['id'].'"><i class="material-icons">delete</i></button>
						</form>');
					echo( '</td>');
				}
			}
			echo( '</tr>' );
		}
	} else {
		echo '<td class="mdl-data-table__cell--non-numeric" data-title="Error">'. $error .'</td>';
	}
}

/**
* Outputs the body of table with defined data variables
**/
function tableBody2( $callable, $fields, $names, $error = "No Records Found", $actions = null )
{
	resetLoop( $callable );

	echo( '<tr>' );
	if ( hasRecords() ) {
		while ( hasRecords() ) {
			theRecord();
			echo( '<td class="mdl-data-table__cell--non-numeric" data-title="' . strtoupper( $name ) . '">'. $item[$field] .'</td>' );
			if ( !is_null( $actions ) ) {
				echo( '<td class="mdl-data-table__cell--non-numeric" data-title="Actions">' );
				foreach( $actions as $action => $link ) {
					switch ( $action ) {
						case 'edit':
							$icon = 'edit';
							break;

						case 'view':
							$icon = 'open_in_new';
							break;

						case 'email':
							$icon = 'email';
							break;

						case 'call':
							$icon = 'phone';
							break;

						case 'profile':
							$icon = 'perm_identity';
							break;

						case 'reply':
							$icon = 'reply';
							break;
						
						default:
							$icon = 'perm_identity';
							break;
					}
					echo( '<a class="mdl-button mdl-button--icon" href="?'.$action.'='.$item[$link[0]].'&key='.$item['name'].'"><i class="material-icons">'.$icon.'</i></a>');
				}
				echo( '<form action="" method="POST" style="display: inline;" >');
				csrf();
				echo ( '<button class="mdl-button mdl-button--icon" type="submit" name="delete" value='.$item['id'].'"><i class="material-icons">delete</i></button>
					</form>');
				echo( '</td>');
			}
		}
	} else {
		echo '<td class="mdl-data-table__cell--non-numeric" data-title="Error">'. $error .'</td>';
	}
	echo( '</tr>' );
}

/**
* Close our table
**/
function tableFooter()
{ ?>
					</tbody>
				</table>
			</div>
		</div> 
	</div><?php
}

//$field = array ( "length" => "" "class" => "", "type" => "", "name" => "", "id" => "", "placeholder" => "", "value" => "");
//$fields = $field1, $field2;
//form( $name, , , ,, array( $fields ) );
//
function form( $name, $enctype = 'multipart/form-data', $method = 'POST', $action = '', $class = null, $fields = array() )
{ ?>
	<form enctype="<?php echo( $enctype ); ?>" name="<?php echo( $name ); ?>" method="<?php echo( $method ); ?>" action="<?php echo( $action ); ?>" class="<?php echo( $class ); ?>">
	<?php foreach ($fields as $field ) { ?>
		<div class="input field <?php echo( $field['length'] ); ?>">
		<i class="<?php echo( $field['icon-class'] ); ?>"><?php echo( $field['icon'] ); ?></i>
			<<?php echo( $field['genre'] ); ?> class="<?php echo( $field['class'] ); ?>" type="<?php echo( $field['type'] ); ?>" name="<?php echo( $field['name'] ); ?>" placeholder="<?php echo( $field['placeholder'] ); ?>" value=""><?php echo( $field['value'] ); ?></<?php echo( $field['genre'] ); ?>>
		</div>
	<?php } ?>
	</form><?php

	$form = <<<FORM
FORM;

}

/**
* Checks if supplied data is a qualified email address
* @param string $data The data to check
* @return bool True if data is email
**/
function isEmail( $data )
{
  return filter_var( $data, FILTER_VALIDATE_EMAIL) ? true : false;
}

/**
* Check if supplied number is even
* @param $number Number to check
* @return bool
**/
function isEven( $number )
{
	return ($number % 2 == 0) ? true : false;
}

/**
* Add Floating Action Button(fab) to create new record
* @param string $table Database table to base on - users| posts | messages | comments | resources
* @param string $type Type of record to create
* @param string $icon Material icon to display in fab
**/
function newButton( $table, $type, $icon = "create" )
{
echo ( '<a href="./'.$table.'?create='.$type.'" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"><i class="material-icons">'.$icon.'</i></a>' );
}

/**
* Generate Random Code
**/
function generateCode() {
	$code = md5( date('l jS \of F Y h:i:s A').rand(10,1000) );
	return $code;
}

/**
* Error hanling, Jabali style - include the active theme's error template file or render generic text if file does not exist
**/
function error404( $id = "error-404", $code = "Error 404: Not Found", $message = 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Go home by <a href="'._ROOT.'">clicking here.</a>', $class = "error-container" ) 
{ ?>
	<title>Error 404 - <?php showOption( 'name' ); ?></title>
	<?php if ( file_exists( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' ) ):
		require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
	else:
		$scode = <<<HTML
		<div style="margin: 10% 25% 5% 25%;">
			<div class="{$class}">
				<h1>{$code}</h1>
				<h2>{$message}</h2>
				<br>
				<br>
			</div>
		</div>
HTML;
		echo( $scode );
	endif;
}

/**
* Die
**/
function snuffle($text = "Umphh!") 
{
	die( $text );
}

/**
* Check if extension module is active
* @param $ext The extension module to check
* @return bool
**/
function isActiveX( $ext )
{
	$exts = isOption( 'modules' ) ? getOption( 'modules' ) : array();
	return in_array( $ext, $exts ) ? true : false;
}

/**
* Check if theme is active
* @param $theme The themwe to check
* @return bool
**/
function activeTheme( $theme )
{
	return ( getOption( 'activetheme' ) == $theme ) ? true : false;
}

/**
* @return timezones an array
**/ 
function timeZones()
{
  $zones_array = array();
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) {
    date_default_timezone_set($zone);
    $zones_array[$key]['zone'] = $zone;
    $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
  }
  return $zones_array;
}

/**
* Add shortcode
* @param $tag The shortcode to add
* @param $callback The function to call - should not echo anything, return modified data
* @return Registration of shotcode
**/
function addShortCode( $tag, $callback )
{
    return Lib\Shortcodes::instance() -> register( $tag, $callback );
}

/**
* Resolve all shortcodes added
* @param string $str The string/content to parse
* @return Resolved string
**/
function doShortCodes( $str ) 
{
    return Lib\Shortcodes::instance() -> doShortcode( $str );
}

/**
* 
**/
function addMeta( $name, $content )
{
	echo '<meta name="' . $name . '" content="' . $content . '" >';
}


/**
* Adds cross-site request forgery (CSRF) protection
**/
function csrf()
{
	echo '<input type="hidden" name="csrf_token" value="' . CSRF . '" />';
}

/**
* 
**/
function serviceWorker( $path = "sw.js")
{ ?>
	<script>
		if (navigator.serviceWorker.controller) {
		  console.log('[PWA Builder] active service worker found, no need to register')
		} else {
		  //Register the ServiceWorker
		  navigator.serviceWorker.register('<?php echo( $path ); ?>', {
		    scope: './'
		  }).then(function(reg) {
		    console.log('Service worker has been registered for scope:'+ reg.scope);
		  });
		}
	</script><?php
}

/**
* 
**/
function addAction( $hook, $callable, $args )
{
	if ( !isset( $GLOBALS['GActions'][$hook] ) ) {
		$GLOBALS['GActions'][$hook] = array();
	}

	$GLOBALS['GActions'][$hook][] = array( $callable, $args );
}

/**
* 
**/
function doActions( $hook )
{

	if ( isset( $GLOBALS['GActions'][$hook] ) ) {
		foreach ($GLOBALS['GActions'][$hook] as $callable ) {
			$callback = $callable[0];
			$args = $callable[1];

			$args = is_array( $args ) ? $args : array( $args );

			call_user_func_array($callback, $args );
		}
	}
}

/**
* 
**/
function doHeader()
{
	doActions( 'header' );
}

/**
* 
**/
function doFooter()
{
	doActions( 'footer' );
}

/**
* 
**/
function addRule( $rule, $callback )
{
	if ( !isset( $GLOBALS['GRules'][$rule] ) ) {
		$GLOBALS['GRules'][$rule] = $callback;
	}
}

/**
* 
**/
function rewriteRules( $rule, $args )
{
	$callback = $GLOBALS['GRules'][$rule];

	$args = is_array( $args ) ? $args : array( $args );

	if ( isset( $callback ) && is_callable( $callback ) ) {
		call_user_func_array( $callback, $args );
	}
}

/**
* 
**/
function addSetting( $page, $group, $label = "Group Label", $title = "Options", $callable = "echo", $args = "" )
{
	if ( !isset( $GLOBALS['GSettings'][$page] ) ) {
		$GLOBALS['GSettings'][$page] = array();
	}

	$GLOBALS['GSettings'][$page][$group] = array(
		'callable' => $callable,
		'args' => $args,
		'label' => $label,
		'title' => $title 
	);
}

/**
* 
**/
function addSettingField( $page, $group, $id, $name = null, $label = null, $type = "text", $icon = "label", $attrs = null )
{
	if ( !isset( $GLOBALS['GSettingsField'][$page][$group] ) ) {
		$GLOBALS['GSettingsField'][$page][$group] = array();
	}

	$label = !is_null( $label ) ? $label : $id;
	$name = !is_null( $name ) ? $name : $id;

	$GLOBALS['GSettingsField'][$page][$group][] = array( 
		'id' => $id,
		'name' => $name, 
		'type' => $type, 
		'label' => $label, 
		'icon' => $icon, 
		'attrs' => $attrs 
	);
}

/**
* 
**/
function renderSettingsForm( $page )
{
	echo '<form class="mdl-cell mdl-cell--8-col '.$GLOBALS['GPrimary'].' mdl-card" name="'.$page.'" method="POST" action"" >
		<div class="mdl-card__supporting-text">';
	foreach ($GLOBALS['GSettings'][$page] as $group => $fields ) {
		echo '<title>'.$fields['title'].' - '.getOption('name').'</title>';
		echo ( '<h5>'.$fields['label'].'</h5>' );
		foreach ( $GLOBALS['GSettingsField'][$page][$group] as $field ) {
			doSettingField( $field, $group );
		}
	}
	echo '<input type="hidden" name="settings" value="'. $page .'">';
	csrf();
	echo '
		<button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit"><i class="material-icons">save</i></button>
		</div></form>';
	echo '<form class="mdl-cell mdl-cell--4-col '.$GLOBALS['GPrimary'].' mdl-card" method="POST" action"" ><div class="mdl-card__title">
	<div class="mdl-card__title-text">
		Ads go here</div>
	</div>
	</div>
	<div class="mdl-card__supporting-text"></div>
	</form>';
}

/**
* 
**/
function doSettingField( $field, $group )
{
	$id = $field['id'];
	$name = $field['name'];
	$type = $field['type'];
	$label = $field['label'];
	$icon = $field['icon'];
	$attrs = $field['attrs'];

	$option = getOption($group);
	$value = is_array( $option ) ? $option[$name] : $option;

	if ( !is_null( $attrs ) ) {
		foreach ($attrs as $attr => $val) {
			implode(" ", $attr . '="'. $val .'"' );
		}
	}

	switch ( $type ) {
		case 'text':
			echo '<div class="input-field">
			<i class="material-icons prefix">'. $icon .'</i>
			<input type="text" id="'. $id .'" name="'. $group .'['.$name.']" value="'. $value .'">
			<label for="'. $id .'" class="center-align">'. ucwords( $label ) .'</label>
			</div>';
			break;
		case 'checkbox':
			echo '<div class="">
			<input type="checkbox" id="'. $id .'" name="'. $name .'[]" value="'. $value .'"'. getOption( $name ).'>
			<label for="'. $id .'" class="center-align">'. ucwords( $label ) .'</label>
			</div>';
			break;
		case 'radio':
			echo '<div class="">
			<input type="radio" id="'. $id .'" name="'. $name .'[]" value="'. $value .'">
			<label for="'. $id .'" class="center-align">'. ucwords( $label ) .'</label>
			</div>';
			break;
		case 'textarea':
			echo '<div class="input-field">
			<i class="material-icons prefix">'. $icon .'</i>
			<textarea class="materialize-textarea" id="'. $id .'" name="'. $name .'[]">'. $value .'</textarea>
			<label for="'. $id .'" class="center-align">'. ucwords( $label ) .'</label>
			</div>';
			break;
			case 'switch':
			echo '<div class="switch">
		    <label>
		      Off
		      <input type="checkbox"  name="'. $name .'[]"  value="'. $value .'">
		      <span class="lever"></span>'. $label .'
		      </label>
		  </div>';
		  	break;
			case 'file':
			echo '<div class="file-field input-field">
		      <div class="btn mdl-button--colored">
		        <span class="material-icons">file_upload</span>
		        <input type="file">
		      </div>
		      <div class="file-path-wrapper">
		        <input name="'. $name .'[]" class="file-path validate" type="text" value="'. ucwords( $label ) .'">
		      </div>
		    </div>';
		  	break;
		
		default:
			echo '<div class="input-field">
			<i class="material-icons prefix">label</i>
			<input type="text" id="'. $id .'" name="'. $name .'[]" value="'. getOption( $name ) .'">
			<label for="'. $name .'" class="center-align">'. ucwords( $name ) .'</label>
			</div>';
			break;
	}
}

/**
* Checks if directory is empty
* @param string $dir - path to directory to check
* @return bool
**/
function isEmptyDir( $dir )
{
	if ( !is_dir( $dir ) ) return false;

	foreach ( scandir( $dir ) as $file ) {
		return !in_array( $file, [ '.', '..', '.svn', '.git' ] ) ? false : true;
	}

	return true;
}

/**
* Recursively copy directories
* @param string $src - Source directory
* @param string $dest - Destination directory
**/
function reCopy( $src, $dest )
{
    $umaskz = umask(0);
	if ( is_dir( $dest ) ) {
		_shout_( "A directory by the name <code>".basename($dest)."</code> already exists.", "error");
		exit();
	} else {
		mkdir( $dest );
	}

	if ( is_dir( $src ) ) {
		$dir = opendir( $src );

		while ( false !== ( $file = readdir( $dir ) ) ) {
			if ( $file !== "." && $file !== ".." ) {
				if ( is_dir( $src.'/'.$file ) ) {
					reCopy( $src.'/'.$file, $dest.'/'.$file );
				} else {
					copy( $src.'/'.$file, $dest.'/'.$file );
				}
			}
		}

		closedir( $dir );

    	umask( $umaskz );
		return true;
	} else {
	    umask( $umaskz );
		return false;
	}

}

/**
* Recursively copy directories
**/
function copyr( $source, $dest )
{
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }
    
    if (is_file($source)) {
        return copy($source, $dest);
    }

    if (!is_dir($dest)) {
        mkdir($dest);
    }

    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        if ($entry == '.' || $entry == '..') {
            continue;
        }
        
        copyr("$source/$entry", "$dest/$entry");
    }

    $dir->close();
    return true;
}

/**
* Recursively delete directories
**/
function rrmdir( $src )
{
	$dir = opendir( $dir );
	while ( false !== ( $file = readdir( $dir ) ) ) {
		if ( ( $file != "." ) && ( $file !=".." ) ) {
			$full = $scr . '/' . $file;
			if ( is_dir( $full ) ) {
				rrmdir( $full );
			} else {
				unlink( $full );
			}
		}
	}
}

/**
* 
**/
function renderView( $view, $data = "" )
{
	$data = $data;
	require_once( _ABSVIEWS_.$view.'.php' );
}

/**
* Checks if suer/developer is in local/development environent
* @return bool
**/
function isLocalhost()
{
    return in_array( $_SERVER['REMOTE_ADDR'], [ '127.0.0.1', '::1' ] ) ? true : false;
}

/**
* Checks if current color skin is active for current user
* @param string $theme The color theme to check
**/
function isTheme ( $theme)
{
	if ( isset( $_SESSION[JBLSALT.'Code' ] ) ) {
		$skin = $GLOBALS['USERS'] -> getStyle( $_SESSION[JBLSALT.'Code' ] );
		if ( !isset( $skin['error'] ) ) {
			$key = !empty( $skin['style'] ) ? $skin['style'] : "zahra";
		} else {
			$key = "zahra";
		} 
	} else {
		$key = "zahra";
	}

	if ( $theme == $key ) {
		echo 'checked';
	}
}

/**
* Install downloaded/uploaded theme/module
* @param string $source The theme/moule zip file to install
* @param string $dir The directory o which to extract - either _ABSTHEMES_(for themes) or _ABSX_(ffor modules)
**/
function intallTheme( $source, $dir = _ABSTHEMES_ )
{
	$install = new ZipArchive();
	$xT = $install -> open( $source );
	if ( $xT === TRUE ) {
	  $install -> extractTo( $dir );
	  echo( 'Extracting files' );
	  $install -> close();
	} else {
	  _shout_( "Installation Failed!", "error" );
	}
}

/**
* Add content to files during theme/module creation or file addition
* @param string $type - File type
* @param string $class - Class of file
* @param string $package - Package name
**/

function fileContents( $type, $package = null, $class = null )
{
	if ( is_null( $package ) ) {
		$package = array();
		$package['name'] = "Jabali";
		$package['author'] = "Mauko Maunde";
		$package['website'] = "https://jabalicms.org";
		$package['version'] = "18.01";
	}
	switch ( $type ) {
		case 'php':
			$comments = "<?php ";
			$comments .= "\n\n";
			$comments .= "/**\n";
			$comments .= "* @package Jabali - The Plug-N-Play Framework \n";
			$comments .= "* @subpackage ". $package['name'] ."\n";
			$comments .= "* @author ". $package['author'] ."\n";
			$comments .= "* @link ". $package['website'] ."\n";
			$comments .= "* @since ". $package['version'] ."\n";
			$comments .= "**/\n";
			break;
		
		case 'css':
			$comments = "/*\n";
			$comments .= "*Package Jabali \n";
			$comments .= "*Subpackage ". $package['name'] ."\n";
			$comments .= "*Author ". $package['author'] ."\n";
			$comments .= "*Link ". $package['website'] ."\n";
			$comments .= "*Since ". $package['version'] ."\n";
			$comments .= "*/\n";
			break;
		
		case 'js':
			$comments = "/*\n";
			$comments .= "*Package Jabali \n";
			$comments .= "*Subpackage ". $package['name'] ."\n";
			$comments .= "*Author ". $package['author'] ."\n";
			$comments .= "*Link ". $package['website'] ."\n";
			$comments .= "*Since ". $package['version'] ."\n";
			$comments .= "*/\n";
			break;
		
		default:
			$comments = "<?php ";
			$comments .= "\n\n";
			$comments .= "/**\n";
			$comments .= "* @package Jabali - The Plug-N-Play Framework \n";
			$comments .= "* @subpackage ". $package['name'] ."\n";
			$comments .= "* @author ". $package['author'] ."\n";
			$comments .= "* @link ". $package['website'] ."\n";
			$comments .= "* @since ". $package['version'] ."\n";
			$comments .= "**/\n";
			break;
	}

	return $comments;
}

//LOOPY
/**
* Checks if app has records (users/posts/messages/comments/resources)
* @return bool
**/
function hasRecords()
{
	if ( $GLOBALS['grecord_index'] <= $GLOBALS['grecord_count'] ) {
		$GLOBALS['grecord_count'] = count( $GLOBALS['grecords'] )-1;
		return true;
	} else {
		$GLOBALS['grecord_count'] = 0;
		return false;
	}
}

/**
* @return false if there are no more records, or the record in the current index
* Icreases the index by one
**/
function theRecord()
{
	if ( $GLOBALS['grecord_index'] > $GLOBALS['grecord_count'] ) {
		return false;
	}

	$GLOBALS['grecord'] = $GLOBALS['grecords'][ $GLOBALS['grecord_index'] ];
	$GLOBALS['grecord_index']++;
	
	return $GLOBALS['grecord'];
}

/**
* Resets the global records array and the index, allowing us to have more than one Loopy instance in the same php script and query different data types.
**/
function resetLoop( $callback = "sweep", $args = [], $table = "posts" )
{	
	$args = is_array( $args ) ? $args : array( $args );
	$table = strtoupper( $table );
	$GLOBALS['grecords'] = call_user_func_array( array( $GLOBALS[$table], $callback ), $args );
	array_shift( $GLOBALS['grecords']);
	$GLOBALS['grecord'] = null;
	$GLOBALS['grecord_count'] = 0;
	$GLOBALS['grecord_index'] = 0;
}

/**
* Outputs the record name/title
**/
function theTitle()
{
	echo $GLOBALS['grecord']['title'];
}

/**
* Returns the unformatted record name/title
**/
function recordTitle()
{
	return $GLOBALS['grecord']['title'];
}

/**
* 
**/
function theSubTitle()
{
	echo $GLOBALS['grecord']['subtitle'];
}

/**
* Returns the unformatted record name/title
**/
function recordSubTitle()
{
	return $GLOBALS['grecord']['subtitle'];
}

/**
* Outputs a formatted link to the record's permalink, with specified text
* @param $text The text to output
@param $class Optional CSS class to stlyle the link
**/
function theLink( $text = "read more", $class = "" )
{
	echo ( '<a href="'.$GLOBALS['grecord']['link'].'" class = "'.$class.'" >'. $text . '</a>');
}

/**
* Returns unformatted record permalink
**/
function recordLink( )
{
	return $GLOBALS['grecord']['link'];
}

/**
* Outputs the content/details/description of the current record, 
* with all shortcodes added by addShortCode() function resolved.
**/
function theContent()
{
	echo htmlspecialchars_decode( doShortCodes( $GLOBALS['grecord']['details'] ) );
}

/**
* Outputs parts of the content/details/description of the current record, 
* with all shortcodes added by addShortCode() function resolved.
**/
function theExcerpt( $length = 250 )
{
	echo htmlspecialchars_decode( substr( doShortCodes( $GLOBALS['grecord']['excerpt'] ), 0, $length ) );
}

/**
* Outputs the record's unique ID
**/
function theId()
{
	echo $GLOBALS['grecord']['id'];
}

/**
* Returns the record's unique ID
**/
function recordId()
{
	return $GLOBALS['grecord']['id'];
}

/**
* Outputs the record's type
**/
function theType()
{
	echo ucwords( $GLOBALS['grecord']['type'] );
}

/**
* Returns the record's type
**/
function recordType()
{
	return $GLOBALS['grecord']['type'];
}

/**
* Outputs the email address associated with current record
**/
function theEmail( $text = null )
{
	$text = !is_null( $text ) ? $text : $GLOBALS['grecord']['email'];
	echo ( '<a href="mailto:'.$GLOBALS['grecord']['email'].'" >'.$text.'</a>' );
}

/**
* Returns the email address associated with current record
**/
function recordEmail()
{
	return $GLOBALS['grecord']['email'];
}

/**
* Outputs the email address associated with current record
**/
function theGender()
{
	echo ucwords( $GLOBALS['grecord']['gender'] );
}

/**
* Returns the email address associated with current record
**/
function recordGender()
{
	return $GLOBALS['grecord']['gender'];
}

/**
* Outputs the social network associated with the current record 
**/
function theSocial( $network = "facebook" )
{
	$social = json_decode($GLOBALS['grecord']['social'], true );
	echo $social[$network];
}

/**
* Returns the author associated with current record
**/
function theAuthor( $class = "" )
{
	echo ( '<a class="'.$class.'" href="'._ROOT.'/users/'.$GLOBALS['grecord']['author'].'">'.$GLOBALS['grecord']['author_name'].'</a>' );
}

/**
* Returns part of the name of the author of the current record
**/
function theAuthorIn( $count = null )
{
	if ( is_null( $count ) ) {
		$count = strlen($GLOBALS['grecord']['author_name'] );
	}
	echo ( substr( $GLOBALS['grecord']['author_name'], 0, $count ) );
}

/**
* 
**/
function theSlug()
{
	echo $GLOBALS['grecord']['slug'];
}
 
/**
* 
**/
function theCategories( $class = '' )
{
	$tags = $GLOBALS['grecord']['categories'];
	$type = $GLOBALS['grecord']['type'];
	$tags = explode(", ", $tags );
	$tagged = array(); 
	foreach ($tags as $tag ) {
		$tagged[] = '<a class="'.$class.'" href="'._ROOT.'/categories/'.$tag.'/'.$type.'/">'.ucwords( $tag ).'</a>';
	}

	$tags = implode(' ', $tagged );
	echo $tags;
}

/**
* 
**/
function recordCategories( $type = 'article', $class = '' )
{
	$tags = $GLOBALS['grecord']['categories'];
	$type = $GLOBALS['grecord']['type'];
	$tags = explode(", ", $tags );
	$tagged = array(); 
	foreach ($tags as $tag ) {
		$tagged[] = $tag;
	}

	$tags = implode(' ', $tagged );
	echo $tags;
}

/**
* 
**/
function theTags( $class = "" )
{
	if ( isset( $GLOBALS['grecord']['tags'] )) {
		$tags = $GLOBALS['grecord']['tags'];
		$type = $GLOBALS['grecord']['type'];
		$tags = explode(", ", $tags );
		$tagged = array(); 
		foreach ($tags as $tag ) {
			$tagged[] = '<a class="'.$class.'" href="'._ROOT.'/tags/'.$tag.'/'.$type.'/">'.ucwords( $tag ).'</a>';
		}

		$tags = implode(' ', $tagged );
		echo $tags;
	}
}

function theTemplate()
{
	echo( $GLOBALS['grecord']['template'] );
}

function recordTemplate()
{
	return $GLOBALS['grecord']['template'];
}

/**
* 
**/
function recordTags()
{
	$tags = $GLOBALS['grecord']['tags'];
	$tags = explode(", ", $tags );
	$tagged = array(); 
	foreach ($tags as $tag ) {
		$tagged[] = $tag;
	}

	$tags = implode(' ', $tagged );
	echo $tags;
}

/**
* 
**/
function theImage( $width = "100%", $height = "", $class = "featured-image" )
{
	echo ( '<img src = "'. $GLOBALS['grecord']['avatar'] .'" width = "'.$width.'" height ="'.$height.'" alt="Image for '.$GLOBALS['grecord']['name'].'" class="'.$class.'" >');
}

/**
* 
**/
function recordImage(){
	echo( $GLOBALS['grecord']['avatar'] );
}

/**
* 
**/
function theDate( $format = "D M d, Y" )
{
	$created = $GLOBALS['grecord']['created'];
	$timed = strtotime( $created );
	$formatted = date( $format, $timed );
	echo( $formatted );
}

/**
* 
**/
function headerTitle( $table = "dashboard" )
{
	if ( isset( $_GET['type'] ) ) {
		$text = ucwords( $table .': '.$_GET['type'].'s ');
	} elseif ( isset( $_GET['view'] ) ) {
		if ( $_GET['view'] == "list" ) {
			if ( isset( $_GET['key'])) {
				$key = $_GET['key'];
			} elseif ( isset( $_GET['status'])) {
				$key = $_GET['status'];
			}
		  $text = ucwords( $table .': '.$key." List" );
		} else {
		  $text =  ucwords( $table );
		}
	} elseif ( isset( $_GET['x'] ) && isset( $_GET['key'] ) ) {
		if ( isset( $_GET['create'] ) ) {
		  $text = "Add New " . ucwords( $_GET['create'] );
		} elseif ( isset( $_GET['edit'] ) ) {
		  $text = "Editing " . ucwords( $_GET['key'] );
		} elseif ( isset( $_GET['settings'] ) ) {
		  $text = ucwords( $_GET['settings'] );
		}
	} elseif ( isset( $_GET['x'] ) && isset( $_GET['create'] ) ) {
		$text = ucwords( "Create ".$_GET['create'] );
	} elseif ( isset( $_GET['x'] ) && isset( $_GET['settings'] ) && !isset( $_GET['key'] ) ) {
		$text = ucwords( $_GET['settings'].' Options' );
	} elseif ( isset( $_GET['create'] ) ) {
		$text = "Add New ".ucwords( $_GET['create'].' ' );
	} elseif ( isset( $_GET['add'] ) ) {
		$text = "Add New ".ucwords( $_GET['add'].' ' );
	} elseif ( isset( $_GET['chat'] ) ) {
		if ( $_GET['chat'] == "list" ) {
		  $text = "Chats List";
		} else {
		  $text = "Chat ".ucwords( $_GET['chat'] );
		}
	} elseif ( isset( $_GET['page'] ) ) {
		$text = ucwords( $_GET['page'] );
	} elseif ( isset( $_GET['settings'] ) ) {
		$text = ucwords( $_GET['settings'].' Options' );
	} elseif ( isset( $_GET['edit'] ) && $_GET['key'] !== "" ) {
		$text = 'Editing '.ucwords( $_GET['key'].' ' );
	} elseif ( isset( $_GET['pay'] ) ) {
		$text = "Pay Via ".strtoupper( $_GET['method'] );
	}

	//author-key, category, type, status, for-key, id-key, page, settings, options, x
	return $text;
}

/**
* What makes Jabali apps progressive
**/
function head()
{
	echo( '<!-- Basic App Metadata -->
<meta charset="'. getOption( 'charset' ) .'">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<meta name="description" content="'. getOption( 'description' ) .'">
<meta name="keywords" content="Keywords">
<meta name="theme-color" content="white"/>
<meta name="background-color" content="#008aff"/>

<!-- Make our app progressive -->

<!-- Android  -->
<meta name="theme-color" content="teal">
<meta name="mobile-web-app-capable" content="yes">

<!-- Add to homescreen for Safari on iOS -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="'. getOption( 'name' ) .'">
<link rel="apple-touch-icon-precomposed" href="' . getOption( 'favicon' ) .'">

<!-- Pinned Sites  -->
<meta name="application-name" content="'. getOption( 'name' ) .'">
<meta name="msapplication-tooltip" content="'. getOption( 'description' ) .'">
<meta name="msapplication-starturl" content="/">
<link rel="icon" sizes="192x192" href="' . getOption( 'favicon' ) .'">

<!-- Tile icon for Win8 (144x144 + tile color) -->
<meta name="msapplication-TileImage" content="' . getOption( 'favicon' ) .'">
<meta name="msapplication-TileColor" content="#008080">

<!-- Browser Icon -->
<link rel="shortcut icon" href="' . getOption( 'favicon' ) .'">

<!-- App Manifest for adding to homescreen -->
<link rel="manifest" href="'. _ROOT.'/manifest" >

<!-- RSS/Atom feed -->
<link rel="alternate" type="application/rss+xml" href="'. _ROOT.'/feed/" title="'. getOption( 'name' ) .'">

<!-- Colors stylesheet -->
<link rel="stylesheet" href="'. _STYLES .'colors.css">' );
}

/**
* Generates a web manifest, making the app addable to homescreen/desktop
**/
function manifest()
{
	$manifest["name"] = getOption('name');
	$manifest["short_name"] = getOption('name');
	$manifest["start_url"] = ".";
	$manifest["orientation"] = "portrait";
	$manifest["display"] = "standalone";
	$manifest["theme_color"] = "teal";
	$manifest["background_color"] = "white";
	$manifest["description"] = getOption('description');
	$manifest["icons"][] = array( 
		'src' => getOption('favicon'), 
		'type' => "image/png", 
		'sizes' => "96x96"
	);
	$manifest["icons"][] = array( 
		'src' => getOption('favicon'), 
		'type' => "image/png", 
		'sizes' => "144x144"
	);
	$manifest["icons"][] = array( 
		'src' => getOption('favicon'), 
		'type' => "image/png", 
		'sizes' => "192x192");
	$manifest["icons"][] = array( 
		'src' => getOption('favicon'), 
		'type' => "image/png", 
		'sizes' => "300x300");
	$manifest["related_applications"][] = array( 
		'platform' => "web", 
		'url' => ""
	);
	$manifest["related_applications"][] = array( 
		'platform' => "play", 
		'url' => ""
	);

	header("Access-Control-Allow-Origin: *");
	header('Content-Type:Application/manifest+json' );
	echo json_encode( $manifest );
}

/**
* Add a submit button to form.
* Button is a floating action button with an icon in the midde
**/
function submitButton( $name = "create", $position = "alignright", $icon = "save", $form = false )
{	csrf();
	$form = ( $form == true ) ? '</form>' : '';
	echo( '<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored '.$position.'" type="submit" name="'.$name.'"><i class="material-icons">'.$icon.'</i></button>'.$form );
}

/**
* Show a send button
**/
function sendButton( $name = "create", $value = "", $class = "alignright" )
{	csrf();
	$value = !empty( $value ) ? $value : $name;
	echo( '<button class="'.$class.'" type="submit" name="'.$name.'">'.$value.'</button>' );
}

/**
* Add hidden fields to a form
**/
function hiddenFields( array $fields )
{
	foreach ($fields as $name => $value) {
		echo( '<input type="hidden" name="'.$name.'" value="'.$value.'">' );
	}
}

/**
* Check if app is undergoing maintenance and display appropriate message
**/
function updatingJabali()
{
	if ( file_exists( '.jbl' ) ) {
		header("HTTP/1.1 503 Service Temporarily Unavailable");
		header("Status: 503 Service Temporarily Unavailable");
		header("Retry-After: 3600");
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
			<html xml:lang=&quot;en&quot; lang=&quot;en&quot; xmlns=&quot;https://www.w3.org/1999/xhtml&quot;>
				<head>
					<meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=UTF-8&quot; />
					<title>'.getOption('name').' App Upgrade In Progress</title>
					<meta name=&quot;robots&quot; content=&quot;none&quot; />
				</head>
				<body>
					<h1>'.getOption('name').' app upgrade in progress</h1>
					<p>This app is being upgraded, and cannot currently be accessed.</p>
					<p>It should be back up and running very soon. Please check back in a bit!</p>
					<hr />
				</body>
			</html>';
		exit();
	}
}

/**
* Get user IP
* @return IP address
**/
function userIP()
{
	$client = $_SERVER['HTTP_CLIENT_IP'];
	$forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote = $_SERVER['REMOTE_ADDR'];

	if ( filter_var( $client, FILTER_VALIDATE_IP ) ) {
		return $client;
	} elseif ( filter_var( $forward, FILTER_VALIDATE_IP ) ) {
		return $forward;
	} else {
		return $remote;
	}
}

/**
* Allow or deny direct access to php files
**/
function noAccess( $access = null )
{
	if ( !is_null( $access ) ) {
		define('ACCESS', true );
	}

	if ( !defined( 'ACCESS' ) ) {
		die( 'Direct access of file not allowed' );
		exit();
	}
}

/**
* Wrapper function for the PhpMailer library to send emails
**/
function eMail( $receipients, $subject, $message, $cc = null, $attachments = null, $isHTML = true )
{
	$receipients = is_array( $receipients ) ? $receipients : array( $receipients );

	foreach ( $receipients as $email => $name ) {
		$GLOBALS['MAILER'] -> addAddress( $email, $name );
	}

	if ( !is_null( $attachments ) ) {
		$attachments = is_array( $attachments ) ? $attachments : array( $attachments );

		foreach ($attachments as $file => $name ) {
			$GLOBALS['MAILER'] -> addAttachment( $file, $name);
		}
	}

	$GLOBALS['MAILER'] -> isHTML( $isHTML );

	$GLOBALS['MAILER'] -> From = getOption('email');
	$GLOBALS['MAILER'] -> FromName = getOption('name');

	$GLOBALS['MAILER'] -> Subject = $subject;
	$GLOBALS['MAILER'] -> Body = "<em>".$message."</em>";
	$GLOBALS['MAILER'] -> AltBody = $message;

	if(!$GLOBALS['MAILER'] -> send()) 
	{
	    return array( 
	    	"status" => "fail", 
	    	"message" => $GLOBALS['MAILER'] -> ErrorInfo 
	    );
	} 
	else 
	{
	    return array( 
	    	"status" => "success", 
	    	"message" => "Message has been sent successfully" 
	    );
	}
}

/**
* Generate keys and authentication salts for Jabali apps
**/
function keyGen( $key )
{
	if ( $key == "salt" ) {
		echo( md5( date( 'YYMMDDHHIISS').rand(89, 489900) ) );
	} elseif ( $key == "auth" ) {
		echo( sha1( md5( date( 'YYMMDDHHIISS').rand(89, 489900) ) ) );
	} else {
		echo( md5( date( 'YYMMDDHHIISS').rand(89, 489900) ) );
		echo( '<br>');
		echo( sha1( md5( date( 'YYMMDDHHIISS').rand(89, 489900) ) ) );
	}
}

/**
* Wrapper function for the GUZZLE library for sending synchronous and assynchronous requests
**/
function guzzler( $url, $method, $auth, $async = false )
{
	if ( $async !== false ) {
		$request = new \GuzzleHttp\Psr7\Request( $method, $url );
		$promise = $GLOBALS['GUZZLE']->sendAsync($request)->then(function ($response) {
		    return $response->getBody();
		});
		$promise -> wait();
	} else {
		$res = $GLOBALS['GUZZLE']->request($method, $url, [ 'auth' => [$auth[0], $auth[1]] ]);
		$data = $res->getStatusCode();
		$data .= $res->getHeader('content-type');
		$data .= $res->getBody();
		return $data;
	}
	
}

/**
* Generates and renders RSS/Atom Feed
**/
function feed( $type = "rss" )
{
	$title = getOption('name');
	$subtitle = getOption('description');
	$logo = getOption('headerlogo');
	$icon = getOption('favicon');
	$link = _ROOT;
	$description = getOption('description');
	$copyright = getOption('copyright');
	$mail = getOption('email');
	$date = date( 'Y-m-d H:i:s');
	$salt = JBLSALT;
	$rssdata = <<<RSS
<?xml version="1.0" encoding="UTF-8" ?>
	<rss version="2.0">
		<channel>
			<title>{$title}</title>
			<link>{$link}</link>
			<description>{$description}</description>
			<category>Web development</category>
			<copyright>{$copyright}</copyright>
			<language>en-us</language>
			<docs>https://docs.jabalicms.org/api/feed</docs>
			<webMaster>{$mail}</webMaster>
			<pubDate>{$date}</pubDate>
RSS;

	$atomdata = <<<RSS
<?xml version="1.0" encoding="utf-8"?>
	<feed xmlns="https://www.w3.org/2005/Atom">
		<title>{$title}</title>
		<subtitle>{$subtitle}</subtitle>
		<link href="{$link}"/>
		<icon>{$icon}</icon>
		<logo>{$logo}</logo>
		<rights>{$copyright}</rights>
		<updated>{$date}</updated>
		<id>urn:uuid:{$salt}</id>
RSS;

		$posts = $GLOBALS['POSTS'] -> sweep();
		array_shift( $posts );
	foreach ( $posts as $post ) {
		$details = htmlspecialchars( $post['details']);
		$excerpt = htmlspecialchars( $post['excerpt']);
		$atomdata .= <<<RSS
<entry>
	<title>{$post['name']}</title>
	<link href="{$post['link']}"/>
	<id>{$post['id']}</id>
	<category term="{$post['categories']}" />
	<author>
	  <name>{$post['author_name']}</name>
	  <uri>{$link}/users/{$post['author']}/</uri>
	</author>
	<published>{$post['created']}</published>
	<updated>{$post['updated']}</updated>
	<summary>{$excerpt}</summary>
	<content>{$details}</content>
</entry>
RSS;

		$rssdata .= <<<RSS
			<item>
				<title>{$post['name']}</title>
				<link>{$post['link']}</link>
				<description>{$details}</description>
				<comments>{$link}/comments/{$post['slug']}</comments>
				<pubDate>{$post['created']}</pubDate>
				<guid>{$post['id']}</guid>
				<category>{$post['categories']}</category>
			</item>
RSS;
	}

	$rssdata .= <<<RSS
		</channel>
	</rss>
RSS;

	$atomdata .= <<<RSS
	</feed>
RSS;

	if ( $type == "rss") {
		header("Content-Type: application/xml; charset=UTF-8");
		header('Pragma: public');
		header('Cache-control: private');
		header('Expires: -1');
		echo( $rssdata );
	} elseif ( $type == "atom") {
		header("Content-Type: application/atom+xml; charset=UTF-8");
		header('Pragma: public');
		header('Cache-control: private');
		header('Expires: -1');
		echo( $atomdata );
	} else {
		header("Content-Type: application/xml; charset=UTF-8");
		header('Pragma: public');
		header('Cache-control: private');
		header('Expires: -1');
		echo( $rssdata );
	}
}

/**
* Load login providers and form
**/
function login( $provider = "jabali" )
{
	$theme = getOption( 'activetheme' );
	if ( file_exists( _ABSTHEMES_ . $theme . '/templates/login.php') ) {
		$themefile = _ABSTHEMES_ . $theme . '/templates/login.php';
	} elseif ( file_exists( _ABSTHEMES_ . $theme . '/templates/signin.php') ) {
		$themefile = _ABSTHEMES_ . $theme . '/templates/signin.php';
	} else {
		$themefile = "";
	}

	if ( $themefile !== "" ) {
		getHeader();
		require_once ( $themefile );
		getFooter();
	} else {
		theHeader();
		if ( $provider == "jabali" || empty( $provider ) ) { ?>
			  	<title>Sign In - <?php showOption( 'name' ); ?></title><?php
			  	renderView( 'login' );
		} elseif ( $provider == "facebook" || $provider == "twitter" || $provider == "github" || $provider == "google" ) { ?>
		  	<title>Sign In - <?php showOption( 'name' ); ?></title><?php
		  	$config = array(
			    "base_url" => "app/lib/hybridauth/",
			    "providers" => array(
			        // openid providers
			        "OpenID" => array(
			            "enabled" => true,
			        ),
			        "Yahoo" => array(
			            "enabled" => true,
			            "keys" => array("id" => "", "secret" => ""),
			        ),
			        "AOL" => array(
			            "enabled" => true,
			        ),
			        "Google" => array(
			            "enabled" => true,
			            "keys" => array("id" => "", "secret" => ""),
			        ),
			        "Facebook" => array(
			            "enabled" => true,
			            "keys" => array("id" => "1084251448343450", "secret" => "8bee7cdf240afde6c3977ad73992a05a"),
			            "trustForwarded" => false,
			        ),
			        "Twitter" => array(
			            "enabled" => true,
			            "keys" => array("key" => "WIewzibMOm4cV8ixqPHX084yE", "secret" => "gBf4pN1Ft2OEgR6Qp8l5UIeIo8KY073VHkZXue4SrBrgMCRRfZ"),
			            "includeEmail" => true,
			        ),
			        // windows live
			        "Live" => array(
			            "enabled" => true,
			            "keys" => array("id" => "", "secret" => ""),
			        ),
			        "LinkedIn" => array(
			            "enabled" => true,
			            "keys" => array("id" => "", "secret" => ""),
			            "fields" => array(),
			        ),
			        "Foursquare" => array(
			            "enabled" => true,
			            "keys" => array("id" => "", "secret" => ""),
			        ),
			    ),
			    // If you want to enable logging, set 'debug_mode' to true.
			    // You can also set it to
			    // - "error" To log only error messages. Useful in production
			    // - "info" To log info and error messages (ignore debug messages)
			    "debug_mode" => false,
			    // Path to file writable by the web server. Required if 'debug_mode' is not false
			    "debug_file" => "",
			);
			require_once( 'app/lib/hybridauth/Hybrid/Auth.php' );
			try {
		    $hybridauth = new \Hybrid_Auth( $config );
		    $authProvider = $hybridauth -> authenticate( $provider );
		    $user_profile = $authProvider -> getUserProfile();
		    $userDetails = (array)$GLOBALS['USERS'] -> getEmail( $user_profile->email );
			    if ( $user_profile && isset( $user_profile -> identifier ) ) {
					$_SESSION[JBLSALT.'Alias'] = $user_profile -> displayName;
					$_SESSION[JBLSALT.'Username'] = $userDetails['username'];
					$_SESSION[JBLSALT.'Code'] = $userDetails['id'];
					$_SESSION[JBLSALT.'Email'] = $user_profile -> email;
					$_SESSION[JBLSALT.'Phone'] = $userDetails['phone'];
					$_SESSION[JBLSALT.'Org'] = $userDetails['company'];
					$_SESSION[JBLSALT.'Cap'] = $userDetails['type'];
					$_SESSION[JBLSALT.'Location'] = $userDetails['location'];
					$_SESSION[JBLSALT.'Avatar'] = $user_profile->photoURL;
					$_SESSION[JBLSALT.'Gender'] = $userDetails['gender'];

					header( 'Location: '._ROOT.'/admin/index?page=my dashboard' );
					exit();
			    }
		    }

		    catch( Exception $e ) {
		        switch( $e->getCode() )
		        {
		                case 0 : echo "Unspecified error."; break;
		                case 1 : echo "Hybridauth configuration error."; break;
		                case 2 : echo "Provider not properly configured."; break;
		                case 3 : echo "Unknown or disabled provider."; break;
		                case 4 : echo "Missing provider application credentials."; break;
		                case 5 : echo "Authentication failed The user has canceled the authentication or the provider refused the connection.";
		                         break;
		                case 6 : echo "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.";
		                         $authProvider->logout();
		                         break;
		                case 7 : echo "User not connected to the provider.";
		                         $authProvider->logout();
		                         break;
		                case 8 : echo "Provider does not support this feature."; break;
		        }

		        echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

		        echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";
		    }
		} else { ?>
			<title>Sign In <?php if( isset( $_GET['alert'] )){ echo( ucfirst( $_GET['alert'] ) ); } ?> - <?php showOption( 'name' ); ?></title><?php
				renderView( 'login' );
			  }
		theFooter();
	}
}

/**
* Render registration form
**/
function register( $type )
{ ?>
	<title>Sign Up - <?php showOption( 'name' ); ?></title><?php

	$theme = getOption( 'activetheme' );
	if ( file_exists( _ABSTHEMES_ . $theme . '/templates/signup.php') ) {
		$themefile = _ABSTHEMES_ . $theme . '/templates/signup.php';
	} elseif ( file_exists( _ABSTHEMES_ . $theme . '/templates/register.php') ) {
		$themefile = _ABSTHEMES_ . $theme . '/templates/register.php';
	} else {
		$themefile = "";
	}

	if ( $themefile !== "" ) {
		getHeader();
		require_once ( $themefile );
		getFooter();
	} else {
		if ( isset( $_GET['register'] ) && $_GET['email'] !== "") {
			if ( emailExists( $_GET['email'] ) ) {
				header("Location: ./register/?create=exists");
			} else {
				theHeader();
				renderView( 'signup' );
				theFooter();
			}
		} elseif (isset( $_GET['confirm'] ) && $_GET['key'] !== "" ) {
			$USERS -> confirmUser( $_GET['confirm'], $_GET['key'] );
		} else {
			theHeader();
			renderView( 'checkmail' );
			theFooter();
		}
	}
}

/**
* Render template for forgot password
**/
function forgot()
{ ?>
  	<title>Forgot Password - <?php showOption( 'name' ); ?></title>
	<?php
	$theme = getOption( 'activetheme' );
	if ( file_exists( _ABSTHEMES_ . $theme . '/templates/forgot.php') ) {
		getHeader();
		require_once( _ABSTHEMES_ . $theme . '/templates/forgot.php' );
		getFooter();
	} else {
		theHeader();
		renderView( 'forgot' );
		theFooter();
	}
}

/**
* Validate password reset key and render appropriate template
**/
function resetPass( $id, $key )
{
    $theUser = $GLOBALS['JBLDB'] -> select( 'users', array( 'id', 'authkey' ), array( 'id' => $id ));
    if ( !isset( $theUser['error'] ) ) {
      while ( $thisuser = $GLOBALS['JBLDB'] -> fetchAssoc( $theUser) ) {
        $user[] = $thisuser;
      }

    if ( !empty( $user) && $user[0]['authkey'] = $_GET['key'] ) { ?>
      	<title>Reset Password - <?php showOption( 'name' ); ?></title><?php
    	$theme = getOption( 'activetheme' );
		if ( file_exists( _ABSTHEMES_ . $theme . '/templates/reset.php') ) {
			getHeader();
			require_once( _ABSTHEMES_ . $theme . '/templates/reset.php' );
			getFooter();
		} else {
			theHeader();
			renderView( 'forgot' );
			theFooter();
		}
    }
  }
}

/**
* 
**/
function search( $query )
{
	$tables = array( "users", "posts", "resources" );
	$results = array();
	foreach ($tables as $table) {
		$tableres = $GLOBALS['JBLDB'] -> selectLike( $table, "*", ["details" => $query]);
		if ( $GLOBALS['JBLDB'] -> numRows( $tableres ) > 0 ) {
			while ( $result = $GLOBALS['JBLDB'] -> fetchAssoc( $tableres ) ) {
				$results[] = array( $result );
			}
		}
	}
	$GLOBALS['grecords'] = $results;
	$GLOBALS['grecord'] = null;
	$GLOBALS['grecord_count'] = 0;
	$GLOBALS['grecord_index'] = 0;
	echo( '<title>Search: '.ucwords( $query ).' - '.getOption("name").'</title>');
	$data = array( 'search' => 'Search: '.ucwords( $query ) );
	require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
}

/**
* Fetch and render a single post
**/
function fetchSingle( $slug )
{
	if ( substr( $slug, 0, 7 ) == "?search") {
		$query = str_replace("?search=", "", $slug );
		search( $query );
	} elseif ( getOption( 'postspage' ) == $slug ) {
		blog( $slug );
	} else {

		$post = $GLOBALS['POSTS'] -> getSingle( $slug );

		if ( !isset( $post['error'] ) ) {
			if ( file_exists( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/'.$GLOBALS['POSTS'] -> template .'.php' ) ) {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/'.$GLOBALS['POSTS'] -> template .'.php' );
			} else {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/single.php' );
			}
		} else {
			error404();
		}
	}
}

function archiveHeader( $data, $text = 'From The Blog' )
{
	if ( isset($data['category'])) {
		echo( "Category: ".ucwords( $data['category']) );
	} elseif ( isset($data['tag'])) {
		echo( "Tag: ".ucwords( $data['tag']) );
	} elseif ( isset($data['author'])) {
		echo( "Author: ".ucwords( $data['author']) );
	} elseif ( isset($data['page'])) {
		echo( ucwords( $data['page']) );
	} elseif ( isset($data['search'])) {
		echo( ucwords( $data['search']) );
	} else {
		echo( $text );
	}
}

/**
* Fetches and renders all posts of type article
**/
function blog( $title = "Blog", $limit = 10 )
{
	$posts = $GLOBALS['POSTS'] -> sweep('article', 'created', $limit);
	if ( $posts['status'] !== "fail" ) {?>
	<title><?php echo( ucwords($title) ); ?> - <?php showOption( 'name' ); ?></title><?php
	$data = array();
		require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
	} else {
		error404();
	}
}

/**
* Fetch archive records
**/
function archive( $elements )
{
	$table = strtoupper( $elements[0] );
	array_shift( $elements );
	$type = substr( $elements[0], 0, -1);
	array_shift( $elements );
	$date = implode( '/', $elements );
	$posts = $GLOBALS[$table] -> getCreated( $date, $type );
	if ( $posts['status'] !== "fail" ) {?>
	<title><?php echo( ucwords($type) ); ?>s Published in <?php echo( ucwords($date) ); ?> - <?php showOption( 'name' ); ?></title><?php
	 $data = array();
	 	require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
	 } else {
	 	error404();
	 }
}

/**
* Fetches and renders posts by $author
**/
function authors( $author )
{
	resetLoop( 'getAuthor', [$author, ['status' => 'published', 'type' => 'article'], [ 'created', 'DESC' ]] );
	$user = $GLOBALS['USERS'] -> getSingle( $author );
	$data = array( 'author' => ucwords( $GLOBALS['USERS'] -> name ) );
	echo( '<title>Author : '. ucwords( $GLOBALS['USERS'] -> name ).' - '.getOption( 'name' ) .'</title>' );
	require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
}

/**
* Fetches and renders records in category
**/
function category( $category, $type = "article" )
{ 
	$category = str_replace('%20', ' ', $category);?>
	<title><?php echo( ucwords( $type ) ); ?> Category : <?php echo( ucwords( $category ) ); ?> - <?php showOption( 'name' ); ?></title><?php
	resetLoop( 'getCategories', [htmlspecialchars_decode($category), $type] );
	$data = array( 'category' => ucwords( $category ) );
	require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
}

/**
* Renders all records with tag
**/
function tag( $tag, $type = "article" )
{ 
	$tag = str_replace('%20', ' ', $tag); ?>
	<title><?php echo( ucwords( $type ) ); ?> Tag : <?php echo( ucwords( $tag ) ); ?> - <?php showOption( 'name' ); ?></title><?php
	resetLoop( 'getTags', [$tag, $type] );
	$data = array();
	$data['tag'] = ucwords( $tag );
	require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
}


/**
* Fetches and renders portfolio items and clients
**/
function portfolio( $elements )
{
	if ( empty( $elements[0] )) { ?>
		<title>Portfolio - <?php showOption( 'name' ); ?></title><?php
		$posts = $GLOBALS['POSTS'] -> getTypes('project');
		if ( file_exists( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/portfolio.php') ) {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/portfolio.php' );
		} else {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
		}
	} elseif ( $elements[0] == "categories" ) { ?>
		<title>Category : <?php echo( ucwords( $elements[1] ) ); ?> - <?php showOption( 'name' ); ?></title><?php
		$posts = $GLOBALS['POSTS'] -> getCategories( $elements[1], 'project');
		if ( file_exists( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/portfolio.php') ) {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/portfolio.php' );
		} else {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
		}
	} elseif ( $elements[0] == "clients" ) { ?>
		<title>Clients: <?php echo( ucwords( $elements[1] ) ); ?> - <?php showOption( 'name' ); ?></title><?php
		$posts = $GLOBALS['USERS'] -> getTypes('client');
		if ( file_exists( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/portfolio.php') ) {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/portfolio.php' );
		} else {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
		}
	} elseif ( $elements[0] == "projects" ) { ?>
		<title>Portfolio - <?php showOption( 'name' ); ?></title><?php
		$posts = $GLOBALS['POSTS'] -> getTypes('project');
		if ( file_exists( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/portfolio.php') ) {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/portfolio.php' );
		} else {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
		}
	} else {  ?>
		<title>Portfolio - <?php showOption( 'name' ); ?></title><?php
		$posts = $GLOBALS['POSTS'] -> getTypes('project');
		if ( file_exists( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/portfolio.php') ) {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/portfolio.php' );
		} else {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
		}
	}
}

/**
* Returns an array of users or user details and renders an appropriate template.
* Defaults to the archive template if the theme does not have one for users.
**/
function users( $profile )
{
	if ( $profile == 'all' || $profile == "" ) { ?>
		<title>All Users - <?php showOption( 'name' ); ?></title><?php
		resetLoop( 'getStatus', 'active', 'users' );
		$data = array( 'page' => 'All Users' );
		if( file_exists( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/users.php' ) ){
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/users.php' );
		} else {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
		}
	} else {
		$user = $GLOBALS['USERS'] -> getSingle ( $profile );
		if ( !isset($user['error']) ) {
			$GLOBALS['grecord'] = (array)$GLOBALS['USERS'];
			if( file_exists( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/profile.php' ) ){
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/profile.php' );
			} else {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/single.php' );
			}
		} else {
			error404();
		}
	}
}

function validateClient($k, $s)
{
	return $GLOBALS['CLIENTS'][$k] == $s ? true  : false;
}

function getClients()
{
    $res = array();
    $clients = $GLOBALS['JBLDB'] -> query("SELECT * FROM "._DBPREFIX."clients");
    if( $clients && $GLOBALS['JBLDB'] -> numRows($clients) > 0 ){
        while( $client = $GLOBALS['JBLDB'] -> fetchAssoc($clients) ){
            $res['status'] = 'client';
            $res[] = $client;
        }
    }
    return $res;
}

function setClients()
{
    $res = array();
    $clients = $GLOBALS['JBLDB'] -> query("SELECT * FROM "._DBPREFIX."clients");
    if( $clients && $GLOBALS['JBLDB'] -> numRows($clients) > 0 ){
        while( $client = $GLOBALS['JBLDB'] -> fetchAssoc($clients) ){
            $GLOBALS['CLIENTS'][$client['appkey']] = $client['appsecret'];
        }
    }
} 