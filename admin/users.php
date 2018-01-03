<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Admin Users
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.04
* @link https://docs.jabalicms.org/users/
**/
session_start();
require_once( '../init.php' );
require_once( '../load.php' );

if ( isset( $_POST['register'] ) ) {

    if ( empty( $_POST['authkey'] ) ) { $_POST['authkey'] = str_shuffle( generateCode() ); }
    if ( empty( $_POST['ftitle'] ) ) { $_POST['title'] = 'User Name'; } else { $_POST['title'] = $_POST['ftitle'].' '.$_POST['ltitle']; }
    if ( empty( $_POST['author'] ) ) { $_POST['author'] = '1'; }
    if ( empty( $_POST['author_name'] ) ) { $_POST['author_name'] = 'Undefined'; }
    if ( empty( $_POST['categories'] ) ) { $_POST['categories'] = "uncategorized"; }
    if ( empty( $_POST['company'] ) ) { $_POST['company'] = "Jabali"; }
    if ( empty( $_POST['created_d'] ) ) { $_POST['created_d'] = date( "Y-m-d" ); }
    if ( empty( $_POST['created_t'] ) ) { $_POST['created_t'] = date( "H:i:s" ); }
    if ( empty( $_POST['custom'] ) ) { $_POST['custom'] = "{}"; }
    if ( empty( $_POST['details'] ) ) { $_POST['details'] = "About".$_POST['author_name']; }
    if ( empty( $_POST['email'] ) ) { $_POST['email'] = "user@jabalicms.org"; }
    if ( empty( $_POST['excerpt'] ) ) { $_POST['excerpt'] = substr( $_POST['details'], 250 ); }
    if ( empty( $_POST['gender'] ) ) { $_POST['gender'] = "transgender"; }
    if ( empty( $_POST['level'] ) ) { $_POST['level'] = "public"; }
    if ( empty( $_POST['location'] ) ) { $_POST['location'] = "nairobi"; }
    if ( empty( $_POST['phone'] ) ) { $_POST['phone'] = "+254204404993"; }
    if ( empty( $_POST['social'] ) ) { $_POST['social'] = array( "facebook" => "https://www.facebook.com/","twitter" => "https://twitter.com/","instagram" => "https://instagram.com/","github" => "https://github.com/"); }
    if ( empty( $_POST['style'] ) ) { $_POST['style'] = "zahra"; }
    if ( empty( $_POST['status'] ) ) { $_POST['status'] = "active"; } 
    if ( empty( $_POST['type'] ) ) { $_POST['type'] = "subscriber"; } 
    if ( empty( $_POST['tags'] ) ) { $_POST['tags'] = ""; } 
    if ( empty( $_POST['password'] ) ) { $_POST['password'] = md5($_POST['title'].date("Y-m-d H:i:s")); } 
    if ( empty( $_POST['updated'] ) ) { $_POST['updated'] = date('Y-m-d H:i:s'); }

    if ( !empty( $_FILES['new_avatar'] ) ) {
      $upload = _ABSUP_.date('Y/m/d/').basetitle( $_FILES['new_avatar']['title'] );
      if ( file_exists( $upload) ) {
        $avatar = _UPLOADS.date('Y/m/d/').basetitle( $_FILES['new_avatar']['title'] )."_".date('H_m_s');
      } else {
        $avatar = _UPLOADS.date('Y/m/d/').basetitle( $_FILES['new_avatar']['title'] );
      }

      move_uploaded_file( $_FILES['new_avatar']["tmp_title"], $upload );
    } else {
      $avatar = $_POST['the_avatar'];
    }

    $GLOBALS['USERS'] -> authkey = $_POST['authkey'];
    $GLOBALS['USERS'] -> title = $_POST['title']; 
    $GLOBALS['USERS'] -> author = $_POST['author'];
    $GLOBALS['USERS'] -> author_name = $_POST['author_name'];
    $GLOBALS['USERS'] -> avatar = $avatar;
    $GLOBALS['USERS'] -> categories = strtolower( $_POST['categories'] );
    $created = $_POST['created_d'];
    $created_t = $_POST['created_t'];
    $GLOBALS['USERS'] -> created = $created.' '.$created_t;
    $GLOBALS['USERS'] -> company = $_POST['company'];
    $GLOBALS['USERS'] -> custom = $_POST['custom'];
    $GLOBALS['USERS'] -> details = $_POST['details'];
    $GLOBALS['USERS'] -> email = $_POST['email'];
    $GLOBALS['USERS'] -> excerpt = $_POST['excerpt'];
    $GLOBALS['USERS'] -> gender = strtolower( $_POST['gender'] );
    $GLOBALS['USERS'] -> level = $_POST['level'];
    $link = preg_replace('/\s+/', '', $_POST['title'] );
    $GLOBALS['USERS'] -> username = strtolower( $link );
    $GLOBALS['USERS'] -> link = _ROOT . '/users/' . $GLOBALS['USERS'] -> username ;
    $GLOBALS['USERS'] -> location = $_POST['location'];
    $GLOBALS['USERS'] -> phone = $_POST['phone'];  
    $GLOBALS['USERS'] -> status = $_POST['status'];
    $GLOBALS['USERS'] -> social = json_encode( $_POST['social'] );
    $GLOBALS['USERS'] -> style = $_POST['style'];  
    $GLOBALS['USERS'] -> type = strtolower( $_POST['type'] );
    $GLOBALS['USERS'] -> tags = strtolower( $_POST['tags'] );
    $GLOBALS['USERS'] -> updated = $_POST['updated'];
    $GLOBALS['USERS'] -> password = md5( $_POST['password'] );
    $create = $GLOBALS['USERS'] -> create();
    if ( isset( $create['error'] ) ) {
      _shout_( "Status: ".$create['status']."<br>Error: ".$create['error'], "error" );
    } else {
      _shout_( "Status: ".$create['status'] );
      header( "Location: ?edit=".$GLOBALS['JBLDB'] -> insertId() ."&key=".$_POST['type']);
      exit();
    }
}

