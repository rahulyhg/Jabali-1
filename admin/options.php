<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Admin Options
* @author Mauko Maunde
* @since 0.17.04
* @link https://docs.jabalicms.org/options/
**/
session_start();
require_once( '../init.php' );
require_once( '../load.php' );

addSetting( "general", [], array( $GLOBALS['OPTIONS'], "general" ) );
addSetting( "types", [], array( $GLOBALS['OPTIONS'], "types") );
addSetting( "social", [], array( $GLOBALS['OPTIONS'], "social" ) );
addSetting( "color", [], array( $GLOBALS['OPTIONS'], "colors" ) );
addSetting( "editor", [], array( $GLOBALS['OPTIONS'], "editor" ) );
addSetting( "restful", [], array( $GLOBALS['OPTIONS'], "rest" ) );
addSetting( "misc", [], array( $GLOBALS['OPTIONS'], "misc" ) );

if ( isset( $_POST['settings'] ) ) {
    foreach ($GLOBALS['GSettingsField'][ $_POST['settings'] ] as $id => $field ) {
        $date = date( "Y-m-d" );
        $name = $field[0];
        $type = $field[1];
        $label = $field[2];
        $icon = $field[3];
        $attrs = $field[4];

        if ( is_array( $POST[$name] ) ) {
            $value = json_encode( $_POST[$name] );
        } else {
            $value = $_POST[$name];
        }

        if ( !isOption( $name ) ) {
            $GLOBALS['OPTIONS'] -> create ( $label, $name, $value, $date );
        } else {
            $GLOBALS['OPTIONS'] -> update ( $name, $value, $date );
        }
    }
}

if ( isset( $_POST['mystyle'] ) ) {
    $theme = $_POST['theme'];
    // $cols = array( "style" );
    // $vals = array( $theme );
    // $conds = array( "id" => $_SESSION[JBLSALT.'Code'] );
    // $GLOBALS['USERS'] -> getId( $_SESSION[JBLSALT.'Code'] );
    // $GLOBALS['USERS'] -> style = $theme;
    // $GLOBALS['USERS'] -> update();
    $GLOBALS['JBLDB'] -> query( "UPDATE ". _DBPREFIX ."users SET style = '".$theme."' WHERE id = '". $_SESSION[JBLSALT.'Code'] ."'" );
}

if ( isset( $_POST['preferences'] ) ) {
    $date = date('Y-m-d' );
    $uploaddir = _ABSUP_.date("Y/m/d/");

    if ( is_uploaded_file($_FILES['newheaderlogo']["tmp_name"]) || file_exists($_FILES['newheaderlogo']["tmp_name"]) ) {
        $fheaderlogo = basename( $_FILES['newheaderlogo']['name'] );
        if ( !move_uploaded_file( $_FILES['newheaderlogo']["tmp_name"], $uploaddir.$fheaderlogo ) ) {
            echo "Sorry, there was an error uploading your file.";
        }
        $headerlogo = _UPLOADS.date("Y/m/d/").$fheaderlogo ;
    } else {
        $headerlogo = $_POST['headerlogo'];
    }

    if ( is_uploaded_file($_FILES['newhomelogo']["tmp_name"]) || file_exists($_FILES['newhomelogo']["tmp_name"]) ) {
        $fhomelogo = basename( $_FILES['newhomelogo']['name'] );
        if ( !move_uploaded_file( $_FILES['newhomelogo']["tmp_name"], $uploaddir.$fhomelogo ) ) {
            echo "Sorry, there was an error uploading your file.";
        }

        $homelogo = _UPLOADS.date("Y/m/d/").$fhomelogo;
    } else {
        $homelogo = $_POST['homelogo'];
    }

    if ( is_uploaded_file($_FILES['newfavicon']["tmp_name"]) || file_exists($_FILES['newfavicon']["tmp_name"]) ) {
        $ffavicon = basename( $_FILES['newfavicon']['name'] );
        if ( !move_uploaded_file( $_FILES['newfavicon']["tmp_name"], $uploaddir.$ffavicon ) ) {
            echo "Sorry, there was an error uploading your file.";
        }
        $favicon = _UPLOADS.date("Y/m/d/").$ffavicon;
    } else {
        $favicon = $_POST['favicon'];
    }

    // if ( $GLOBALS['OPTIONS'] -> bulkupdate( $options ) ) {
    //    _shout_( 'Settings Updated Successfully', 'success');
    // } else {
    //     _shout_( 'Sorry, could not update your settings', 'error');
    // }

    $GLOBALS['OPTIONS'] -> update ( 'name', $_POST['name'], $date );
    $GLOBALS['OPTIONS'] -> update ( 'description', $_POST['description'], $date );
    $GLOBALS['OPTIONS'] -> update ( 'language', $_POST['language'], $date );
    $GLOBALS['OPTIONS'] -> update ( 'charset', $_POST['charset'], $date );
    $GLOBALS['OPTIONS'] -> update ( 'email', $_POST['email'], $date );
    $GLOBALS['OPTIONS'] -> update ( 'phone', $_POST['phone'], $date );
    $GLOBALS['OPTIONS'] -> update ( 'copyright', $_POST['copyright'], $date );
    $GLOBALS['OPTIONS'] -> update ( 'attribution', $_POST['attribution'], $date );
    $GLOBALS['OPTIONS'] -> update ( 'attribution_link', $_POST['attribution_link'], $date );
    $GLOBALS['OPTIONS'] -> update ( 'headerlogo', $headerlogo, $date );
    $GLOBALS['OPTIONS'] -> update ( 'homelogo', $homelogo, $date );
    $GLOBALS['OPTIONS'] -> update ( 'favicon', $favicon, $date );
    $GLOBALS['OPTIONS'] -> update ( 'registration', $_POST['registration'], $date );
    $GLOBALS['OPTIONS'] -> update ( 'timezone', $_POST['timezone'], $date );
    $GLOBALS['OPTIONS'] -> update ( 'country', $_POST['country'], $date );
    $GLOBALS['OPTIONS'] -> update ( 'region', $_POST['region'], $date );
    $GLOBALS['OPTIONS'] -> update ( 'city', $_POST['city'], $date );
}

if ( isset( $_POST['utype'] ) ) {
    $date = date('Y-m-d' );

    $type = $_POST['utype'];
    $level = $_POST['ulevel'];

    $utype = array_combine( $type, $level );
    $utype = json_encode( $utype );

    $GLOBALS['OPTIONS'] -> update ( 'usertypes', $utype, $date );
}

if ( isset( $_POST['ptype'] ) ) {
    $date = date('Y-m-d' );

    $type = $_POST['ptype'];
    $level = $_POST['plevel'];

    $utype = array_combine( $type, $level );
    $utype = json_encode( $utype );

    $GLOBALS['OPTIONS']-> update ( 'posttypes', $utype, $date );
}

if ( isset( $_POST['social'] ) ) {
    $name = $_POST['network'];
    $link = $_POST['link'];

    $social = array_combine( $name, $link );
    $social = json_encode( $social );

    $GLOBALS['OPTIONS'] -> update ( 'social', $social, date('Y-m-d') );
}

require_once( 'header.php' ); ?>
    <div class="mdl-grid" ><?php
        if ( isset( $_GET['settings'] )) {
            doSetting( $_GET['settings'] );
        } elseif ( isset( $_GET['options'] )) {
            renderSettingsForm( $_GET['options'] );
            require_once( 'footer.php' );
        } ?>
    </div><?php
require_once( 'footer.php' );
