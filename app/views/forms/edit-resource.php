<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Form
* @link https://docs.jabalicms.org/classes/forms/
* @author Mauko Maunde < hi@mauko.co.ke >
* @version 0.17.06
* @license MIT - https://opensource.org/licenses/MIT
**/

$getResourceCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."resources WHERE id = '".$code."'" );
if ( $getResourceCode -> num_rows > 0 ) {
  while ( $resourceDetails = $GLOBALS['JBLDB'] -> fetchAssoc( $getResourceCode ) ){
    $names = explode( " ", $resourceDetails['name'] );

    ?><title>Editing <?php echo( $resourceDetails['name']." [ ".showOption( 'name' )." ]</title>" ); ?>
    <form enctype="multipart/form-data" name="registerResource" method="POST" action="<?php echo( _ADMIN.'resource?create' ); ?>" class="mdl-grid" >
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
          <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">

              <div class="mdl-card__supporting-text mdl-card--expand mdl-grid ">
                <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">

                  <div class="input-field">
                  <i class="material-icons prefix">label</i>
                  <input id="name" name="name" type="text" value="<?php echo( $resourceDetails['name'] ); ?>">
                  <label for="name">Resource Name</label>
                  </div>

                  <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                  <i class="material-icons prefix">business</i>
                   <input class="mdl-textfield__input" id="type" name="type" type="text" readonly tabIndex="-1" placeholder="<?php echo( ucwords( $resourceDetails['type'] ) ); ?>" value="<?php echo( ucwords( $resourceDetails['type'] ) ); ?>" >
                     <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu <?php primaryColor(); ?>" for="type">
                       <li class="mdl-menu__item" data-val="center">Center</li>
                       <li class="mdl-menu__item" data-val="equipment">Equipment</li>
                       <li class="mdl-menu__item" data-val="lab">Lab</li>
                       <li class="mdl-menu__item" data-val="ward">Ward</li>
                     </ul>
                  </div>

                  <div class="input-field inline">
                  <i class="material-icons prefix">phone</i>
                  <input  id="phone" name="phone" type="text" value="<?php echo( $resourceDetails['phone'] ); ?>">
                  <label for="phone" class="center-align">Contact Phone</label>
                  </div>

                  <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                    <i class="material-icons prefix">room</i>
                  <input class="mdl-textfield__input" type="text" id="counties" name="location" readonly tabIndex="-1" placeholder="<?php echo( ucwords( $resourceDetails['location'] ) ); ?>" value="<?php echo( ucwords( $resourceDetails['location'] ) ); ?>">
                  <ul for="counties" class="mdl-menu mdl-menu--bottom-left mdl-js-menu <?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                      <?php
                      $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kakamega, kajiado, kapenguria, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, ol kalou, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";
                      $counties = explode( ", ", $county_list );
                      for ( $c=0; $c < count( $counties ); $c++ ) {
                          $label = ucwords( $counties[$c] );
                          echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
                      }
                       ?>
                  </ul>
                  </div>

                  <?php if ( $resourceDetails['type'] !== "organization"  ) { ?>
                  <div class="input-field">
                  <i class="material-icons prefix">business</i>
                  <input id="company" name="company" type="text" value="<?php echo( $resourceDetails['company'] ); ?>">
                  <label for="company">Center</label>
                  </div>
                  <?php } ?>

                  <div class="input-field">
                  <i class="material-icons prefix">mail</i>
                  <input class="validate" id="email" name="email " type="email" value="<?php echo( $resourceDetails['email'] ); ?>">
                  <label for="email" class="center-align">Admin Email</label>
                  </div>

                  <div class="input-field">
                  <i class="mdi mdi-bio prefix"></i>
                  <textarea class="materialize-textarea col s12" rows="5" id="details" name="details" >
                  <?php echo( $resourceDetails['details'] ); ?>
                  </textarea>
                  <script>CKEDITOR.replace( 'details' );</script>
                  <label for="details">Bio</label>
                  </div>

                  <br>
                  </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                <script>
                 function chooseFile() {
                    $( "#avatar" ).click();
                 }
               </script>
                  <div style="height:0px;overflow:hidden">
                     <input type="file" id="fileInput" name="avatar" />
                  </div>
                  <img id="havatar" onclick="chooseFile();" src="<?php echo( $resourceDetails['avatar'] ); ?>" width="100%" onclick="chooseFile();">

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
                  <span style="position: relative; bottom: 50px;left: 50%"><i class="material-icons">edit</i></span>
                  <center><br>

                  <div class="input-field">
                      <button type="submit" name="update" class="mdl-button mdl-button--fab"><i class="material-icons">save</i></button>
                  </div>
                  </center>
                </div>
              </div>
          </div>
      </div>
    </form><?php
  }
} else {
  echo 'Resource Not Found';
}
}