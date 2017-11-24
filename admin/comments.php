<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Admin Comments
* @author Mauko Maunde
* @since 0.17.04
* @link https://docs.jabalicms.org/comments/
**/
session_start();
require_once( '../init.php' );
require_once( '../load.php' );

if ( isset( $_POST['create'] ) ) {

    if ( empty( $_POST['name'] ) ) { $_POST['name'] = 'name'; }
    if ( empty( $_POST['author'] ) ) { $_POST['author'] = $_SESSION[JBLSALT.'Code']; }
    if ( empty( $_POST['author_name'] ) ) { $_POST['author_name'] = $_SESSION[JBLSALT.'Name']; }
    if ( empty( $_POST['created_d'] ) ) { $_POST['created_d'] = date( "Y-m-d" ); }
    if ( empty( $_POST['created_t'] ) ) { $_POST['created_t'] = date( "H:i:s" ); }
    if ( empty( $_POST['details'] ) ) { $_POST['details'] = "Comment details"; }
    if ( empty( $_POST['email'] ) ) { $_POST['email'] = $_SESSION[JBLSALT.'Email']; }
    if ( empty( $_POST['authkey'] ) ) { $_POST['authkey'] = str_shuffle( generateCode() ); }
    if ( empty( $_POST['level'] ) ) { $_POST['level'] = "public"; }
    if ( empty( $_POST['phone'] ) ) { $_POST['email'] = $_SESSION[JBLSALT.'Phone']; }
    if ( empty( $_POST['status'] ) ) { $_POST['status'] = "unread"; }
    if ( empty( $_POST['receipient'] ) ) { $_POST['receipient'] = 1; }
    if ( empty( $_POST['type'] ) ) { $_POST['type'] = "comment"; }


     // $fields = array( "name", "author", "author_name", "id", "created", "details", "email", "receipient", "authkey", "level", "phone", "status", "type" );
    // foreach ($fields as $field ) {
    //     $GLOBALS['COMMENTS'] -> $field = $_POST[$field];
    // }

    $GLOBALS['COMMENTS'] -> name = $_POST['name'];
    $GLOBALS['COMMENTS'] -> author = $_POST['author'];
    $GLOBALS['COMMENTS'] -> author_name = $_POST['author_name'];
    $created = $_POST['created_d'];
    $created_t = $_POST['created_t'];
    $GLOBALS['COMMENTS'] -> created = $created.' '.$created_t;
    $GLOBALS['COMMENTS'] -> details = $_POST['details'];
    $GLOBALS['COMMENTS'] -> email = $_POST['email'];
    $GLOBALS['COMMENTS'] -> authkey = $_POST['authkey'];
    $GLOBALS['COMMENTS'] -> level = $_POST['level'];
    $GLOBALS['COMMENTS'] -> phone = $_POST['phone'];
    $GLOBALS['COMMENTS'] -> status = $_POST['status'];
    $GLOBALS['COMMENTS'] -> type = $_POST['type'];
    $GLOBALS['COMMENTS'] -> receipient = $_POST['receipient'];
    $create = $GLOBALS['COMMENTS'] -> create();
    if ( isset( $create['error'] ) ) {
      _shout_( "Status: ".$create['status']."<br>Error: ".$create['error'], "error" );
    } else {
      _shout_( "Status: ".$create['status'] );
      header( "Location: ?edit=".$GLOBALS['JBLDB'] -> insertId() ."&key=".$_POST['type']);
      exit();
    }

  }

require_once( 'header.php' );
showTitle('comments'); ?>

<div class="mdl-grid"><?php

$collumns = array( 'id', 'author', 'categories', 'tags', 'created', 'actions');
$fields = array( 'id', 'author_name', 'categories', 'tags', 'created' );
$rows = array( 'id', 'author', 'categories', 'tags', 'created' );
$actions = array( 'reply' => ['id'], 'view' => ['id'] );


if ( isset( $_GET['create'] ) ) {
	renderView('forms/comment');
}

if ( isset( $_GET['view'] ) ){
  renderView( 'comments/single', $_GET['view'] );
} elseif ( isset( $_GET['type'] ) ) {
  tableHeader( $collumns );
  tableBody( $GLOBALS['COMMENTS']-> getTypes( $_GET['type'] ), $fields, $rows, "No ".ucwords( $_GET['type'] )."s Found", $actions );
  tableFooter();
  if ( isCap( 'admin' ) ) {
    newButton('comments', $_GET['type'], 'create' );
  }
} elseif ( isset( $_GET['status'] ) ) {
  tableHeader( $collumns );
  tableBody( $GLOBALS['COMMENTS']-> getState( $_GET['status'] ), $fields, $rows, "No ".ucwords( $_GET['status'] )." Comments Found", $actions );
  tableFooter();
  if ( isCap( 'admin' ) ) {
    newButton('comments', 'comment', 'create' );
  }
} ?>
</div><?php
require_once( 'footer.php' );
