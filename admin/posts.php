<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Admin Posts
* @author Mauko Maunde
* @since 0.17.04
* @link https://docs.jabalicms.org/posts/
**/
session_start();
require_once( '../init.php' );
require_once( '../load.php' );

if ( isset( $_POST['create'] ) ) {

    if ( empty( $_POST['name'] ) ) { $_POST['name'] = 'name'; }
    if ( empty( $_POST['author'] ) ) { $_POST['author'] = '1'; }
    if ( empty( $_POST['author_name'] ) ) { $_POST['author_name'] = 'Undefined'; }
    if ( empty( $_POST['categories'] ) ) { $_POST['categories'] = "Uncategorized"; }
    if ( empty( $_POST['created_d'] ) ) { $_POST['created_d'] = date( "Y-m-d" ); }
    if ( empty( $_POST['created_t'] ) ) { $_POST['created_t'] = date( "H:i:s" ); }
    if ( empty( $_POST['details'] ) ) { $_POST['details'] = "Post details"; }
    $_POST['gallery'] = "none";
    if ( empty( $_POST['authkey'] ) ) { $_POST['authkey'] = str_shuffle( generateCode() ); }
    if ( empty( $_POST['level'] ) ) { $_POST['level'] = "public"; }
    $_POST['excerpt'] = substr( $_POST['details'], 250 );
    if ( empty( $_POST['readings'] ) ) { $_POST['readings'] = "none"; }
    if ( empty( $_POST['status'] ) ) { $_POST['status'] = "published"; }
    if ( empty( $_POST['subtitle'] ) ) { $_POST['subtitle'] = 'undefined'; }
    if ( empty( $_POST['tags'] ) ) { $_POST['tags'] = "none"; }
    if ( empty( $_POST['template'] ) ) { $_POST['template'] = "post"; }
    if ( empty( $_POST['type'] ) ) { $_POST['type'] = "article"; }
    if ( empty( $_POST['updated'] ) ) { $_POST['updated'] = date('Y-m-d H:i:s'); }

    if ( empty( $_FILES['new_avatar'] ) ) {
      $uploaddir = _ABSUP_.date('Y/m/d/');

      $upload = _UPLOADS.date('Y/m/d/').basename( $_FILES['new_avatar']['name'] );
      if ( file_exists( $upload) ) {
        $new_avatar = _UPLOADS.date('Y/m/d/').basename( $_FILES['new_avatar']['name'] )."_".date('H_m_s');
      } else {
        $new_avatar = _UPLOADS.date('Y/m/d/').basename( $_FILES['new_avatar']['name'] );
      }

      move_uploaded_file( $_FILES['new_avatar']["tmp_name"], $uploaddir);

      $avatar = _UPLOADS.date('Y/m/d/').$new_avatar;
    } else {
      $avatar = $_POST['the_avatar'];
    }

     // $fields = array( "name", "author", "author_name", "avatar", "categories", "created", "details", "gallery", "authkey", "level", "link", "excerpt", "readings", "status", "subtitle", "slug", "tags", "updated", "template", "type" );
    // foreach ($fields as $field ) {
    //     $GLOBALS['USERS'] -> $field = $_POST[$field];
    // }

    $GLOBALS['POSTS'] -> name = htmlspecialchars($_POST['name']);
    $GLOBALS['POSTS'] -> author = $_POST['author'];
    $GLOBALS['POSTS'] -> author_name = $_POST['author_name'];
    $GLOBALS['POSTS'] -> avatar = $avatar;
    $GLOBALS['POSTS'] -> categories = strtolower( $_POST['categories'] );
    $created = $_POST['created_d'];
    $created_t = $_POST['created_t'];
    $GLOBALS['POSTS'] -> created = $created.' '.$created_t;
    $GLOBALS['POSTS'] -> details = htmlentities($_POST['details']);
    $GLOBALS['POSTS'] -> gallery = $_POST['gallery'];
    $GLOBALS['POSTS'] -> authkey = $_POST['authkey'];
    $GLOBALS['POSTS'] -> level = $_POST['level'];
    $link = preg_replace('/\s+/', '-', $_POST['name'] );
    $GLOBALS['POSTS'] -> slug = strtolower( $link );
    $GLOBALS['POSTS'] -> link = _ROOT . '/' . $GLOBALS['POSTS'] -> slug ;
    $GLOBALS['POSTS'] -> excerpt = htmlentities($_POST['excerpt']);
    $GLOBALS['POSTS'] -> readings = $_POST['readings'];
    $GLOBALS['POSTS'] -> status = $_POST['status'];
    $GLOBALS['POSTS'] -> subtitle = $_POST['subtitle'];
    $GLOBALS['POSTS'] -> tags = strtolower( $_POST['tags'] );
    $GLOBALS['POSTS'] -> template = strtolower( $_POST['template'] );
    $GLOBALS['POSTS'] -> type = $_POST['type'];
    $GLOBALS['POSTS'] -> updated = $_POST['updated'];
    $create = $GLOBALS['POSTS'] -> create();
    if ( isset( $create['error'] ) ) {
      _shout_( "Status: ".$create['status']."<br>Error: ".$create['error'], "error" );
    } else {
      _shout_( "Status: ".$create['status'] );
      header( "Location: ?edit=".$GLOBALS['JBLDB'] -> insertId() ."&key=".$_POST['type']);
      exit();
    }

  } elseif ( isset( $_POST['update'] ) ) {

    if ( empty( $_POST['name'] ) ) { $_POST['name'] = 'name'; }
    if ( empty( $_POST['author'] ) ) { $_POST['author'] = '1'; }
    if ( empty( $_POST['author_name'] ) ) { $_POST['author_name'] = 'Undefined'; }
    if ( empty( $_POST['category'] ) ) { $_POST['category'] = "Uncategorized"; }
    if ( empty( $_POST['created_d'] ) ) { $_POST['created_d'] = date( "Y-m-d" ); }
    if ( empty( $_POST['created_t'] ) ) { $_POST['created_t'] = date( "H:i:s" ); }
    if ( empty( $_POST['details'] ) ) { $_POST['details'] = "Post details"; }
    $_POST['gallery'] = "none";
    $_POST['id'] = $_POST['id'];
    if ( empty( $_POST['authkey'] ) ) { $_POST['authkey'] = str_shuffle( generateCode() ); }
    if ( empty( $_POST['level'] ) ) { $_POST['level'] = "public"; }
    if ( empty( $_POST['excerpt'] ) ) { $_POST['excerpt'] = substr( $_POST['details'], 250 ); }
    if ( empty( $_POST['readings'] ) ) { $_POST['readings'] = "none"; }
    if ( empty( $_POST['status'] ) ) { $_POST['status'] = "published"; }
    if ( empty( $_POST['subtitle'] ) ) { $_POST['subtitle'] = 'undefined'; }
    if ( empty( $_POST['tags'] ) ) { $_POST['tags'] = "none"; }
    if ( empty( $_POST['template'] ) ) { $_POST['template'] = "post"; }
    if ( empty( $_POST['type'] ) ) { $_POST['type'] = "article"; }
    if ( empty( $_POST['updated'] ) ) { $_POST['updated'] = date('Y-m-d H:i:s'); }

    if ( empty( $_FILES['new_avatar'] ) ) {
      $uploaddir = _ABSUP_.date('Y/m/d/');

      $upload = _UPLOADS.date('Y/m/d/').basename( $_FILES['new_avatar']['name'] );
      if ( file_exists( $upload) ) {
        $new_avatar = _UPLOADS.date('Y/m/d/').basename( $_FILES['new_avatar']['name'] )."_".date('H_m_s');
      } else {
        $new_avatar = _UPLOADS.date('Y/m/d/').basename( $_FILES['new_avatar']['name'] );
      }

      move_uploaded_file( $_FILES['new_avatar']["tmp_name"], $uploaddir);

      $avatar = _UPLOADS.date('Y/m/d/').$new_avatar;
    } else {
      $avatar = $_POST['the_avatar'];
    }

    $GLOBALS['POSTS'] -> id = $_POST['id'];
    $GLOBALS['POSTS'] -> name = $_POST['name'];
    $GLOBALS['POSTS'] -> author = $_POST['author'];
    $GLOBALS['POSTS'] -> author_name = $_POST['author_name'];
    $GLOBALS['POSTS'] -> avatar = $avatar;
    $GLOBALS['POSTS'] -> categories = $_POST['categories'];
    $created = $_POST['created_d'];
    $created_t = $_POST['created_t'];
    $GLOBALS['POSTS'] -> created = $created.' '.$created_t;
    $GLOBALS['POSTS'] -> details = htmlentities( $_POST['details'] );
    $GLOBALS['POSTS'] -> gallery = $_POST['gallery'];
    $GLOBALS['POSTS'] -> authkey = $_POST['authkey'];
    $GLOBALS['POSTS'] -> level = $_POST['level'];
    $link = preg_replace('/\s+/', '-', $_POST['name'] );
    $GLOBALS['POSTS'] -> slug = strtolower( $link );
    $GLOBALS['POSTS'] -> link = _ROOT . '/' . $GLOBALS['POSTS'] -> slug ;
    $GLOBALS['POSTS'] -> excerpt = htmlentities( $_POST['excerpt'] );
    $GLOBALS['POSTS'] -> readings = $_POST['readings'];
    $GLOBALS['POSTS'] -> status = $_POST['status'];
    $GLOBALS['POSTS'] -> subtitle = $_POST['subtitle'];
    $GLOBALS['POSTS'] -> tags = $_POST['tags'];
    $GLOBALS['POSTS'] -> template = strtolower( $_POST['template'] );
    $GLOBALS['POSTS'] -> type = $_POST['type'];
    $GLOBALS['POSTS'] -> updated = $_POST['updated'];
    $update = $GLOBALS['POSTS'] -> update();
    if ( isset( $update['error'] ) ) {
      _shout_( "Status: ".$update['status']."<br>Error: ".$update['error'], "error" );
    } else {
      _shout_( "Status: ".$update['status'], "success" );
    }
  } elseif ( isset( $_POST['delete'] )) {
    $delete = $GLOBALS['POSTS'] -> delete( $_POST['delete'] );
    if ( $delete['status'] == "success" ) {
      _shout_( 'Post Deleted Successfully', 'success');
    } else {
      _shout_( 'Could Not Delete Post', 'error' );
    }
  }

