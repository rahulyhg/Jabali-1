<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Admin Messages
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.04
* @link https://docs.jabalicms.org/messages/
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
    if ( empty( $_POST['details'] ) ) { $_POST['details'] = "Message details"; }
    if ( empty( $_POST['email'] ) ) { $_POST['email'] = $_SESSION[JBLSALT.'Email']; }
    if ( empty( $_POST['authkey'] ) ) { $_POST['authkey'] = str_shuffle( generateCode() ); }
    if ( empty( $_POST['level'] ) ) { $_POST['level'] = "public"; }
    if ( empty( $_POST['phone'] ) ) { $_POST['email'] = $_SESSION[JBLSALT.'Phone']; }
    if ( empty( $_POST['status'] ) ) { $_POST['status'] = "unread"; }
    if ( empty( $_POST['receipient'] ) ) { $_POST['receipient'] = 1; }
    if ( empty( $_POST['type'] ) ) { $_POST['type'] = "message"; }


     // $fields = array( "name", "author", "author_name", "id", "created", "details", "email", "receipient", "authkey", "level", "phone", "status", "type" );
    // foreach ($fields as $field ) {
    //     $GLOBALS['MESSAGES'] -> $field = $_POST[$field];
    // }

    $GLOBALS['MESSAGES'] -> name = $_POST['name'];
    $GLOBALS['MESSAGES'] -> author = $_POST['author'];
    $GLOBALS['MESSAGES'] -> author_name = $_POST['author_name'];
    $created = $_POST['created_d'];
    $created_t = $_POST['created_t'];
    $GLOBALS['MESSAGES'] -> created = $created.' '.$created_t;
    $GLOBALS['MESSAGES'] -> details = $_POST['details'];
    $GLOBALS['MESSAGES'] -> email = $_POST['email'];
    $GLOBALS['MESSAGES'] -> authkey = $_POST['authkey'];
    $GLOBALS['MESSAGES'] -> level = $_POST['level'];
    $GLOBALS['MESSAGES'] -> phone = $_POST['phone'];
    $GLOBALS['MESSAGES'] -> status = $_POST['status'];
    $GLOBALS['MESSAGES'] -> type = $_POST['type'];
    $GLOBALS['MESSAGES'] -> receipient = $_POST['receipient'];
    $create = $GLOBALS['MESSAGES'] -> create();
    if ( isset( $create['error'] ) ) {
      _shout_( "Status: ".$create['status']."<br>Error: ".$create['error'], "error" );
    } else {
      _shout_( "Status: ".$create['status'] );
      header( "Location: ?edit=".$GLOBALS['JBLDB'] -> insertId() ."&key=".$_POST['type']);
      exit();
    }

  }

require_once( 'header.php' );
showTitle('messages'); ?>

<div class="mdl-grid"><?php

$collumns = array( 'id', 'author', 'message', 'sent on', 'actions');
$fields = array( 'id', 'author_name', 'name', 'created' );
$rows = array( 'id', 'author', 'details', 'created' );
$actions = array( 'reply' => ['id'], 'view' => ['id'] );


if ( isset( $_GET['create'] ) ) {
	renderView('forms/message');
}

if ( isset( $_GET['view'] ) ){
  renderView( 'messages/single', $_GET['view'] );
} elseif ( isset( $_GET['type'] ) ) {
  tableHeader( $collumns );
  tableBody( $GLOBALS['MESSAGES']-> getTypes( $_GET['type'] ), $fields, $rows, "No ".ucwords( $_GET['type'] )."s Found", $actions );
  tableFooter();
  if ( isCap( 'admin' ) ) {
    newButton('messages', $_GET['type'], 'create' );
  }
} elseif ( isset( $_GET['status'] ) ) {
  tableHeader( $collumns );
  tableBody( $GLOBALS['MESSAGES']-> getStatus( $_GET['status'], $_SESSION[JBLSALT.'Code'] ), $fields, $rows, "No ".ucwords( $_GET['status'] )." Messages Found", $actions );
  tableFooter();
  if ( isCap( 'admin' ) ) {
    newButton('messages', 'message', 'create' );
  }
} ?>
</div><?php
require_once( 'footer.php' );
