<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Header page Layout
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.09
* @license MIT - https://opensource.org/licenses/MIT
* @link https://docs.jabalicms.org/views/footer/
**/ ?>
<!doctype html>
<html lang="en" xmlns="https://www.w3.org/1999/html">
<head>
    <link rel="shortcut icon" href="<?php 
    if ( file_exists('./inc/config.php' ) ) {
        showOption( 'favicon' );
    } else {
        echo _IMAGES."marker.png"; 
    } ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php showOption( 'description' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">


    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?php showOption( 'name' ); ?>">


    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="manifest" href="<?php echo _ROOT.'manifest.php;' ?>">

    <link rel="stylesheet" href='<?php echo _STYLES; ?>lib/getmdl-select.min.css'>
    <link rel="stylesheet" href="<?php echo _STYLES; ?>lib/nv.d3.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>jquery-ui.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>material-icons.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>font-awesome.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>jabali.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>colors.css">
    <!-- <link rel="stylesheet" href="app/styles.php"> -->
    <style type="text/css">
    .mdl-menu__outline {
        background-color: <?php primaryColor(); ?>;
        overflow-y: auto;
    }

    .primary {
        color: <?php primaryColor(); ?>;
    }
    .accent, a {
        color: <?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { secondaryColor(); } else { echo "red"; } ?>;
    }
    .accent, .mdl-button--fab.mdl-button--colored, .mdl-button.mdl-button--colored, .mdl-badge[data-badge]:after {
        background-color: <?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { secondaryColor(); } else { echo "red"; } ?>;
    }

    .cke_bottom {
      background: <?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { secondaryColor(); } else { echo "red"; } ?>;
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
    #particles-js{
  width: 100%;
  height: 100%;
}
    </style>

    <script src="<?php echo _SCRIPTS; ?>jquery-3.2.1.min.js"></script>
    <script src="<?php echo _SCRIPTS; ?>jquery-ui.js"></script>
    <script src="<?php echo _ASSETS; ?>js/ckeditor/ckeditor.js"></script>
</head>
<body id="particles-js" class="snow" >
    <main class="mdl-layout__content">