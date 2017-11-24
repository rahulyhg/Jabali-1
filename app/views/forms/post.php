<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Form
* @link https://docs.jabalicms.org/classes/forms/
* @author Mauko Maunde
* @version 0.17.06
* @license MIT - https://opensource.org/licenses/MIT
**/ ?>
<title>New <?php echo ucfirst( $_GET['create'] ); ?> - <?php showOption( 'name' ); ?></title>
<form enctype="multipart/form-data" name="postForm" method="POST" action="" style="width:100%;" class="mdl-grid">
  <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-card--expand <?php primaryColor(); ?>"><br><br>
    <div class="mdl-card__supporting-text mdl-cell mdl-cell--12-col mdl-grid">
      <div class="input-field mdl-cell mdl-cell--12-col">
        <input id="name" type="text" name="name" >
        <label for="name" data-error="wrong" data-success="right" class="center-align">Title</label>
      </div>

      <div class="input-field mdl-cell mdl-cell--9-col">
        <input id="subtitle" type="text" name="subtitle" >
        <label for="subtitle" class="center-align">Subtitle(Optional )</label>
      </div>

      <div class="input-field mdl-cell--3-col mdl-js-textfield getmdl-select">
        <i class="material-icons prefix">keyboard_arrow_down</i>
        <input class="mdl-textfield__input" id="type" name="template" type="text" readonly tabIndex="-1" value="post" >
        <label for="type" class="center-align">Template</label>
        <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu <?php primaryColor(); ?>" for="type"><?php
          $theme = getOption( 'activetheme' );
          $path = _ABSTHEMES_ . $theme . '/templates/';
          if ( $dh = opendir( $path ) ) {
            while ( ($template = readdir( $dh ) ) !== false ) {
              if ( ($template !== ".") && ($template !== "..")) {
                echo '<li class="mdl-menu__item" data-val="'.  str_replace(".php", "", $template ) .'" >'. ucwords(str_replace(".php", "", $template ) ) .'</li>';
              }
            }
            closedir( $dh );
          } ?>
        </ul>
      </div>

      <div class="input-field mdl-cell mdl-cell--12-col">
        <h6><?php echo ucfirst( $_GET['create'] ); ?> Content</h6>
        <textarea class="materialize-textarea col s12" type="text" id="message" rows="5" name="details"></textarea>
        <script>CKEDITOR.replace( 'message' );</script>
      </div>

      <div class="input-field mdl-cell mdl-cell--12-col">
        <h6><?php echo ucfirst( $_GET['create'] ); ?> Notes</h6>
        <textarea class="materialize-textarea col s12" type="text" id="message" rows="5" name="excerpt"></textarea>
      </div>
    </div>
  </div>

  <?php if ( $_GET['create'] == "page" || $_GET['create'] == "article" || $_GET['create'] == "project" ) { ?>
  <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand <?php primaryColor(); ?>">
    <div class="mdl-card__image">
      <div style="height:0px;overflow:hidden">
        <input type="file" id="avatar" name="new_avatar" />
        <input type="hidden" id="avatar" name="the_avatar" value="<?php echo( _IMAGES.'placeholder.png' ); ?>" />
      </div>
      <img id="havatar" onclick="chooseFile();" src="<?php echo( _IMAGES.'placeholder.png' ); ?>" width="100%">
      <script>
        $(function () {
          $( ":file" ).change(function () {
            if ( this.files && this.files[0]  ) {
              var reader = new FileReader();
              reader.onload = imageIsLoaded;
              reader.readAsDataURL(this.files[0] );
            }
          } );
        } );

        function imageIsLoaded(e ) {
          $('#havatar' ).attr('src', e.target.result );
        };

        function chooseFile() {
          $( "#avatar" ).click();
        }
      </script>
    </div>

    <div class="mdl-card__supporting-text">

      <div class="mdl-cell mdl-cell--12-col mdl-grid"><?php

        if ( $_GET['create'] !== "page" ) { ?>
          <div class="input-field mdl-cell mdl-cell--6-col">
            <i class="material-icons prefix">label</i>
            <textarea id="tags" name="tags" class="materialize-textarea col s12"></textarea>
            <label for="tags" class="center-align">Tags</label>
          </div>

          <div class="input-field mdl-cell mdl-cell--6-col">
            <i class="material-icons prefix">label_outline</i>
            <textarea id="category" name="categories" class="materialize-textarea col s12"></textarea>
            <label for="category" class="center-align">Categories</label>
          </div><?php
        } ?>

        <div class="input-field mdl-cell mdl-cell--7-col">
          <i class="material-icons prefix">today</i>
          <input  id="created" name="created_d" type="text" value="<?php echo date( 'Y-m-d' ); ?>" >
          <label for="created" class="center-align">Publish Date</label>
          <script>
           $(function() {
              $("#created").datepicker({ dateFormat: "yy-mm-dd" }).val()
            });
          </script>
        </div>

        <div class="input-field mdl-cell mdl-cell--5-col">
          <i class="material-icons prefix">schedule</i>
          <input  id="created_t" name="created_t" type="text" value="<?php echo date( 'H:i:s' ); ?>" class="timepicker" >
          <script type="text/javascript">
            $('.timepicker').pickatime({
            default: 'now', // Set default time: 'now', '1:30AM', '16:30'
            fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
            twelvehour: false, // Use AM/PM or 24-hour format
            donetext: 'OK', // text for done-button
            cleartext: 'Clear', // text for clear-button
            canceltext: 'Cancel', // Text for cancel-button
            autoclose: false, // automatic close timepicker
            ampmclickable: true, // make AM PM clickable
            aftershow: function(){} //Function for after opening timepicker
            });
          </script>
          <label for="created_t" class="center-align">Time</label>
        </div>
      </div>

      <input type="hidden" name="author" value="<?php echo $_SESSION[JBLSALT.'Code']; ?>">
      <input type="hidden" name="author_name" value="<?php echo $_SESSION[JBLSALT.'Alias']; ?>">
      <input type="hidden" name="level" value="public">
      <input type="hidden" name="authkey" value="<?php str_shuffle( generateCode() ); ?>">
      <input type="hidden" name="status" value="published">
      <input type="hidden" name="type" value="<?php echo $_GET['create']; ?>">
      <?php csrf(); ?>
      <button class="mdl-button mdl-button--fab addfab alignright mdl-button--colored" type="submit" name="create"><i class="material-icons">save</i></button>
    </div>
    <div class="mdl-card__menu">
      <a href="?type=article">
        <i class="material-icons">clear</i>
      </a>
    </div>
  </div>
</form><?php }