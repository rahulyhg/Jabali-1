<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Form
* @link https://docs.jabalicms.org/classes/forms/
* @author Mauko Maunde < hi@mauko.co.ke >
* @version 0.17.06
* @license MIT - https://opensource.org/licenses/MIT
**/ ?>
<title><?php echo( $resourceDetails['title'] ); ?> Create <?php echo( ucfirst( $_GET['create'] ) ); ?> - <?php showOption( 'name' ); ?></title>
        <div class="mdl-cell mdl-cell--12-col mdl-grid <?php primaryColor(); ?>">
        <form enctype="multipart/form-data" name="registerResource" method="POST" action="<?php echo( _ADMIN."resource?create=organization" ); ?>" class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-grid">
            <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">

              <div class="input-field">
                <i class="material-icons prefix">label</i>
              <input id="name" name="title" type="text" >
              <label for="name">Resource Name</label>
              </div>

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                <i class="material-icons prefix">donut_large</i>
                 <input class="mdl-textfield__input" id="type" name="type" type="text" readonly tabIndex="-1" placeholder="Type" >
                   <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu <?php primaryColor(); ?>" for="type">
                     <li class="mdl-menu__item" data-val="ambulance">Ambulance</li>
                     <li class="mdl-menu__item" data-val="lab">Lab</li>
                     <li class="mdl-menu__item" data-val="ward">Ward</li>
                     <li class="mdl-menu__item" data-val="morgue">Morgue</li>
                   </ul>
                </div>

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">room</i>
              <input class="mdl-textfield__input" type="text" id="counties" name="location" readonly tabIndex="-1" value="<?php echo( ucwords( $_SESSION[JBLSALT.'Location'] ) ); ?>">
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

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">business</i>
              <input class="mdl-textfield__input" type="text" id="centers" name="company" readonly tabIndex="-1" placeholder="Organization">
              <ul for="centers" class="mdl-menu mdl-menu--bottom-left mdl-js-menu <?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                  <?php
                  $centers = $GLOBALS['JBLDB'] -> query( "SELECT name, id FROM ". _DBPREFIX ."users WHERe type = 'center' ORDER BY name" );
                  if ( $GLOBALS['JBLDB'] -> numRows( $centers ) > 0 );
                  while ( $center = $GLOBALS['JBLDB'] -> fetchAssoc( $centers ) ) {
                      echo '<li class="mdl-menu__item" data-val="'.$center['id'].'">'.$center['title'].'</li>';
                  }
                   ?>
              </ul>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">phone</i>
              <input  id="phone" name="phone" type="text" value="<?php echo( $_SESSION[JBLSALT.'Phone'] ); ?>" >
              <label for="phone" class="center-align">Contact Phone</label>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">mail</i>
              <input class="validate" id="email" name="email " type="email" value="<?php echo( $_SESSION[JBLSALT.'Email'] ); ?>">
              <label for="email" data-error="wrong" data-success="right" class="center-align">Admin Email</label>
              </div>

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">face</i>
              <input class="mdl-textfield__input" type="text" id="doctors" name="by" readonly tabIndex="-1" placeholder="Doctor In Charge">
              <ul for="doctors" class="mdl-menu mdl-menu--bottom-left mdl-js-menu <?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                  <?php
                  $centers = $GLOBALS['JBLDB'] -> query( "SELECT name, id FROM ". _DBPREFIX ."users WHERe type = 'doctor' ORDER BY name" );
                  if ( $GLOBALS['JBLDB'] -> numRows( $centers ) > 0 );
                  while ( $center = $GLOBALS['JBLDB'] -> fetchAssoc( $centers ) ) {
                      echo '<li class="mdl-menu__item" data-val="'.$center['id'].'">'.$center['title'].'</li>';
                  }
                   ?>
              </ul>
              </div>
              <input type="hidden" name="author" value="<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>">

              <div class="input-field">
                <i class="material-icons prefix">description</i>
              <textarea  id="details" name="details" type="text" class="materialize-textarea">Details about resource.</textarea>
              <label for="details" class="center-align">About</label>
              </div>

              <br>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
              <script>
                 function chooseFile() {
                    $( "#fileInput" ).click();
                 }
              </script>
              <div class="input-field inline">
                <div style="height:0px;overflow:hidden">
                  <input id="avatar" type="file" name="avatar" value="<?php echo( _IMAGES.'placeholder.png' ); ?>">
                </div>
                <img id="havatar" onclick="chooseFile();" src="../assets/images/placeholder.png" width="100%"></i>
                </div>
                <script>
                     function chooseFile() {
                        $( "#avatar" ).click();
                     }

                     function readURL(input ) {
                      if ( input.files && input.files[0]  ) {
                          var reader = new FileReader();

                          reader.onload = function (e ) {
                              $('#havatar' )
                                  .attr('src', e.target.result )
                                  .width(150 )
                                  .height(200 );
                          };

                          reader.readAsDataURL(input.files[0] );
                      }
                  }
                  </script>

              <div class="input-field">
                <input type="checkbox" id="remember-me" name="status" name="active"/>
                <label for="remember-me">Available</label>

              <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect alignright" type="submit" style="margin-left: 150px;margin-top: 100px;" name="register"><i class="material-icons">save</i></button>
              </div>
          </div>
        </form>
        </div>