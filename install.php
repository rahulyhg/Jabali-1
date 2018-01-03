<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage App Instalation
* @link https://docs.jabalicms.org/installation/
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.04
* @license MIT - https://opensource.org/licenses/MIT
**/

if ( !file_exists( 'app/config.php' ) ) {
	header( "Location: setup.php" );
}

require 'init.php';
if (isset( $_POST['register'] ) ) {
	$date = date( "Ymd H:i:s" );
    $email = $GLOBALS['JBLDB'] -> clean( $_POST['email'] );
    $site_name = $GLOBALS['JBLDB'] -> clean( $_POST['h_name'] );
    $admin_name = $GLOBALS['JBLDB'] -> clean( $_POST['u_name'] );
    $social = [ 
        "facebook" => "https://www.facebook.com/",
        "twitter" => "https://twitter.com/",
        "instagram" => "https://instagram.com/",
        "github" => "https://github.com/"
    ];

    $hash = str_shuffle(
        md5( $email .$date ) 
    );

    $author = 1;
    $avatar = _IMAGES.'avatar.png';
    $company = "Jabali CMS";
    $id = $author;
    $created = date( 'Y-m-d H:i:s' );
    $gender = "other";
    $authkey = $hash;
    $level = "admin";
    $link = "";
    $location = "nairobi";
    $excerpt = "Account created on ".$created;
    $password = md5( $_POST['password'] );
    $social = json_encode( $social );
    $status = "active";
    $style = "zahra";
    $type = "admin";
    $username = strtolower($_POST['username'] );

    $menu_code = substr( 
        md5( date( 'YmdHms' ).rand( 10, 1000 ) ), 
        0, 
        12
    );
    
	//require_once ( 'app/views/options/tos.jbl' );

	/*
	*Set Initial Settings So They Are Editable
	*/
	$GLOBALS['OPTIONS'] -> install ( 'Site Name', 'name', $site_name, $created );
    $GLOBALS['OPTIONS'] -> install ( 'About', 'about', 'Long app description. Say something, in fifty words or so, about this app or organization. Or yourself.', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Description', 'description', 'Built With Jabali', $created );
	$GLOBALS['OPTIONS'] -> install ( 'Admin Email', 'email', $email , $created );
	$GLOBALS['OPTIONS'] -> install ( 'Admin Phone', 'phone', '+254204404993', $created );
	$GLOBALS['OPTIONS'] -> install ( 'Copyright', 'copyright', '© '. $site_name .' 2017', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Admin Footer', 'adfooter', 'The Jabali Framework', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Attribution', 'attribution', 'Mauko', $created );
	$GLOBALS['OPTIONS'] -> install ( 'Attribution Link', 'attribution_link', 'https://mauko.co.ke', $created );
	$GLOBALS['OPTIONS'] -> install ( 'Header Logo', 'headerlogo', _IMAGES."logo.png", $created );
	$GLOBALS['OPTIONS'] -> install ( 'Home Logo', 'homelogo', _IMAGES."logo-w.png", $created );
	$GLOBALS['OPTIONS'] -> install ( 'Favicon', 'favicon', _IMAGES."marker.png", $created );
	//$GLOBALS['OPTIONS'] -> install ( 'Terms Of Service', 'tos', htmlspecialchars( $tos ), $created );
	$GLOBALS['OPTIONS'] -> install ( 'Site Social', 'social', $social, $created );
	$GLOBALS['OPTIONS'] -> install ( 'Allow Registration', 'registration', 'checked', $created );
    $GLOBALS['OPTIONS'] -> install ( 'User Types', 'usertypes', '{}', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Post Types', 'posttypes', '{}', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Resource Types', 'resourcetypes', '{}', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Comment Types', 'commenttypes', '{}', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Message Types', 'messagetypes', '{}', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Active Modules', 'modules', '[]', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Active Theme', 'activetheme', 'eventually', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Timezone', 'timezone', 'Africa/Nairobi', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Country', 'country', 'Kenya', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Region', 'region', 'Nairobi', $created );
    $GLOBALS['OPTIONS'] -> install ( 'City/Town', 'city', 'Nairobi', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Language', 'language', 'en', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Charset', 'charset', 'utf-8', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Home Page', 'homepage', 'home', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Posts Page', 'postspage', 'blog', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Ace Editor Theme', 'acetheme', 'chrome', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Show Ace Editor Gutter', 'acegutter', 'true', $created );
    $GLOBALS['OPTIONS'] -> install ( 'Show Ace Editor Lines', 'acelines', 'true', $created );

	/**
	* Set Initial Menus So They Are Editable
	**/
	//Dashboard Link
	$GLOBALS['MENUS'] -> install ( 'Dashboard', 'jabali', 'dashboard', 'dashboard'
        , '', _ADMIN.'index?page=dashboard', 'drawer', 'checked', 'drop' );

	//Posts Menu
	$GLOBALS['MENUS'] -> install ( 'Posts', 'jabali', 'description', 'posts', '', '#', 'drawer', 'checked', 'drop' );
		//Posts SubMenus
        $GLOBALS['MENUS'] -> install ( 'Drafts', 'jabali', 'insert_drive_file', 'draftarticles', 'posts', _ADMIN.'posts?status=draft', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Scheduled', 'jabali', 'schedule', 'scheduled', 'posts', _ADMIN.'posts?status=scheduled', 'drawer', 'checked', 'null' );
		$GLOBALS['MENUS'] -> install ( 'Articles', 'jabali', 'description', 'allarticles', 'posts', _ADMIN.'posts?type=article', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Pages', 'jabali', 'description', 'allpages', 'posts', _ADMIN.'posts?type=page', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Projects', 'jabali', 'description', 'allprojects', 'posts', _ADMIN.'posts?type=project', 'drawer', 'checked', 'null' );

	//Users Menu
	$GLOBALS['MENUS'] -> install ( 'Users', 'jabali', 'group', 'users', '', '#', 'drawer', 'checked', 'drop' );
		//Users SubMenus
        $GLOBALS['MENUS'] -> install ( 'Pending Users', 'jabali', 'done', 'draftusers', 'users', _ADMIN.'users?status=pending&key=users', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Adminstrators', 'jabali', 'description', 'alladmins', 'users', _ADMIN.'users?type=admin', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Editors', 'jabali', 'group', 'alleditors', 'users', _ADMIN.'users?type=editor', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Authors', 'jabali', 'group', 'allauthors', 'users', _ADMIN.'users?type=author', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Clients', 'jabali', 'group', 'allclients', 'users', _ADMIN.'users?type=client', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Subscribers', 'jabali', 'group', 'allsubscribers', 'users', _ADMIN.'users?type=subscriber', 'drawer', 'checked', 'null' );

    //Resources Menu
    $GLOBALS['MENUS'] -> install ( 'Resources', 'jabali', 'business', 'resources', '', '#', 'drawer', 'inchecked', 'drop' );
        //Resources SubMenus
        $GLOBALS['MENUS'] -> install ( 'Drafts', 'jabali', 'insert_drive_file', 'draftresources', 'resources', _ADMIN.'resources?status=draft', 'drawer', 'checked', 'null' );

    //Comments Menu
	$GLOBALS['MENUS'] -> install ( 'Comments', 'jabali', 'comment', 'comments', '', '#', 'drawer', 'checked', 'drop' );
        //Comments SubMenus
        $GLOBALS['MENUS'] -> install ( 'Pending', 'jabali', 'comment', 'pendingcomments', 'comments', _ADMIN.'comments?status=pending&key=pending comments', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Comments', 'jabali', 'comment', 'allcomments', 'comments', _ADMIN.'comments?type=comment', 'drawer', 'checked', 'null' );

    //Messages Menu
    $GLOBALS['MENUS'] -> install ( 'Messages', 'jabali', 'chat_bubble', 'messages', '', '#', 'drawer', '', 'drop' );
        //Messages SubMenus
        $GLOBALS['MENUS'] -> install ( 'Unread', 'jabali', 'message', 'pendingmessages', 'messages', _ADMIN.'messages?status=unread', 'drawer', 'checked', 'null' );
        $GLOBALS['MENUS'] -> install ( 'Messages', 'jabali', 'message', 'allmessages', 'messages', _ADMIN.'messages?type=message', 'drawer', 'checked', 'null' );
	/*
	*Create Admin Account
	*/
    if ( $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."users (title, author, avatar, company, id, created, email, gender, authkey, level, link, location, excerpt, password, social, status, style, type, username) 
    VALUES ('".$admin_name."', '".$author."', '".$avatar."', '".$company."', '".$id."', '".$created."', '".$email."', '".$gender."', '".$authkey."', '".$level."', '".$link."', '".$location."', '".$excerpt."', '".$password."', '".$social."', '".$status."', '".$style."', '".$type."', '".$username."')" ) ) {

        $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."posts (title, author, author_name, avatar, categories, created, details, gallery, authkey, level, link, excerpt, readings, status, subtitle, slug, tags, template, type, updated) 
    VALUES ('Home', '1', '".$admin_name."', '"._IMAGES."404.jpg"."', 'uncategorized', '".$created."', 'This is a sample page. Edit it or delete it alltogether.', '', '".md5( $created )."', 'public', '', '', '', 'published', 'Home', 'home', '', '', 'page', 'page', '".$created."')" );

        $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."posts (title, author, author_name, avatar, categories, created, details, gallery, authkey, level, link, excerpt, readings, status, subtitle, slug, tags, template, type, updated) 
    VALUES ('Hello World!', '1', '".$admin_name."', '"._IMAGES."placeholder.png"."', 'uncategorized', '".$created."', 'This is a sample article. Edit it or delete it alltogether.', '', '".md5( $created )."', 'public', 'hello-world', '', '', 'published', 'Hello', 'hello-world', 'starter', 'post', 'post', 'article', '".$created."')" );

		header("Location: "._ROOT."/login/jabali/" );

    } else {
        _shout_( "Error: " . $GLOBALS['JBLDB'] -> error(), "error");
    }
} else { ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="app/assets/css/colors.css">
    	<link rel="stylesheet" href="app/assets/css/material-icons.css">
    	<link rel="stylesheet" href="app/assets/css/jabali.css">
    	<script src="app/assets/js/jquery-3.2.1.min.js"></script>
    	<title>Admin Setup - Jabali CMS</title>
    </head>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    	<body>
    		<main class="mdl-layout__content mdl-grid">
    			<div class="mdl-cell mdl-cell--4-col"></div>
    			<div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone light-blue">
    			    <div id="login_div" class="mdl-grid">
    			    <div class="mdl-cell mdl-cell--12-col">
    			    <?php if( installSQLDB( $server["dbtype"] ) ){
                        _shout_('Jabali Succesfully Installed! You can now set up your admin account', 'success');
                    } else {
                        _shout_('Oops! Something went wrong during Instalation. Process aborted.<br>Error: '.$GLOBALS['JBLDB'] -> error(), 'error');
                    } ?>
                    </div>
    		          <form method="POST" action="" class="mdl-grid mdl-cell mdl-cell--12-col">

    		          <div class="input-field mdl-cell mdl-cell--12-col">
        		          <i class="material-icons prefix">label</i>
        		          <input name="h_name" id="h_name" type="text">
        		          <label for="h_name" class="center-align">App Name</label>
    		          </div>

                      <div class="input-field mdl-cell mdl-cell--12-col">
                          <i class="material-icons prefix">label_outline</i>
                          <input name="u_name" id="u_name" type="text">
                          <label for="u_name" class="center-align">Adminstrator Names</label>
                      </div>

    		          <div class="input-field mdl-cell mdl-cell--12-col">
    		          <i class="material-icons prefix">mail</i>
    		          <input name="email" id="email " type="text">
    		          <label for="email " class="center-align">Adminstrator Email</label>
    		          </div>

    		          <div class="input-field mdl-cell mdl-cell--12-col">
    		          <i class="material-icons prefix">perm_identity</i>
    		          <input name="username" id="username" type="text">
    		          <label for="username" class="center-align">Adminstrator Username</label>
    		          </div>

    		          <div class="input-field mdl-cell mdl-cell--12-col">
    		          <i class="material-icons prefix">lock</i>
    		          <input name="password" id="password" type="password">
    		          <label for="password">Adminstrator Password</label>
    		          </div>

    		          <button class="mdl mdl-button mdl-js-button mdl-button--raised mdl-button--colored alignright" type="submit" name="register"><i class="material-icons">save</i> SUBMIT</button>
    		          </form>
    			    </div>
    		    </div>
    			<div class="mdl-cell mdl-cell--4-col"></div>
    	    </main>
    	</body>
    </div>
        <script type="text/javascript">
            $('#alert_close').click(function(){
            $( "#alert_box" ).fadeOut( "slow", function() {
            });
          }); 
        </script>
        <script src="app/assets/js/d3.js"></script>
        <script src="app/assets/js/getmdl-select.min.js"></script>
        <script src="app/assets/js/material.js"></script>
        <script src="app/assets/js/materialize.js"></script>
    </html><?php
}