require_once( 'header.php' );
showTitle('posts'); ?>

<div class="mdl-grid"><?php

$collumns = array( 'id', 'title', 'author', 'categories', 'tags', 'published', 'actions');
$fields = array( 'id', 'name', 'author_name', 'categories', 'tags', 'created' );
$rows = array( 'id', 'name', 'author', 'categories', 'tags', 'created' );
$actions = array( 'edit' => ['id'], 'view' => ['id'], 'copy' => ['id'] );


if ( isset( $_GET['create'] ) ) {
	renderView('forms/post');
}

if ( isset( $_GET['edit'] ) ) {
  renderView('forms/edit-post', $_GET['edit'] );
}

if ( isset( $_GET['copy'] ) ) {
  renderView('forms/copy-post', $_GET['copy'] );
}

if ( isset( $_GET['view'] ) ){
  renderView( 'posts/single', $_GET['view'] );
} elseif ( isset( $_GET['type'] ) ) {
  tableHeader( $collumns );
  tableBody( $GLOBALS['POSTS']-> getTypes( $_GET['type'] ), $fields, $rows, "No ".ucwords( $_GET['type'] )."s Found", $actions );
  tableFooter();
  if ( isCap( 'admin' ) ) {
    newButton('posts', $_GET['type'], 'create' );
  }
} elseif ( isset( $_GET['status'] ) ) {
  tableHeader( $collumns );
  tableBody( $GLOBALS['POSTS']-> getState( $_GET['status'] ), $fields, $rows, "No ".ucwords( $_GET['status'] )." Posts Found", $actions );
  tableFooter();
  if ( isCap( 'admin' ) ) {
    newButton('posts', 'article', 'create' );
  }
} ?>
</div><?php
require_once( 'footer.php' );
