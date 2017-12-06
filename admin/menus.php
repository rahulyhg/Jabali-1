<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Menu Settings
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.09
* @link https://docs.jabalicms.org/menus/
**/

session_start();
require_once( '../init.php' );
require_once( '../load.php' );
require_once( 'header.php' );

if ( isset( $_POST['create'] ) ) {
  if ( isset( $name ) || isset( $author ) || isset( $avatar ) || isset( $id ) || isset( $for ) || isset( $link ) || isset( $location ) || isset( $status ) || isset( $type ) ) {

     $name = $GLOBALS['JBLDB'] -> clean( $_POST['name'] );
     $author = $GLOBALS['JBLDB'] -> clean( $_POST['author'] );
     $avatar = $GLOBALS['JBLDB'] -> clean( $_POST['avatar'] );
     $id = strtolower( str_replace(' ', '', $name ) );
     if ( empty( $_POST['type'] ) ) {
     $type = "nil";
     } else {
         $type = $GLOBALS['JBLDB'] -> clean( $_POST['type'] );
     }
     $for = $GLOBALS['JBLDB'] -> clean( $_POST['for'] );
     $for = strtolower( str_replace(' ', '', $for ) );
     $link = $GLOBALS['JBLDB'] -> clean( $_POST['link'] );
     $location = $GLOBALS['JBLDB'] -> clean( $_POST['location'] );
     $location = strtolower( $location );
     $status = $_POST['status'];

     $GLOBALS['MENUS'] -> create ( $name, $author, $avatar, $id, $for, $link, $location, $status, $type );
  }
}

