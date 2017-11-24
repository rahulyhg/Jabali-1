<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Single Post View
* @link https://docs.jabalicms.org/views/
* @author Mauko Maunde
* @since 0.17.10
* @license MIT - https://opensource.org/licenses/MIT
**/
$post = $GLOBALS['POSTS'] -> getId( $data );
if ( !isset( $post['error'] ) ) {
  $post = (object)$post; ?>
    <title><?php echo( ucwords( $post -> name ) ); ?> - <?php showOption( 'name' ); ?></title>
    <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
      <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
          <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
            <h4><?php echo( $post -> subtitle ); ?></h4>
            <h6>Published: <?php echo( $post -> created ); ?></h6>
            <h6>Authored by: <a href="./users?view=<?php echo( $post -> author .'&key='.$post -> author_name ); ?>"><?php echo( $post -> author_name ); ?></a></h6>
            <h6>Category: <?php echo( $post -> categories ); ?></h6>
            <h6>Tagged: <?php echo( ucwords( $post -> tags ) ); ?></h6>
            <h6>Readings: <?php echo( ucwords( $post -> tags ) ); ?></h6>
          </div>
          <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
            <img src="<?php echo( $post -> avatar ); ?>" width="100%">
          </div>
        </div>
        <div class="mdl-card__supporting-text mdl-card--expand">
          <span><?php echo( $post -> details ); ?></span>
        </div>
        <div class="mdl-card__menu">
          <a href="<?php echo( $post -> link ); ?>" class="mdl-button mdl-button--icon"><i class="material-icons red-text">open_in_new</i></a>
          <?php if ( isCap( 'admin' ) || isAuthor( $post -> author ) ) { ?>
          <a href="./posts?edit=<?php echo( $post -> id ); ?>&key=<?php echo( ucwords( $post -> name ) ); ?>" class="mdl-button mdl-button--icon"><i class="material-icons red-text">edit</i></a>

          <button type="submit" name="delete" value="<?php echo( $post -> id ); ?>" class="mdl-button mdl-button--icon"><i class="material-icons red-text">delete</i></button>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
      <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>"><?php
        $getNotes = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."comments LIMIT 5" );
          if ( $getNotes && $GLOBALS['JBLDB'] -> numRows( $getNotes ) > 0) { ?>
            <div class="mdl-card__title">
              <div class="mdl-card__title-text">
              <span class="">Comments</span>
              </div>
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card__subtitle-text">
              <i class="material-icons">comment</i>
              </div>
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
              <div class="mdl-card__title-text">
              <span class="">No Comments</span>
              </div>
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card__subtitle-text">
              <i class="material-icons">comment</i>
              </div>
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
  echo( 'No Post Found' );
}