if ( isset( $_POST['update'] ) ) {

    if ( empty( $_POST['authkey'] ) ) { $_POST['authkey'] = str_shuffle( generateCode() ); }
    if ( empty( $_POST['ftitle'] ) ) { $_POST['title'] = 'User Name'; } else { $_POST['title'] = $_POST['ftitle'].' '.$_POST['ltitle']; }
    if ( empty( $_POST['author'] ) ) { $_POST['author'] = '1'; }
    if ( empty( $_POST['author_name'] ) ) { $_POST['author_name'] = 'Undefined'; }
    if ( empty( $_POST['categories'] ) ) { $_POST['categories'] = "Uncategorized"; }
    if ( empty( $_POST['company'] ) ) { $_POST['company'] = "Jabali"; }
    if ( empty( $_POST['created_d'] ) ) { $_POST['created_d'] = date( "Y-m-d" ); }
    if ( empty( $_POST['created_t'] ) ) { $_POST['created_t'] = date( "H:i:s" ); }
    if ( empty( $_POST['custom'] ) ) { $_POST['custom'] = "{}"; }
    if ( empty( $_POST['details'] ) ) { $_POST['details'] = "User bio"; }
    if ( empty( $_POST['email'] ) ) { $_POST['email'] = "user@jabalicms.org"; }
    if ( empty( $_POST['excerpt'] ) ) { $_POST['excerpt'] = substr( $_POST['details'], 250 ); }
    if ( empty( $_POST['gender'] ) ) { $_POST['gender'] = "transgender"; }
    if ( empty( $_POST['level'] ) ) { $_POST['level'] = "public"; }
    if ( empty( $_POST['location'] ) ) { $_POST['location'] = "nairobi"; }
    if ( empty( $_POST['phone'] ) ) { $_POST['phone'] = "+254204404993"; }
    if ( empty( $_POST['social'] ) ) { $_POST['social'] = '{"facebook":"https://www.facebook.com/","twitter":"https://twitter.com/","instagram":"https://instagram.com/","github":"https://github.com/"}'; } else { $_POST['social'] = json_encode( $_POST['social']); }
    if ( empty( $_POST['style'] ) ) { $_POST['style'] = "zahra"; }
    if ( empty( $_POST['status'] ) ) { $_POST['status'] = "active"; } 
    if ( empty( $_POST['type'] ) ) { $_POST['type'] = "subscriber"; } 
    if ( empty( $_POST['tags'] ) ) { $_POST['type'] = ""; } 
    if ( empty( $_POST['newpassword'] ) ) { $_POST['password'] = $_POST['password']; } else { $_POST['password'] = md5($_POST['newpassword'] ); } 
    if ( empty( $_POST['updated'] ) ) { $_POST['updated'] = date('Y-m-d H:i:s'); }

    if ( !empty( $_FILES['new_avatar'] ) ) {
      $upload = _ABSUP_.date('Y/m/d/').basetitle( $_FILES['new_avatar']['title'] );
      if ( file_exists( $upload) ) {
        $avatar = _UPLOADS.date('Y/m/d/').basetitle( $_FILES['new_avatar']['title'] )."_".date('H_m_s');
      } else {
        $avatar = _UPLOADS.date('Y/m/d/').basetitle( $_FILES['new_avatar']['title'] );
      }

      move_uploaded_file( $_FILES['new_avatar']["tmp_title"], $upload );
    } else {
      $avatar = $_POST['the_avatar'];
    }

    // $fields = array( "authkey", "author", "author_name", "avatar", "categories", "company", "created", "custom", "details", "email","excerpt", "gender", "level", "link", "location", "title", "phone", "social", "status", "style", "type", "updated", "username", "password" );
    // foreach ($fields as $field ) {
    //     $GLOBALS['USERS'] -> $field = $_POST[$field];
    // }

    $GLOBALS['USERS'] -> authkey = $_POST['authkey'];
    $GLOBALS['USERS'] -> title = $_POST['title']; 
    $GLOBALS['USERS'] -> author = $_POST['author'];
    $GLOBALS['USERS'] -> author_name = $_POST['author_name'];
    $GLOBALS['USERS'] -> avatar = $avatar;
    $GLOBALS['USERS'] -> categories = $_POST['categories'];
    $created = $_POST['created_d'];
    $created_t = $_POST['created_t'];
    $GLOBALS['USERS'] -> created = $created.' '.$created_t;
    $GLOBALS['USERS'] -> company = $_POST['company'];
    $GLOBALS['USERS'] -> custom = $_POST['custom'];
    $GLOBALS['USERS'] -> details = $_POST['details'];
    $GLOBALS['USERS'] -> email = $_POST['email'];
    $GLOBALS['USERS'] -> id = $_POST['id'];
    $GLOBALS['USERS'] -> excerpt = $_POST['excerpt'];
    $GLOBALS['USERS'] -> gender = strtolower( $_POST['gender'] );
    $GLOBALS['USERS'] -> level = $_POST['level'];
    $GLOBALS['USERS'] -> username = $_POST['username'];
    $GLOBALS['USERS'] -> link = _ROOT . '/users/' . $GLOBALS['USERS'] -> username ;
    $GLOBALS['USERS'] -> location = $_POST['location'];
    $GLOBALS['USERS'] -> phone = $_POST['phone'];  
    $GLOBALS['USERS'] -> status = $_POST['status'];
    $GLOBALS['USERS'] -> social = $_POST['social'];
    $GLOBALS['USERS'] -> style = $_POST['style'];  
    $GLOBALS['USERS'] -> type = strtolower( $_POST['type'] );
    $GLOBALS['USERS'] -> tags = strtolower( $_POST['tags'] );
    $GLOBALS['USERS'] -> updated = $_POST['updated'];
    $GLOBALS['USERS'] -> password = $_POST['password'];
    $update = $GLOBALS['USERS'] -> update();
    if ( isset( $update['error'] ) ) {
      _shout_( "Status: ".$update['status']."<br>Error: ".$update['error'], "error" );
    } else {
      _shout_( "Status: ".$update['status'], "success" );
    }
}

