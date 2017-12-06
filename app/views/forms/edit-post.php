<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Form
* @link https://docs.jabalicms.org/classes/forms/
* @author Mauko Maunde < hi@mauko.co.ke >
* @version 0.17.06
* @license MIT - https://opensource.org/licenses/MIT
**/

$getPostCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE id = '".$data."'" );
if ( $GLOBALS['JBLDB'] -> numRows( $getPostCode ) > 0 ) {
  while ( $post = $GLOBALS['JBLDB'] -> fetchObject( $getPostCode ) ){
    $names = explode( " ", $post -> name ); ?>
    <title>Edit <?php echo( $post -> name ); ?> - <?php showOption( 'name' ); ?></title>
    <form enctype="multipart/form-data" name="postForm" method="POST" action="" style="width:100%;" class="mdl-grid">
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-card--expand <?php primaryColor(); ?>">
          <div class="mdl-card__supporting-text mdl-cell mdl-cell--12-col mdl-grid">
            <div class="input-field mdl-cell mdl-cell--12-col">
              <i class="material-icons prefix">label</i>
              <input id="name" type="text" name="name" value="<?php echo( $post -> name ); ?>">
              <label for="name" data-error="wrong" data-success="right" class="center-align">Title</label>
            </div>

            <div class="input-field mdl-cell mdl-cell--7-col">
              <i class="material-icons prefix">label_outline</i>
              <input id="subtitle" type="text" name="subtitle" value="<?php echo( $post -> subtitle ); ?>">
              <label for="subtitle"  class="center-align">Subtitle</label>
            </div>

            <div class="input-field mdl-cell mdl-cell--4-col mdl-grid">
              <i class="material-icons prefix">link</i>
              <input id="link" type="text" name="link" value="<?php echo( _ROOT . '/'. $post -> slug ); ?>">
              <label for="link"  class="center-align">Link</label>
            </div>

            <div class="input-field mdl-cell mdl-cell--12-col">
              <h6><?php echo( ucfirst( $post -> type ) ); ?> Content</h6>
              <textarea class="materialize-textarea col s12" type="text" id="message" rows="5" name="details">
              <?php echo( $post -> details ); ?>
              </textarea><script>CKEDITOR.replace( 'message' );</script>
            </div>

            <div class="input-field mdl-cell mdl-cell--12-col">
              <h6><?php echo( ucfirst( $post -> type ) ); ?> Notes</h6>
              <textarea class="materialize-textarea col s12" type="text" id="message" rows="5" name="excerpt"><?php echo( $post -> excerpt ); ?></textarea>
            </div>
          </div>

          <div class="mdl-card__menu">
            <a class="mdl-button mdl-button--icon mdl-button--colored" href="?copy=<?php echo( $post -> id ); ?>&key=<?php echo( $post -> name ); ?>">
              <i class="material-icons">content_copy</i>
            </a>
            <a class="mdl-button mdl-button--icon mdl-button--colored" href="<?php echo( $post -> link ); ?>">
              <i class="material-icons">open_in_new</i>
            </a>
            <button class="mdl-button mdl-button--icon mdl-button--colored" type="submit" name="deletefile" value="<?php echo( $post -> id ); ?>"><i class="material-icons">delete</i></button>
          </div>
        </div>
      <?php if ( !isset( $_GET['x']) ) { ?>
      <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand <?php primaryColor(); ?>">
        <div class="mdl-card__image">
          <div style="height:0px;overflow:hidden">
            <input type="file" id="avatar" name="new_avatar" />
            <input type="hidden" id="avatar" name="the_avatar" value="<?php echo( $post -> avatar ); ?>" />
          </div><?php if (!file_get_contents( $post -> avatar )): $savatar = _IMAGES.'placeholder.png'; else: $savatar = $post -> avatar; endif; ?>
          <img id="havatar" onclick="chooseFile();" src="<?php echo( $savatar ); ?>" width="100%">
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
          <div class="input-field mdl-js-textfield getmdl-select">
            <i class="material-icons prefix">keyboard_arrow_down</i>
            <input class="mdl-textfield__input" id="type" name="template" type="text" readonly tabIndex="-1" value="<?php echo( $post -> template ); ?>" >
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

          <?php
          if ( $post -> type !== "page"  ) { ?>
            <div class="input-field">
            <i class="mdi mdi-tag-multiple prefix"></i>
            <textarea id="tags" name="tags" class="materialize-textarea col s12"><?php echo( $post -> tags ); ?></textarea>
            <label for="tags" class="center-align">Tags</label>
            </div>

            <div class="input-field">
            <i class="mdi mdi-format-list-bulleted-type prefix"></i>
            <textarea id="category" name="categories" class="materialize-textarea col s12"><?php echo( $post -> categories ); ?></textarea>
            <label for="category" class="center-align">Categories</label>
            </div><?php
          } else {
            hiddenFields( array( 'tags' => '', 'categories' => '') );
          }
          $date = $post -> created;
          $date = explode(" ", $date); ?>

          <div class="mdl-grid">
            <div class="input-field mdl-cell mdl-cell--6-col">
              <i class="material-icons prefix">today</i>
              <input type="text" id="created" name="created_d" value="<?php echo( $date[0] ); ?>" >
              <script>
                $(function() {
                $("#created").datepicker({ dateFormat: "yy-mm-dd" }).val()
                });
              </script>
              <label for="created" class="center-align">Published on</label>
            </div>

            <div class="input-field mdl-cell mdl-cell--6-col">
              <i class="material-icons prefix">schedule</i>
              <input type="text" id="created_t" name="created_t" value="<?php echo( $date[1] ); ?>" >
              <label for="created_t" class="center-align">at</label>
            </div>
          </div>
          <p>Author: <a href="./users?view=<?php echo( $post -> author ); ?>&key=<?php echo( $post -> author_name ); ?>"><?php echo( $post -> author_name ); ?></a></p>

          <?php hiddenFields( ['author' => $post -> author, 'author_name' => $post -> author_name, 'level' => $post -> level, 'authkey' => $post -> authkey, 'id' => $post -> id, 'status' => $post -> status, 'type' => $post -> type, 'updated' => date( 'Y-m-d H:i:s') ] ); 
          submitButton( 'update', 'addfab' ); ?>
        </div>
      </div>
    </form><?php
      }
  }
} else {
echo 'The Post No Longer Exists.';
}