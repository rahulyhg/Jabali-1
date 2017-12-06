<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Single Message View
* @link https://docs.jabalicms.org/views/
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.10
* @license MIT - https://opensource.org/licenses/MIT
**/
$message = $GLOBALS['MESSAGES'] -> getId( $data );
if ( !isset( $message['error'] ) ) {
  $message = (object)$message; ?>
    <title><?php echo( ucwords( $message -> name ) ); ?> - <?php showOption( 'name' ); ?></title>
    <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
      <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
          <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
            <h4><?php echo( $message -> subtitle ); ?></h4>
            <h6>Published: <?php echo( $message -> created ); ?></h6>
            <h6>Authored by: <a href="./users?view=<?php echo( $message -> author .'&key='.$message -> author_name ); ?>"><?php echo( $message -> author_name ); ?></a></h6>
            <h6>Category: <?php echo( $message -> categories ); ?></h6>
            <h6>Tagged: <?php echo( ucwords( $message -> tags ) ); ?></h6>
            <h6>Readings: <?php echo( ucwords( $message -> tags ) ); ?></h6>
          </div>
          <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
            <img src="<?php echo( $message -> avatar ); ?>" width="100%">
          </div>
        </div>
        <div class="mdl-card__supporting-text mdl-card--expand">
          <span><?php echo( $message -> details ); ?></span>
        </div>
        <div class="mdl-card__menu">
          <button id="demo_menu-top-right" class="mdl-button mdl-js-button mdl-button--icon mdl-button--fab accent">
          <i class="material-icons mdl-color-text--white">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect <?php primaryColor(); ?>"
          for="demo_menu-top-right">
          <a href="./messages?view=<?php echo( $message -> id ); ?>&fav=<?php echo( $message -> id ); ?>&key=<?php echo( ucwords( $message -> name ) ); ?>" class="mdl-list__item"><i class="mdi mdi-heart mdl-list__item-icon"></i><span style="padding-left: 20px">Favorite</span></a>
          <a href="./note?message=<?php echo( $message -> id ); ?>&author=<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>" class="mdl-list__item"><i class="mdi mdi-note-multiple mdl-list__item-icon"></i><span style="padding-left: 20px">Notes</span></a><?php if ( isCap( 'admin' ) || isAuthor( $message -> author ) ) { ?>
          <a href="./messages?edit=<?php echo( $message -> id ); ?>&key=<?php echo( ucwords( $message -> name ) ); ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px">Edit</span></a><?php } ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
      <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>"><?php
        $getNotes = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."comments LIMIT 5" );
          if ( $getNotes && $GLOBALS['JBLDB'] -> numRows( $getNotes ) > 0) { ?>
            <div class="mdl-card__title">
              <i class="material-icons">comment</i>
              <span class="mdl-button">Comments</span>
              <div class="mdl-layout-spacer"></div>
            </div>
            <div class="mdl-card__supporting-text mdl-card--expand">
              <ul class="collapsible popout" data-collapsible="accordion"><?php
              while ( $note = $GLOBALS['JBLDB'] -> fetchAssoc( $getNotes) ) { ?>
              <li>
              <div class="collapsible-header"><i class="material-icons">label_outline</i>

              <b><?php echo( $note['name'] ); ?></b><span class="alignright"><?php
              echo( $note['created'] ); ?></span>
              </div>
              <div class="collapsible-body"><span class="alignright">
              <a href="./notification?create=note&code=<?php echo( $note['author'] ); ?>" ><i class="material-icons">reply</i></a>
              <a href="./notification?view=<?php echo( $note['id'] ); ?>" ><i class="material-icons">open_in_new</i></a>
              <a href="./notification?delete=<?php echo( $note['id'] ); ?>" ><i class="material-icons">delete</i></a>
              </span>
              <span><?php
              echo( $note['details'] ); ?></span>
              </div>
              </li><?php
              } ?>
              </ul><?php
          } else {
          echo '<div class="mdl-card__title">
              <i class="material-icons">comments</i>
              <span class="mdl-card__title-text">No Comments</span>
              <div class="mdl-layout-spacer"></div>
            </div>';
          } ?>
        <div class="mdl-card__supporting-text mdl-card--expand">
        <p>Add Comment</p>
        <form>
          <div class="input-field">
            <input id="name" name="name" type="text">
            <label for="name">Title</label>
          </div>

          <div class="input-field">
            <textarea class="materialize-textarea col s12" id="details" name="details" ></textarea>
            <label for="details">Your Comment</label>
          </div>

          <div class="input-field">
            <button type="submit" name="" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored mdl-js-ripple-effect alignright"><i  class="material-icons">send</i></button>
          </div>
        </form>
      </div>
        </div>
      </div>
    </div><?php
} else {
  echo( 'No Message Found' );
}