<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Form
* @link https://docs.jabalicms.org/classes/forms/
* @author Mauko Maunde < hi@mauko.co.ke >
* @version 0.17.06
* @license MIT - https://opensource.org/licenses/MIT
**/ ?>
<div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand <?php primaryColor(); ?>">
        <div class="mdl-card__supporting-text mdl-card--expand">
            <form enctype="multipart/form-data" name="messageForm" method="POST" action="">
              <title>Compose <?php echo ucfirst( $_GET['create'] ); ?> - <?php showOption( 'name' ); ?></title>

                <div class="input-field">
                  <i class="material-icons prefix">label</i>
                  <input id="subject" type="text" name="title" >
                  <label for="subject" class="center-align">Subject</label>
                </div><?php

                if ( isset( $_GET['code'] )  ) { ?>
                  <input type="hidden" name="receipient" value="<?php echo( $_GET['code'] ); ?>"><?php
                } else { ?>
                  <div class="input-field inline getmdl-select getmdl-select__fix-height">
                    <i class="material-icons prefix">perm_identity</i>
                    <input class="mdl-textfield__input" type="text" id="for" name="receipient" readonly tabIndex="-1" placeholder="Select Receipient">
                    <ul for="for" class="mdl-menu mdl-menu--bottom-left mdl-js-menu <?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;"><?php
                        $centers = $GLOBALS['JBLDB'] -> query( "SELECT name, avatar, id FROM ". _DBPREFIX ."users ORDER BY name" );
                        if ( $GLOBALS['JBLDB'] -> numRows( $centers ) > 0 );
                        while ( $center = $GLOBALS['JBLDB'] -> fetchAssoc( $centers ) ) {
                          echo( '<li class="mdl-menu__item" data-val="'.$center['id'].'">'.$center['title'].'<span style=""><img class="alignright" style="padding-right:20px;margin:auto;" src="'.$center['avatar'].'" height="18px;"></span></li>' );
                        } ?>
                    </ul>
                  </div><?php
                } ?>

                <div class="input-field inline getmdl-select getmdl-select__fix-height">
                  <i class="material-icons prefix">perm_identity</i>
                  <input class="mdl-textfield__input" type="text" id="forc" name="forc" readonly tabIndex="-1" placeholder="Cc/Bcc">
                  <ul for="forc" class="mdl-menu mdl-menu--bottom-left mdl-js-menu <?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;"><?php
                      $centers = $GLOBALS['JBLDB'] -> query( "SELECT name, avatar, id FROM ". _DBPREFIX ."users ORDER BY name" );
                      if ( $GLOBALS['JBLDB'] -> numRows( $centers ) > 0 );
                      while ( $center = $GLOBALS['JBLDB'] -> fetchAssoc( $centers ) ) {
                        echo( '<li class="mdl-menu__item" data-val="'.$center['id'].'">'.$center['title'].'<span style=""><img class="alignright" style="padding-right:20px;margin:auto;" src="'.$center['avatar'].'" height="18px;"></span></li>' );
                      } ?>
                  </ul>
                </div>

                <input type="hidden" name="author" value="<?php echo $_SESSION[JBLSALT.'Code']; ?>">
                <input type="hidden" name="author_name" value="<?php echo $_SESSION[JBLSALT.'Alias']; ?>">
                <input type="hidden" name="email " value="<?php echo $_SESSION[JBLSALT.'Email']; ?>">
                <input type="hidden" name="level" value="private">
                <input type="hidden" name="phone" value="<?php echo $_SESSION[JBLSALT.'Phone']; ?>">
                <input type="hidden" name="type" value="<?php echo $_GET['create']; ?>">

                <div class="input-field">
                  <p>Your Message</p>
                  <textarea class="materialize-textarea col s12" type="text" id="details" rows="5" name="details"></textarea><script>CKEDITOR.replace( 'details' );</script>
                </div>

                <div class="file-field input-field inline">
                  <div class="btn <?php primaryColor(); ?>">
                    <span class="material-icons">attach_file</span>
                    <input type="file" multiple>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Attach files">
                  </div>
                </div>
                <?php csrf(); ?>
                <div class="input-field inline alignright">
                  <button class="mdl-button mdl-button--fab alignright mdl-button--colored" type="submit" name="create"><i class="material-icons">send</i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand <?php primaryColor(); ?>">
        
    </div>