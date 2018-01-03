<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Admin Header
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.09
* @link https://docs.jabalicms.org/dashboard/
**/

if ( !isset( $_SESSION[JBLSALT.'Code'] ) ) {
  header( "Location: ". _ROOT ."/login/jabali" );
  exit();
}

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

$GUSkin = $GLOBALS['SKINS'][$key];
$GLOBALS['GPrimary'] = $GUSkin['primary'];
$GLOBALS['GAccent'] = $GUSkin['accent'];
$GLOBALS['GTextP'] = $GUSkin['textp'];
$GLOBALS['GTextS'] = $GUSkin['texts']; ?>
<!doctype html>
<!--
  Jabali Framework
  © 2017 Mauko Maunde. All rights reserved.

  Licensed under the MIT license (the "License" );
  You may not use this file except in compliance with the License.
  You may obtain a copy of the License at https://opensource.org/licenses/MIT
-->
<html lang="en" xmlns="https://www.w3.org/1999/html">
  <head>
    <?php head();
    loadStyles( [ _STYLES."lib/getmdl-select.min.css", _STYLES."lib/nv.d3.css", _STYLES."jquery-ui.css", _STYLES."materialdesignicons.min.css", _STYLES."jabali.css", _STYLES."colors.css", _STYLES."pmd/table/table.css", _STYLES."pmd/table/card.css"] ); ?>
    <?php if ( isLocalhost() ): ?>
    <link rel="stylesheet" href="<?php echo _STYLES; ?>material-icons.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>font-awesome.css">
    <?php else: ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <?php endif; ?>
    <style type="text/css">
      .mdl-menu__outline {
          background-color: <?php primaryColor(); ?>;
          overflow-y: auto;
      }

      .cke_bottom {
      background: <?php secondaryColor(); ?>;
      }

      .primary {
          color: <?php primaryColor(); ?>;
      }
      .accent, a, .mdl-data-table.a, .mdl-badge.mdl-badge--no-background[data-badge]:after, .mdl-layout__drawer.mdl-navigation.mdl-navigation__link--current.material-icons, .mdl-layout__drawer.mdl-navigation.mdl-navigation__link:hover, .mdl-layout__drawer.mdl-navigation.mdl-navigation__link:hover.material-icons {
          color: <?php secondaryColor(); ?>;
      }


      .accent, .accent, .mdl-button--fab.mdl-button--colored, .mdl-badge[data-badge]:after {
          background-color: <?php secondaryColor(); ?>;
      }

      .mdl-data-table {
      color: white;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      -o-text-overflow: ellipsis;
      width: 100%;
      height: auto;
      }
    </style>
    <?php
      $ace = ( isLocalhost() ) ? _SCRIPTS."ace/ace.js" : "https://cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js"; 
      loadScripts([ _SCRIPTS."jquery-3.2.1.min.js", _SCRIPTS."jquery.canvasjs.min.js", _SCRIPTS."jquery-ui.js", _SCRIPTS."ckeditor/ckeditor.js", $ace ]); ?>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header text--<?php textColor(); ?> <?php primaryColor(); ?>">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title"><?php
          if ( isset( $_GET['type'] ) ) {
            echo ucwords( $_GET['type'].'s ' );
          } elseif ( isset( $_GET['view'] ) ) {
              if ( isset( $_GET['key'] )) {
                echo ucwords( $_GET['key'] );
              } else {
                echo ucwords( $_GET['key'] ); echo ucwords( $_GET['status'] );
              }
          } elseif ( isset( $_GET['status'] )) {
                if ( isset( $_GET['key'] ) ) {
                  echo ucwords( $_GET['key'] );
                } else {
                  echo ucwords( $_GET['status'] );
                }
          } elseif ( isset( $_GET['profile'] )) {
                if ( isset( $_GET['key'] ) ) {
                  echo ucwords( $_GET['key'] );
                } else {
                  echo ucwords( "Item" );
                }
          } elseif ( isset( $_GET['x'] ) && isset( $_GET['key'] ) ) {
            if ( isset( $_GET['create'] ) ) {
              echo "Add New " . ucwords( $_GET['create'] );
            } elseif ( isset( $_GET['edit'] ) ) {
              echo "Editing " . ucwords( $_GET['key'] );
            } elseif ( isset( $_GET['copy'] ) ) {
              echo "Copying " . ucwords( $_GET['key'] );
            } elseif ( isset( $_GET['settings'] ) ) {
              echo ucwords( $_GET['settings'] );
            }
          } elseif ( isset( $_GET['x'] ) && isset( $_GET['create'] ) ) {
            echo ucwords( "Create ".$_GET['create'] );
          } elseif ( isset( $_GET['x'] ) && isset( $_GET['settings'] ) && !isset( $_GET['key'] ) ) {
            echo ucwords( $_GET['settings'].' Options' );
          } elseif ( isset( $_GET['create'] ) ) {
            echo "Add New ".ucwords( $_GET['create'].' ' );
          } elseif ( isset( $_GET['add'] ) ) {
            echo "Add New ".ucwords( $_GET['add'].' ' );
          } elseif ( isset( $_GET['page'] ) ) {
            echo ucwords( $_GET['page'] );
          } elseif ( isset( $_GET['settings'] ) ) {
            echo ucwords( $_GET['settings'].' Options' );
          } elseif ( isset( $_GET['edit'] ) && $_GET['key'] !== "" ) {
            echo 'Editing '.ucwords( $_GET['key'].' ' );
          } elseif ( isset( $_GET['copy'] ) ) {
            echo "Copying " . ucwords( $_GET['key'] );
          } elseif ( isset( $_GET['pay'] ) ) {
            echo "Pay Via ".strtoupper( $_GET['method'] );
          }
          ?></span>
          <div class="mdl-layout-spacer"></div>
          <a href="<?php echo( _ROOT ); ?>" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification" id="home" >visibility
          </a>
          <div class="mdl-tooltip" for="home">View Site</div>

          <a href="messages?type=notification" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_notifications" data-badge="<?php echo getNoteCount(); ?>">notifications_none
          </a>
          <div class="mdl-tooltip" for="h_notifications"><?php echo getNoteCount() ?> Notifications</div>

            <div class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon" id="inbox" data-badge="<?php echo( getMsgCount() ); ?>">
                mail_outline
            </div><div class="mdl-tooltip" for="inbox"><?php echo( getMsgCount() ); ?> Messages</div>

            <!-- Messages dropdown-->
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right optiondrop <?php primaryColor(); ?> mdl-shadow--2dp messages-dropdown"
                for="inbox">
                <li class="mdl-list__item">
                    <?php echo( getMsgCount() ); ?> new messages!  <a href="messages?create=message" class="mdl-button mdl-js-button alignright">Compose</a>
                </li>
                <?php if( getMsgCount() > 0 ):
                resetLoop('getStatus', ["unread", $_SESSION[JBLSALT.'Code'], "message"], "messages");
                if( hasRecords()): while(hasRecords()): theRecord(); ?>
                <a href="messages?view=<?php theId(); ?>&key=<?php theTitle(); ?>" class="mdl-menu__item mdl-list__item mdl-list__item--two-line list__item--border-top">
                    <span class="mdl-list__item-primary-content">
                        <span class="mdl-list__item-avatar background-color--primary">
                            <text><?php theAuthorIn(1); ?></text>
                        </span>
                        <span><?php theAuthorIn(); ?></span>
                        <span class="mdl-list__item-sub-title"><?php theTitle(); ?></span>
                    </span>
                    <span class="mdl-list__item-secondary-content">
                      <span class="label label--transparent"><?php theDate(); ?></span>
                    </span>
                  </a>
                <?php endwhile; endif; endif; ?>
                <li class="mdl-list__item list__item--border-top">
                    <a href="messages?status=read&key=all messages" class="mdl-button mdl-button--colored accent text--white mdl-js-button mdl-js-ripple-effect">ALL MESSAGES</a>
                    <div class="mdl-layout-spacer"></div>
                    <a href="messages?status=unread&key=inbox" class="mdl-button mdl-js-button mdl-js-ripple-effect">INBOX</a>
                </li>
            </ul>
          <?php if ( isCap( 'admin' ) ): ?>
          <a href="#" class="material-icons mdl-js-button mdl-badge mdl-badge--overlap mdl-button--icon notification" id="hvdrbtn">apps</a>
          <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop <?php primaryColor(); ?>" for="hvdrbtn">
          <a href="themes?page=themes" class="mdl-list__item"><i class="mdl-list__item-icon alignright text--white material-icons" role="presentation">palette</i><span style="padding-left: 20px">Themes</span></a>
          <a href="modules?page=extension modules" class="mdl-list__item"><i class="mdl-list__item-icon text--white material-icons" role="presentation">power</i><span style="padding-left: 20px">Modules</span></a>
          <a href="posts?create=article" class="mdl-list__item"><i class="mdl-list__item-icon text--white material-icons" role="presentation">create</i><span style="padding-left: 20px">New Article</span></a>
          </ul>
        <?php endif; ?>

          <a href="#" class="material-icons mdl-js-button mdl-badge mdl-badge--overlap mdl-button--icon" id="dvdrbtn">more_vert</a>
          <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right <?php primaryColor(); ?>" for="dvdrbtn">
            <?php if ( isCap( 'admin' ) ){
              $default = array( 'general', 'color', 'misc', 'types', 'restful', 'social', 'editor' ); 
              foreach( $GLOBALS['GSettings'] as $setting => $values ): if ( !in_array( $setting, $default ) ):
                $x = array_shift( $values ); ?>
                <a href="options?options=<?php echo( $setting ); ?>&page=<?php echo( ucwords( $x['title'] ) ); ?> Options" class="mdl-list__item"><i class="mdi mdi-settings mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo( ucwords( $x['title'] ) ); ?></span></a>
              <?php endif; endforeach; 
            } ?>
            <a href="<?php echo( _ROOT . '/?logout' ); ?>" class="mdl-list__item"><i class="mdi mdi-exit-to-app mdl-list__item-icon"></i><span style="padding-left: 20px">Logout</span></a>
          </ul>
        </div>
      </header>
      <div class="mdl-layout__drawer <?php primaryColor(); ?> mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <a href="./users?view=<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>&key=<?php echo( $_SESSION[JBLSALT.'Alias'] ); ?>">
          <?php $avatar = getimagesize( $_SESSION[JBLSALT.'Avatar'] ) ? $_SESSION[JBLSALT.'Avatar'] : _IMAGES.'avatar.png' ?>
            <img src="<?php echo( $avatar ); ?>" class="demo-avatar">
          </a>
          <div class="demo-avatar-dropdown">
            <span><?php echo( $_SESSION[JBLSALT.'Alias'] ); ?></span>
            <div class="mdl-layout-spacer"></div>
            <a href="./users?edit=<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>&key=<?php echo( $_SESSION[JBLSALT.'Alias'] ); ?>"><button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="mdi mdi-account-edit" role="presentation"></i></button></a>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation <?php primaryColor(); ?>"><?php
          $GLOBALS['MENUS'] -> drawerdef( 'dashboard' );
          $GLOBALS['MENUS'] -> drawerdef( 'posts' );
          $GLOBALS['MENUS'] -> drawerdef( 'users' );
          $GLOBALS['MENUS'] -> drawerdef( 'messages' );
          $GLOBALS['MENUS'] -> drawerdef( 'comments' );
          $GLOBALS['MENUS'] -> drawerdef( 'resources' );
          /*
          * User Defined Menus
          */
          $GLOBALS['MENUS'] -> drawer(); ?><?php
          if ( isCap( 'admin' ) ) { ?>
          <a id="media" class="mdl-navigation__link" href="media?view=all&key=media"><i class="mdl-color-text--white material-icons" role="presentation">image</i>Media</a>
          <!-- <a id="themes" class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">widgets</i>Extending</a>
          <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left <?php primaryColor(); ?>" for="themes">
          <a class="mdl-navigation__link" href="themes?page=themes"><i class="mdl-color-text--white material-icons" role="presentation">palette</i><span>Themes</span></a>
          <a id="extensions" class="mdl-navigation__link" href="modules?page=extension modules"><i class="mdl-color-text--white material-icons" role="presentation">power</i>Modules</a>
            </ul> -->
          <a id="htools" class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">import_export</i>Transfer</a>
          <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left <?php primaryColor(); ?>" for="htools">
          <a class="mdl-navigation__link" href="tools?page=import"><i class="mdl-color-text--white material-icons" role="presentation">arrow_downward</i><span>Import Data</span></a>
          <a class="mdl-navigation__link" href="tools?page=export"><i class="mdl-color-text--white material-icons" role="presentation">arrow_upward</i><span>Export Data</span></a>
          <?php } ?>
            </ul>

          <div class="mdl-layout-spacer"></div>
          <a id="hpref" class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">settings</i>Preferences</a>
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left <?php primaryColor(); ?>" for="hpref">
            <a class="mdl-navigation__link" href="options?settings=color"><i class="mdl-color-text--white material-icons" role="presentation">color_lens</i><span>Color Options</span></a><?php
          if ( isCap( 'admin' ) ) { ?>
          <a class="mdl-navigation__link" href="pwa?settings=progressive app"><i class="mdl-color-text--white material-icons" role="presentation">touch_app</i><span>Progressive App</span></a>
          <a class="mdl-navigation__link" href="update?settings=update"><i class="mdl-color-text--white material-icons" role="presentation">update</i><span>Jabali Updates</span></a>
          <a class="mdl-navigation__link" href="menus?settings=menu"><i class="mdl-color-text--white material-icons" role="presentation">menu</i><span>Menu Options</span></a>
          <a class="mdl-navigation__link" href="options?settings=misc"><i class="mdl-color-text--white material-icons" role="presentation">public</i><span>Miscelleaneous</span></a>
          <a class="mdl-navigation__link" href="options?settings=editor"><i class="mdl-color-text--white material-icons" role="presentation">edit</i><span>Editor Options</span></a>
          <a class="mdl-navigation__link" href="options?settings=restful"><i class="mdl-color-text--white material-icons" role="presentation">public</i><span>REST Options</span></a>
          <a class="mdl-navigation__link" href="options?settings=types"><i class="mdl-color-text--white material-icons" role="presentation">build</i><span>Types Options</span></a>
          <a class="mdl-navigation__link" href="options?settings=general"><i class="mdl-color-text--white material-icons" role="presentation">tune</i><span>General Settings</span></a>
          <?php } ?>
            </ul>
        </nav>
      </div>
      <main class="mdl-layout__content">
