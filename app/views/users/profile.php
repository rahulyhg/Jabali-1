<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Single User View
* @link https://docs.jabalicms.org/views/
* @author Mauko Maunde
* @since 0.17.10
* @license MIT - https://opensource.org/licenses/MIT
**/

$user = $GLOBALS['USERS'] -> getId( $data );
$GLOBALS['grecord'] = $user;
if ( !isset( $user['error'] ) ) {
  if ( $_SESSION[JBLSALT.'Code'] !== $user['id'] ) {
    $name = explode( " ", $user['name'] );
    $greettype = 'About '.ucfirst( $name[0] );
  } else {
    $name = explode( " ", $user['name'] );
    $greettype = '<b>Hello </b> '.ucfirst( $name[0] )."!";
  } ?>
  <title><?php echo( $user['name'] ); ?> - <?php showOption( 'name' ); ?></title>
  <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
    <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
      <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
        <div class="mdl-cell mdl-cell--7-col-desktop mdl-cell--7-col-tablet mdl-cell--12-col-phone">
          <h5>
            <i class="mdi mdi-<?php 
              if ( strtolower( $user['type'] ) == "organization" ) { 
                  echo "city";
              } else {
                  if ( strtolower( $user['gender'] ) == "male" ) {
                    echo "gender-male";
                  } elseif ( strtolower( $user['gender'] ) == "female" ) {
                    echo "gender-female";
                  } else {
                    echo "transgender";
                  }
              } ?> mdl-button-icon mdl-badge mdl-badge--overlap alignright">
            </i>
          <h5>
          <h6><b>Email:</b> <?php theEmail(); ?><br><?php if ( $user['type'] !== "organization" ) { ?>
          <b>Organization:</b> <a href="./resource?organization=<?php echo( ucwords( $user['company'] ) ); ?>"><?php echo( $user['company'] ); ?></a><br><?php } ?>
          <b>Location:</b> <a href="?location=<?php echo( $user['location'] ); ?>"><?php echo( ucwords( $user['location'] ) ); ?></a><br>
          <b>Phone:</b> <a href="tel:<?php echo( $user['phone'] ); ?>"><?php echo( $user['phone'] ); ?></a></h6>
          <a href="tel:<?php echo( $user['phone'] ); ?>"><i class="material-icons">phone</i></a>
          <?php theEmail('<i class="material-icons">mail_outline</i>'); ?>
          <a href="./message?create=message&for=<?php echo( $user['id'] ); ?>"><i class="material-icons">message</i></a>
        </div>
        <div class="mdl-cell mdl-cell--5-col-desktop mdl-cell--5-col-tablet mdl-cell--12-col-phone mdl-grid">
          <div class="mdl-cell mdl-cell--12-col">
            <?php $avatar = getimagesize( $user['avatar'] ) ? $user['avatar'] : _IMAGES.'avatar.png'; ?>
            <img src="<?php echo( $avatar ); ?>" width="100%">
          </div>
          <div class="mdl-cell mdl-cell--12-col">
            <center><?php
              $social = json_decode( $user['social'] ); 
              foreach ($social as $key => $value) { ?>
                <div style="display: inline;">
                  <a href="<?php echo( $value ); ?>" type="text" value="<?php echo( $value ); ?>">
                  <i class="fa fa-<?php echo( $key ); ?> fa-2x"></i></a>
                </div><?php 
              } ?>
            </center>
          </div>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
          <div>
            <?php theContent(); ?>
            </div>
        </div>
        <div>
          <h6>
            <b>Joined:</b> <?php theDate(); ?> at <?php theDate( 'H:i:s' ); ?>
          </h6>
        </div>
      </div>

      <div class="mdl-card__menu"><?php if ( strtolower( $user['type'] ) == "organization" ) { ?>
          <a href="./resource?author=<?php echo( $user['id'] ); ?>" class="material-icons mdl-badge mdl-badge--overlap">business</a><?php } ?>
          <a href="./users?view=<?php echo( $user['id'] ); ?>&key=<?php echo( $user['name'] ); ?>&fav=true" class="material-icons mdl-badge mdl-badge--overlap">favorite</a><?php 
          if ( isCap( 'admin' ) || isProfile( $user['id'] ) ) { ?>
          <a href="./users?edit=<?php echo( $user['id'] ); ?>&key=<?php echo( $user['name'] ); ?>" ><i class="material-icons">edit</i></a><?php } ?>
      </div>
    </div>
  </div>

  <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
      <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>"><?php 
            $getNotes = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."comments WHERE author = '".$user['id']."'" );
            if ( $getNotes && $GLOBALS['JBLDB'] -> numRows( $getNotes ) > 0) { ?>
              <div class="mdl-card__title">
              <i class="material-icons">query_builder</i>
                <span class="mdl-button">Recently From <?php echo( ucfirst( $name[0] ) ); ?></span>
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card__subtitle-text">
                <a href="./message?chat=<?php echo( $user['id'] ); ?>" ><i class="material-icons">question_answer</i></a>
              </div>
              </div>
              <div class="mdl-card__supporting-text">
                <ul class="collapsible popout" data-collapsible="accordion"><?php 
                    while ( $note = $GLOBALS['JBLDB'] -> fetchAssoc( $getNotes) ) { ?>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">label_outline</i>
                        
                          <b><?php echo( $note['name'] ); ?></b><span class="alignright"><?php 
                          echo( $note['created'] ); ?></span>
                      </div>
                      <div class="collapsible-body"><span class="alignright">
                          <a href="./message?create=note&code=<?php echo( $note['author'] ); ?>" ><i class="material-icons">reply</i></a> 
                          <a href="./message?view=<?php echo( $note['id'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
                          <a href="./message?delete=<?php echo( $note['id'] ); ?>" ><i class="material-icons">delete</i></a>
                          </span>
                          <span><?php 
                          echo( $note['details'] ); ?></span>
                      </div>
                    </li><?php 
                    } ?>
              </ul>
              </div><?
            } else { ?>
            <div class="mdl-card__title"><?php if( !isProfile( $user['id'] ) ) { ?>
              <div class="mdl-card__title-text">
                <span><b>Contact </b><?php echo( ucfirst( $name[0] ) ); ?></span>
              </div>
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card__subtitle-text">
                <a href="./message?create=message&code=<?php echo( $user['id'] ); ?>" class="material-icons mdl-badge mdl-badge--overlap">message</a>
              </div><?php } ?>
            </div><?php 
          }
        ?>
      </div>
  </div><?php
} else {
  echo 'User Not Found';
}