require_once( 'header.php' );
showTitle('users'); ?>
<div class="mdl-grid"><?php

$collumns = array( 'id','username', 'title', 'email', 'phone', 'location', 'created', 'actions');
$fields = array( 'id','username', 'title', 'email', 'phone', 'location', 'created');
$rows = array( 'id','username', 'title', 'email', 'phone', 'location', 'created');
$actions = array( 'edit' => ['id'], 'profile' => ['id'] );

if ( isset( $_GET['create'] ) ) {
	renderView('forms/user' );
} elseif ( isset( $_GET['edit'] ) ) {
	renderView('forms/edit-user', $_GET['edit'] );
} elseif ( isset( $_GET['author'] ) ) {
    tableHeader( $collumns );
    tableBody( $GLOBALS['USERS']-> getAuthor( $_GET['author'] ), $fields, $rows, "No Users Found", $actions );
    if ( isCap( 'admin' ) ) {
        newButton('users', 'subscriber', 'create' );
    }
} elseif ( isset( $_GET['view'] )){
    renderView( 'users/profile', $_GET['view'] );
} elseif ( isset( $_GET['profile'] ) ) {
    renderView( 'users/profile', $_GET['profile'] );
} elseif ( isset( $_GET['type'] ) ) {
    tableHeader( $collumns );
    tableBody( $GLOBALS['USERS']-> getTypes( $_GET['type'] ), $fields, $rows, "No ".ucwords( $_GET['type'] )."s Found", $actions );
    tableFooter();
    if ( isCap( 'admin' ) ) {
        newButton('users', $_GET['type'], 'create' );
    }
} elseif ( isset( $_GET['location'] ) ) { ?>
    <title>Users In <?php echo( ucwords( $_GET['location'] ) ); ?>s - <?php showOption( 'title' ); ?></title><?php
    tableHeader( $collumns );
    tableBody( $GLOBALS['USERS']-> getCity( $_GET['location'] ), $fields, $rows, "No Users Found", $actions );
    tableFooter();
    if ( isCap( 'admin' ) ) {
        newButton('users', 'subscriber', 'create' );
    }
} elseif ( isset( $_GET['status'] ) ) {
    tableHeader( $collumns );
    tableBody( $GLOBALS['USERS']-> getStatus( $_GET['status'] ), $fields, $rows, "No ".ucwords($_GET['status'])." Users Found", $actions );
    tableFooter();
    if ( isCap( 'admin' ) ) {
        newButton('users', 'subscriber', 'create' );
    }
} ?></div><?php
require_once( 'footer.php' );