<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Form
* @link https://docs.jabalicms.org/classes/forms/
* @author Mauko Maunde < hi@mauko.co.ke >
* @version 0.17.06
* @license MIT - https://opensource.org/licenses/MIT
**/
$user = $GLOBALS['USERS'] -> getsId( $data );
if ( !isset( $user['error'] ) ) {
    $names = explode( " ", $user['title'] ); ?>
    <form enctype="multipart/form-data" name="editUser" method="POST" action="" class="mdl-grid" >
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone <?php primaryColor(); ?> mdl-card mdl-shadow--2dp">
          <div class="mdl-card__supporting-text mdl-grid">
            <div class="input-field mdl-cell mdl-cell--6-col">
              <i class="material-icons prefix">label</i>
              <input id="fname" name="fname" type="text" value="<?php echo( $names[0] ); ?>">
              <label for="fname">First Name</label>
            </div>

            <div class="input-field mdl-cell mdl-cell--6-col">
              <i class="material-icons prefix">label_outline</i>
              <input id="lname" name="lname" type="text" value="<?php echo( $names[1] ); ?>">
              <label for="lname">Last Name</label>
            </div>

            <div class="input-field mdl-cell mdl-cell--6-col mdl-js-textfield mdl-textfield--floating-label getmdl-select">
              <i class="material-icons prefix">donut_large</i>
               <input class="mdl-textfield__input" id="type" name="type" type="text" readonly tabIndex="-1" placeholder="<?php echo( ucfirst( $user['type'] ) ); ?>" value="<?php echo( ucwords( $user['type'] ) ); ?>">
              <label for="type" class="center-align">Type</label>
                 <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu <?php primaryColor(); ?>" for="type"><?php
                   if ( isCap( "admin" )  ) {
                    echo( '<li class="mdl-menu__item" data-val="admin">Admin</li>' );
                   } ?>
                   <li class="mdl-menu__item" data-val="organization">Organization<i class="mdl-color-text--white mdi mdi-city alignright" role="presentation"></i></li>
                   <li class="mdl-menu__item" data-val="editor">Editor<i class="mdl-color-text--white mdi mdi-note alignright" role="presentation"></i></li>
                   <li class="mdl-menu__item" data-val="author">Author<i class="mdl-color-text--white mdi mdi-note-plus alignright" role="presentation"></i></li>
                   <li class="mdl-menu__item" data-val="subscriber">Subscriber<i class="mdl-color-text--white mdi mdi-email alignright" role="presentation"></i></li>
                 </ul>
            </div>

            <?php if ( $user['type'] !== "organization"  ) { ?>
              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                <i class="mdi mdi-gender-<?php echo( strtolower( $user['gender'] ) ); ?> prefix"></i>
                 <input class="mdl-textfield__input" id="gender" name="gender" type="text" readonly tabIndex="-1" placeholder="<?php echo( strtolower( $user['gender'] ) ); ?>" value="<?php echo( ucwords( $user['gender'] ) ); ?>">
              <label for="gender" class="center-align">Gender</label>
                   <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu <?php primaryColor(); ?>" for="gender">
                     <li class="mdl-menu__item" data-val="male">Male</li>
                     <li class="mdl-menu__item" data-val="female">Female</li>
                     <li class="mdl-menu__item" data-val="other">Other</li>
                   </ul>
              </div><?php 
            } ?>

            <div class="mdl-cell mdl-cell--3-col">
              <?php $GLOBALS['UNI'] -> countries(); ?>
            </div>

            <div class="mdl-cell mdl-cell--3-col">
              <?php $GLOBALS['UNI'] -> regions( getOption( 'country' ) ); ?>
            </div>

            <div class="mdl-cell mdl-cell--3-col">
              <?php $GLOBALS['UNI'] -> keCities(); ?>
            </div>

            <div class="input-field mdl-cell mdl-cell--6-col">
              <i class="material-icons prefix">phone</i>
              <input  id="phone" name="phone" type="text" value="<?php echo( $user['phone'] ); ?>">
              <label for="phone" class="center-align">Phone Number</label>
            </div>

            <div class="input-field mdl-cell mdl-cell--6-col">
              <i class="material-icons prefix">mail</i>
              <input class="validate" id="email" name="email" type="email" value="<?php echo( $user['email'] ); ?>">
              <label for="email" class="center-align">Email Address</label>
            </div>

            <div class="input-field mdl-cell mdl-cell--12-col">
              <i class="mdi mdi-bio prefix"></i>
              <textarea class="materialize-textarea col s12" rows="5" id="details" name="details" ><?php echo( $user['details'] ); ?></textarea>
              <script>CKEDITOR.replace( 'details' );</script>
            </div>

          <div class="input-field mdl-cell--12-col">
            <i class="material-icons prefix">description</i>
            <textarea  id="tags" name="tags" type="text" class="materialize-textarea" rows="8"><?php echo( $user['tags'] ); ?></textarea>
            <label for="details" class="center-align"><?php echo( ucwords( $user['type'] ) ); ?> Skills or tags.</label>
          </div>

          </div><div class="mdl-card__menu mdl-button mdl-button--icon">
            <a href="<?php echo( _ROOT.'/users/'.$user['username'] ); ?>/" target="_blank" >
            <i class="material-icons">open_in_new</i>
            </a>
          </div>
        </div>

        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone <?php primaryColor(); ?> mdl-card">
          <div class="mdl-card__image">
          <div style="height:0px;overflow:hidden">
             <input type="file" id="avatar" name="new_avatar" />
             <input type="hidden" id="the_avatar" name="the_avatar" value="<?php echo( $user['avatar'] ); ?>" />
          </div><?php $savatar = getimagesize( $user['avatar'] ) ? $user['avatar'] : _IMAGES.'avatar.png'; ?>
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
            </script>

              <script>
             function chooseFile() {
                $( "#avatar" ).click();
             }
           </script>
         </div>
         <div class="mdl-card__supporting-text">

          <div class="input-field">
            <i class="material-icons prefix">lock</i>
            <input id="password" name="newpassword" type="text" value="">
            <label for="password">Change Password</label>
          </div><?php
          $social = json_decode( $user['social'] );
          foreach ($social as $key => $value) { ?>
          <div class="input-field">
          <i class="fa fa-<?php echo( $key ); ?> prefix"></i>
          <input id="<?php echo( $key ); ?>" name="social[<?php echo( $key ); ?>]" type="text" value="<?php echo( $value ); ?>">
          <label for="<?php echo( $key ); ?>"><?php echo( ucwords( $key ) ); ?></label>
          </div><?php } ?>
          <div class="">
            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2">
              <input type="checkbox" id="switch-2" class="mdl-switch__input" checked> <span style="padding-left: 20px;">Online/Offline</span>
            </label>
          </div>
          <input type="hidden" name="id" value="<?php echo( $data ); ?>" >
          <input type="hidden" name="style" value="<?php echo( $user['style'] ); ?>" >
          <input type="hidden" name="username" value="<?php echo( $user['username'] ); ?>" >
          <input type="hidden" name="categories" value="<?php echo( $user['categories'] ); ?>" >
          <input type="hidden" name="password" value="<?php echo( $user['password'] ); ?>" >
          <?php csrf(); ?>
              <button type="submit" name="update" class="mdl-button mdl-button--fab mdl-button--colored addfab"><i class="material-icons">save</i></button>
        </div>

        </div>
    </form><?php
} else {
  echo 'User Not Found';
}