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
    <?php head(); ?>

    <link rel="stylesheet" href='<?php echo _STYLES; ?>lib/getmdl-select.min.css'>
    <link rel="stylesheet" href="<?php echo _STYLES; ?>lib/nv.d3.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>jquery-ui.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>material-icons.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>font-awesome.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>jabali.css">
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