if ( isset( $_POST['update'] ) ) {
     $name = $GLOBALS['JBLDB'] -> clean( $_POST['name'] );
     $author = $GLOBALS['JBLDB'] -> clean( $_POST['author'] );
     $avatar = $GLOBALS['JBLDB'] -> clean( $_POST['avatar'] );
     $id = strtolower( str_replace(' ', '', $name ) );
     if ( empty( $_POST['type'] ) ) {
        $type = "item";
     } else {
        $type = $GLOBALS['JBLDB'] -> clean( $_POST['type'] );
     }
     $for = $GLOBALS['JBLDB'] -> clean( $_POST['parent'] );
     $for = strtolower( str_replace(' ', '', $for ) );
     $link = $GLOBALS['JBLDB'] -> clean( $_POST['link'] );
     $location = $GLOBALS['JBLDB'] -> clean( $_POST['location'] );
     $location = strtolower( $location );
     $status = $_POST['status'];

     $GLOBALS['MENUS'] -> update ( $name, $author, $avatar, $id, $for, $link, $location, $status, $type );
} ?>
<div class="mdl-grid">
<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp <?php primaryColor(); ?>"><?php
if (isset( $_GET['add'] )) { ?>
          <title>Add New Menu - <?php showOption( 'name' ); ?></title>
         <div class="mdl-card__supporting-text">
           <form class="" action="?add<?php if ( !empty( $_GET['add'] )) {
                echo "=".$_GET['add'];
              } ?>" method="POST" >
             <div class="input-field">
               <i class="material-icons prefix">label</i>
             <input id="name" name="name" type="text">
             <label for="by">Label</label>
             </div>

            <div class="input-field">
              <i class="material-icons prefix">link</i>
            <input id="link" name="link" type="text" value="">
            <label for="link">Link</label>
            </div>

             <?php $GLOBALS['MENUS'] -> materialIcons( '' ); ?>

             <input type="hidden" name="author" value="<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>">

             <div class="input-field inline mdl-js-textfield getmdl-select">
               <i class="material-icons prefix">room</i>
              <input class="mdl-textfield__input" id="location" name="location" type="text" tabIndex="-1" placeholder="<?php echo( 'Location' ); ?>" value="<?php if ( !empty( $_GET['add'] )) {
                echo ucwords( $_GET['add'] );
              } else {  } ?>" >
                <ul class="mdl-menu mdl-menu--top-left mdl-js-menu <?php primaryColor(); ?>" for="location">
                  <li class="mdl-menu__item" data-val="drawer">Drawer</li>
                  <li class="mdl-menu__item" data-val="header">Header</li>
                  <li class="mdl-menu__item" data-val="main">Main</li>
                  <li class="mdl-menu__item" data-val="footer">Footer</li>
                </ul>
             </div>

              <div class="input-field inline mdl-js-textfield mdl-textfield--floating-label getmdl-select">
               <i class="material-icons prefix">label_outline</i>
              <input class="mdl-textfield__input" id="for" name="for" type="text" readonly tabIndex="-1"  placeholder="For..." >
                <ul class="mdl-menu mdl-menu--top-left mdl-js-menu <?php primaryColor(); ?>" for="for" style="max-height: 300px !important; overflow-y: auto;"><?php
               $getMenu = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."menus WHERE type = 'drop'");
               if ( $GLOBALS['JBLDB'] -> numRows( $getMenu ) > 0 ) {
                    while ($menu = $GLOBALS['JBLDB'] -> fetchAssoc( $getMenu )) {
                         echo '<li class="mdl-menu__item" data-val="'.$menu['name'].'">'.ucwords( $menu['name'] ).'</i></li>'; 
                    }
               } ?>
                </ul>
                </div><br>
                <div class="mdl-grid">

                <div class="mdl-cell">
                  <input type="checkbox" id="type" name="type" value="drop" >
                  <label for="type">Has Dropdown</label>
                </div>

                <div class="mdl-cell">
                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2">
                  <input type="checkbox" id="switch-2" class="mdl-switch__input" name="status" value="checked"> <span style="padding-left: 20px;">Visible</span>         
                </label>
                </div>

               <div class="input-field mdl-cell alignright">
                 <button class="mdl-button mdl-button--fab alignright" type="submit" name="create"><i class="material-icons">save</i></button>
               </div>
                </div><br>
           </form>
         </div><?php 
} elseif ( isset( $_GET['edit'] ) ) { 
          $getMenu = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."menus WHERE code = '".$_GET['edit']."'");
           if ( $GLOBALS['JBLDB'] -> numRows( $getMenu ) > 0 ) {
                while ($menus = $GLOBALS['JBLDB'] -> fetchAssoc( $getMenu )) {
                     $menu[] = $menus; 
                }
           } ?>
     <title>Edit Menu - <?php showOption( 'name' ); ?></title>
        <div class="mdl-card__menu mdl-button mdl-button--icon">
          <a href="?delete=<?php echo( $menu[0]['id'] ); ?>">
               <i class="material-icons">delete</i>
          </a>
        </div>
    <div class="mdl-card__supporting-text">
      <form class="" action="" method="POST" >
        <div class="input-field">
          <label for="name">Menu Label</label>
          <i class="material-icons prefix">label</i>
        <input id="name" name="name" type="text" value="<?php echo( $menu[0]['name'] ); ?>">
        </div>

        <div class="input-field">
          <label for="link">Link</label>
          <i class="material-icons prefix">link</i>
        <input id="link" name="link" type="text" value="<?php echo( $menu[0]['link'] ); ?>">
        </div><?php

        $GLOBALS['MENUS'] -> materialIcons( $menu[0]['avatar'] ); ?>

        <div class="input-field inline mdl-js-textfield getmdl-select">
          <label for="location">Location</label>
          <i class="material-icons prefix">room</i>
         <input class="mdl-textfield__input" id="location" name="location" type="text" tabIndex="-1" value="<?php echo( ucwords( $menu[0]['location'] ) ); ?>">
           <ul class="mdl-menu mdl-menu--top-left mdl-js-menu <?php primaryColor(); ?>" for="location">
             <li class="mdl-menu__item" data-val="drawer">Drawer</li>
             <li class="mdl-menu__item" data-val="header">Header</li>
             <li class="mdl-menu__item" data-val="main">Main</li>
             <li class="mdl-menu__item" data-val="footer">Footer</li>
           </ul>
        </div>

         <div class="input-field inline mdl-js-textfield mdl-textfield--floating-label getmdl-select">
          <label for="for">Parent</label>
          <i class="material-icons prefix">label_outline</i>
         <input class="mdl-textfield__input" id="for" name="parent" type="text" readonly tabIndex="-1"  value="<?php echo( ucwords( $menu[0]['parent'] ) ); ?>" >
           <ul class="mdl-menu mdl-menu--top-left mdl-js-menu <?php primaryColor(); ?>" for="for" style="max-height: 300px !important; overflow-y: auto;"><?php
          $getMenu = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."menus WHERE type = 'drop'");
          if ( $GLOBALS['JBLDB'] -> numRows( $getMenu ) > 0 ) {
               while ($tmenu = $GLOBALS['JBLDB'] -> fetchAssoc( $getMenu )) {
                    echo '<li class="mdl-menu__item" data-val="'.$tmenu['name'].'">'.ucwords( $tmenu['name'] ).'</i></li>'; 
               }
          } ?>
           </ul>
        </div><br>
        <div class="mdl-grid">

        <div class="mdl-cell">
          <input type="checkbox" id="type" name="type" value="drop" <?php if ( $menu[0]['type'] == "drop" ) {
               echo( 'checked' );
          } ?>>
          <label for="type">Has Dropdown</label>
        </div>

        <div class="mdl-cell">
        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="state">
          <input type="checkbox" id="state" class="mdl-switch__input" <?php if ( $menu[0]['status'] == "checked" ) { echo( 'checked' ); } ?> name="status" value="checked">
          <span style="padding-left: 20px;">
            Visible
          </span>         
        </label>
        </div>
        <input type="hidden" name="status" value="<?php echo( strtolower( $menu[0]['status'] ) ); ?>">
        <input type="hidden" name="author" value="<?php echo( strtolower( $menu[0]['author'] ) ); ?>">
        <?php csrf(); ?>

        <div class="input-field mdl-cell alignright">
          <button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="update"><i class="material-icons">save</i></button>
        </div>
        </div><br>
      </form>
    </div><?php 
} elseif ( isset( $_GET['delete'] ) ) {
     $GLOBALS['MENUS'] -> delete( $_GET['delete'] ); ?>
     <center>
        <h3>The Menu has been deleted</h3>
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--6-col-desktop" >
            <a class="mdl-button mdl-button--fab" href="./menus"><i class="material-icons">arrow_back</i></a>
        <h6>Back To Menus</h6>
          </div>
          <div class="mdl-cell mdl-cell--6-col-desktop" >
            <a class="mdl-button mdl-button--fab" href="./menus?add"><i class="material-icons">create</i></a>
        <h6>Add New Menu</h6>
          </div>
        </div>
      </center><?php
} else { ?>
    <title>Menus - <?php showOption( 'name' ); ?></title>
    <div class="mdl-card__supporting-text">
        <ul id="tabs-swipe-demo" style="border-radius: 5px;" class="tabs mdl-card__title mdl-card--expand">
          <li class="tab col s3"><a class="active" href="#drawer">drawer</a></li>
          <li class="tab col s3"><a href="#header">header</a></li>
          <li class="tab col s3"><a href="#main">main</a></li>
          <li class="tab col s3"><a href="#footer">footer</a></li>
        </ul>
        <div id="drawer" class="mdl-tabs vertical-mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
            <div class="mdl-grid mdl-card">
            <div class="mdl-cell mdl-cell--3-col <?php primaryColor(); ?>">
                <div class="mdl-tabs__tab-bar ">

                     <a href="#dashboard" class="mdl-tabs__tab is-active">Dashboard
                     </a>
                     <a href="#posts" class="mdl-tabs__tab">Posts
                      </a>
                     <a href="#resources" class="mdl-tabs__tab">Resources
                      </a>
                  <a href="#users" class="mdl-tabs__tab">Users
                  </a>
                  <a href="#messages" class="mdl-tabs__tab">Messages
                  </a>
                  <a href="#comments" class="mdl-tabs__tab">Comments
                  </a>
                  <a href="#udef" class="mdl-tabs__tab">User Defined
                  </a>
                </div>
           </div>
           <div class="mdl-cell mdl-cell--9-col <?php primaryColor(); ?>">
                <div class="mdl-tabs__panel is-active" id="dashboard"><?php
                    $GLOBALS['MENUS'] -> theMenu( 'dashboard' );
                    $GLOBALS['MENUS'] -> subMenu( 'dashboard' ); ?>
                </div>
                <div class="mdl-tabs__panel" id="posts"><?php
                    $GLOBALS['MENUS'] -> theMenu( 'posts' );
                    $GLOBALS['MENUS'] -> subMenu( 'posts' ); ?>
                </div>

                <div class="mdl-tabs__panel" id="resources"><?php
                    $GLOBALS['MENUS'] -> theMenu( 'resources' );
                    $GLOBALS['MENUS'] -> subMenu( 'resources' ); ?>
                </div>

                <div class="mdl-tabs__panel" id="users"><?php
                    $GLOBALS['MENUS'] -> theMenu( 'users' );
                    $GLOBALS['MENUS'] -> subMenu( 'users' ); ?>
                </div>

                <div class="mdl-tabs__panel" id="comments"><?php
                    $GLOBALS['MENUS'] -> theMenu( 'comments' );
                    $GLOBALS['MENUS'] -> subMenu( 'comments' ); ?>
                </div>

                <div class="mdl-tabs__panel" id="messages"><?php
                    $GLOBALS['MENUS'] -> theMenu( 'messages' );
                    $GLOBALS['MENUS'] -> subMenu( 'messages' ); ?>
                </div>

                <div class="mdl-tabs__panel" id="udef"><?php
                    $GLOBALS['MENUS'] -> uMenu(); ?>

                </div>
            </div>
              <a href="?add=menu"><button class="mdl-button red alignrght "><i class="material-icons">add</i>Add New Item</button></a>
          </div>
        </div>
        <div id="header"><?php
          $GLOBALS['MENUS'] -> headMenu(); ?>
        </div>
        <div id="main"><?php
          $GLOBALS['MENUS'] -> subMenu( 'articles' ); ?>
        </div>
        <div id="footer"><?php
          $GLOBALS['MENUS'] -> subMenu( 'articles' ); ?>
        </div>
    </div><?php } ?>
  </div>
</div><?php 
include './footer.php'; ?>
