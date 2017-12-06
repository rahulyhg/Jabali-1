<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Setup
* @link https://docs.jabalicms.org/setup/
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.05
* @license MIT - https://opensource.org/licenses/MIT
**/


function isLocalhost()
{
    return in_array( $_SERVER['REMOTE_ADDR'], [ '127.0.0.1', '::1' ] ) ? true : false;
}

function _shout_( $what, $type = "alert" )
{
	//$color = ($type = 'alert') ? 'blue' ? ($type = 'warning') ? 'orange' ? ($type = 'error') ? 'red' ? ($type = 'success') ? 'green' : 'blue';
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

if ( file_exists('app/config.php' ) ) {
	header( "Location: install.php" );
}

if ( !file_exists( '.htaccess' ) ) {
	$rewrite = fopen( '.htaccess', 'w' );

	$text = "# JABALI INIT\n\n";
	fwrite( $rewrite,  $text );

	$text = "<IfModule mod_rewrite.c>\n";
	fwrite( $rewrite,  $text );

	$text = "RewriteEngine On\n";
	fwrite( $rewrite,  $text );

	if ( !isLocalhost() ) {
		
		$https = "RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
";

		fwrite( $rewrite,  $https );
	}

	if ( isLocalhost() && $_SERVER['DOCUMENT_ROOT'] !== __DIR__ ) {
		$base = '/'.basename( __DIR__ ).'/';
	} else {
		$base = '/';
	}
	fwrite( $rewrite, "RewriteBase " . $base."\n" );

	$text = 'RewriteRule ^index\.php$ - [L]';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = 'RewriteRule ^([^\.]+)$ $1.php [NC]';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = 'RewriteCond %{REQUEST_FILENAME} !-f';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = 'RewriteCond %{REQUEST_FILENAME} !-d';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	if ( isLocalhost() ) {
		$baser = '/'.basename( __DIR__ );
	} else {
		$baser = '';
	}
	fwrite( $rewrite,  'RewriteRule . '. $baser.'/index.php [L]'  );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = '</IfModule>';
	fwrite( $rewrite,  $text );

	$txt = "\n\n";
	fwrite( $rewrite,  $txt );

	$text = '# JABALI EXIT';
	fwrite( $rewrite,  $text );
}

$rules = '# JABALI INIT

<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /jabali/
RewriteRule ^index\.php$ - [L]
RewriteRule ^([^\.]+)$ $1.php [NC]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /jabali/index.php [L]
</IfModule>

# JABALI EXIT';

if ( isset( $_POST['setup'] ) && $_POST['host'] != "" && $_POST['user'] != "" && $_POST['prefix'] != "" && $_POST['name'] != "" && $_POST['dbtype'] != "" ) {

	$dbhost = $_POST["host"];
	$dbname = $_POST["name"];
	$dbuser = $_POST["user"];
	$dbpass = $_POST["password"];
	$home = $_POST["home"];

	$dbprefix = $_POST['prefix'];
	$dbtype = $_POST['dbtype'];
	$dbport = $_POST['dbport'];
	$dbip = $_POST['dbip'];

	function conFigure( $dbhost, $dbname, $dbuser, $dbpass, $home, $dbprefix, $dbtype, $dbport, $dbip )
	{
		$dbfile = fopen( "app/config.php", "w" ) or die( "Unable to create configuration file!" );
		$salts = sha1( date('YmdHis') ).sha1( date('YmdHm') );
		$salt = str_shuffle( md5($salts) );
		$auth = str_shuffle( sha1( $salts ) );
		$config = '<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage App Configuration File
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.04
* @link https://docs.jabalicms.org/configuration/
* @license MIT - https://opensource.org/licenses/MIT
*
* @param $server["dbhost"] The name of your host, usually localhost
* @param $server["dbuser"] Your server username
* @param $server["dbpass"] Your server password
* @param $server["dbname"] The name of the database to use
* @param $server["dbtype"] The type of database management system. Jabali supports
* @param $server["dbport"] Port through which to communicate with server
* @param $server["dbip"] IP address of the server
* 
* @param _ROOT The app\'s home/root url
* @param _DBPRFIX A prefix to be added before all database tables. 
* Allows multiple Jabali installations on same database.
* @param JBLSALT A unique, app-specific string for authentication.
* @param JBLAUTH Used in conjuction with JBLSALT for authentication and 
* prevention of Cross-site Request Forgery(CSRF). Also unique and app-specific
**/

$server["dbhost"] = "'.$dbhost.'";
$server["dbuser"] = "'.$dbuser.'";
$server["dbpass"] = "'.$dbpass.'";
$server["dbname"] = "'.$dbname.'";
$server["dbtype"] = "'.$dbtype.'";
$server["dbport"] = "'.$dbport.'";
$server["dbip"] = "'.$dbip.'";

define( "_ROOT", "'.$home.'" );
define( "_DBPREFIX", "'.$dbprefix.'" );
define( "JBLSALT", "'.$salt.'" );
define( "JBLAUTH", "'.$auth.'" );

/**
* OPTIONAL CONFIGURATIONS
*
* @param APP_SKIN Sets the default skin to use for non logged-in users. to use this setting, 
* @see https://jabalicms.org/customization/setting-global-skin/
* APP_SKIN defaults to "zahra". A list of available skins can be found here 
* @link https://jabalicms.org/customization/skins/
* @param APP_SCHEMA to use this setting, @see https://jabalicms.org/databases/set-schema/
* @param APP_DB_PATH Sets the path to the directory where your NoSQL database is stored.
* APP_DB_PATH defaults to /app/data/bases/ @see https://jabalicms.org/data/bases/
* @param APP_DEBUG Sets debug mode to on - errors are shown to the user in browser.
* APP_DEBUG defaults to logging all errors to a file - error.log instead of displaying them.
*
* These configurations are not necessary, but if you so wish you can override the Jabali
* default configurations by setting them here. Just uncomment the code.
*/

//define( "APP_SKIN", "" );
//define( "APP_SCHEMA", "" );
//define( "APP_DB_PATH", "" );

//define("APP_DEBUG", "");';		
		fwrite( $dbfile, $config );
		fclose( $dbfile );

		return true;
	}

	if ( conFigure( $dbhost, $dbname, $dbuser, $dbpass, $home, $dbprefix, $dbtype, $dbport, $dbip ) ) {
		header( "Location: install.php" );
	} else {
		_shout_( 'Could Not create configuration file <code>config.php</code><br>
		<h4>Suggestions</h4><br>
		1. Allow jabali <a href="https://stackoverflow.com/questions/2900690/how-do-i-give-php-write-access-to-a-directory">write permissions</a>.<br>
		2. Manually edit the <code>config-sample.php</code>file appropriately and save as <code>config.php</code>, then point your browser to https://yoursite.com/install.php', 'error' );
	}
} else {

    $protocol = ( ( !empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; ?>
    <!DOCTYPE html>
	<!--
	  Jabali - The Plug-N-Play Framework
	  © 2017 Mauko Maunde. All rights reserved.

	  Licensed under the MIT license (the "License" );
	  You may not use this file except in compliance with the License.
	  You may obtain a copy of the License at https://opensource.org/licenses/MIT
	-->
	<html lang="en" xmlns="https://www.w3.org/1999/html">
		<head>
        	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		    <link rel="stylesheet" href="app/assets/css/colors.css">
		    <link rel="stylesheet" href="app/assets/css/material-icons.css">
		    <link rel="stylesheet" href="app/assets/css/jabali.css">
		    <script src="app/assets/js/jquery-3.2.1.min.js"></script>
			<title>Setup - Jabali CMS</title>
		</head>

		<div class="mdl-layout mdl-layout-transparent mdl-js-layout">
			<body id="particles-js">
				<main class="mdl-layout__content">
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--4-col"></div>
						<div class="mdl-cell mdl-cell--4-col light-blue">
					        <form method="POST" action="" class="mdl-grid">
						        <div class="mdl-cell mdl-cell--12-col">
						        	<?php _shout_('Before you get started, kindly note that:
						        	<li>Jabali will create a new database for you if one doesn\'t already exist.</li>
						        	<li>If the database does already exist, Jabali will create new tables with the prefix you specify.</li>
						        	<li>Tables will only be created if they don\'t already exist.</li>
						        	<li>To avoid conflicts, make sure your prefix is unique.</li>
						        	<li>Double check your server details before proceeding.</li>
						        	<p>If you are ready to install, close this dialog box by clicking the "X" in the top right corner.</p>', 'alert'); ?>
						        </div>

						        <div class="input-field mdl-cell mdl-cell--12-col">
							        <i class="material-icons prefix">public</i>
							        <input name="host" id="host" type="text" value="localhost">
							        <label for="host" class="center-align">Database Host</label>
						        </div>

						        <div class="input-field mdl-cell mdl-cell--12-col">
							        <i class="material-icons prefix">perm_identity</i>
							        <input name="user" id="user" type="text" value="root">
							        <label for="user" class="center-align">Database Username</label>
						        </div>

						        <div class="input-field mdl-cell mdl-cell--12-col">
							        <i class="material-icons prefix">lock</i>
							        <input name="password" id="password" type="text">
							        <label for="password">Database Password</label>
						        </div>

						        <div class="input-field mdl-cell mdl-cell--12-col">
							        <i class="material-icons prefix">label</i>
							        <input name="name" id="name" type="text" value="jabali">
							        <label for="name" class="center-align">Database Name</label>
						        </div>

						        <div class="input-field mdl-cell mdl-cell--12-col">
							        <i class="material-icons prefix">label_outline</i>
							        <input name="prefix" id="prefix" type="text" value="db_">
							        <label for="prefix" class="center-align">Database Prefix</label>
						        </div>

								<div class="input-field mdl-cell mdl-cell--12-col getmdl-select">
									<i class="material-icons prefix">data_usage</i>
									<input class="mdl-textfield__input" id="type" name="dbtype" type="text" readonly tabIndex="-1" value="MySQL" >
								    <label for="type" class="center-align">Database Type</label>
									<ul class="mdl-menu mdl-menu--top-left mdl-js-menu light-blue" for="type">
										<li class="mdl-menu__item" data-val="MySQL">MySQL</li>
										<li class="mdl-menu__item" data-val="SQLite">SQLite</li>
										<li class="mdl-menu__item" data-val="PostgreSQL">PostgreSQL</li>
										<!-- <li class="mdl-menu__item" data-val="MongoDB">MongoDB</li> -->
									</ul>
								</div><br><br>

						        <input name="home" type="hidden" value="<?php 
									if ( isLocalhost() ) { 
							        	echo $protocol . $_SERVER['HTTP_HOST'] . '/' . basename( __DIR__ ); 
							        } else { 
							        	echo $protocol . $_SERVER['HTTP_HOST']; 
							        } ?>">
						        <input name="dbport" type="hidden" value="<?php echo $_SERVER['SERVER_PORT']; ?>" />
						        <input name="dbip" type="hidden" value="<?php echo $_SERVER['SERVER_ADDR']; ?>" />

						        <button class="addfab mdl-button mdl-button--fab mdl-js-button mdl-button--raised mdl-button--colored alignright" type="submit" name="setup"><i class="material-icons">arrow_forward</i></button>
					        </form>
				    	</div>
					</div>
				</main>
		        <script type="text/javascript">
		            $('#alert_close').click(function(){
		            $( "#alert_box" ).fadeOut( "slow", function() {
		            });
		          }); 
		        </script>
				<script src="app/assets/js/getmdl-select.min.js"></script>
				<script src="app/assets/js/material.js"></script>
				<script src="app/assets/js/materialize.js"></script>
				<script src="app/assets/js/particles.js"></script>
				<script type="text/javascript">
					particlesJS('particles-js', 
						{
						"particles": {
						  "number": {
						    "value": 250,
						    "density": {
						      "enable": true,
						      "value_area": 800
						    }
						  },
						  "color": {
						    "value": "#c8b68c"
						  },
						  "shape": {
						    "type": "circle",
						    "stroke": {
						      "width": 0,
						      "color": "#008080"
						    },
						    "polygon": {
						      "nb_sides": 5
						    },
						    "image": {
						      "src": "img/github.svg",
						      "width": 100,
						      "height": 100
						    }
						  },
						  "opacity": {
						    "value": 0.9,
						    "random": true,
						    "anim": {
						      "enable": true,
						      "speed": 1,
						      "opacity_min": 0.1,
						      "sync": false
						    }
						  },
						  "size": {
						    "value": 5,
						    "random": true,
						    "anim": {
						      "enable": false,
						      "speed": 40,
						      "size_min": 0.1,
						      "sync": false
						    }
						  },
						  "line_linked": {
						    "enable": true,
						    "distance": 150,
						    "color": "#ffffff",
						    "opacity": 0.4,
						    "width": 1
						  },
						  "move": {
						    "enable": true,
						    "speed": 6,
						    "direction": "none",
						    "random": false,
						    "straight": false,
						    "out_mode": "out",
						    "attract": {
						      "enable": false,
						      "rotateX": 600,
						      "rotateY": 1200
						    }
						  }
						},
						"interactivity": {
						  "detect_on": "canvas",
						  "events": {
						    "onhover": {
						      "enable": true,
						      "mode": "repulse"
						    },
						    "onclick": {
						      "enable": true,
						      "mode": "push"
						    },
						    "resize": true
						  },
						  "modes": {
						    "grab": {
						      "distance": 400,
						      "line_linked": {
						        "opacity": 1
						      }
						    },
						    "bubble": {
						      "distance": 400,
						      "size": 40,
						      "duration": 2,
						      "opacity": 8,
						      "speed": 3
						    },
						    "repulse": {
						      "distance": 200
						    },
						    "push": {
						      "particles_nb": 4
						    },
						    "remove": {
						      "particles_nb": 2
						    }
						  }
						},
						"retina_detect": true,
							"config_demo": {
							  "hide_card": false,
							  "background_color": "#b61924",
							  "background_image": "",
							  "background_position": "50% 50%",
							  "background_repeat": "no-repeat",
							  "background_size": "cover"
							}
						}
					);
				</script>
			</body>
		</div>
	</html>
<?php }