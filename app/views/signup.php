<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Signup page Layout
* @link https://docs.jabalicms.org/views/signup
* @author Mauko Maunde
* @since 0.17.09
* @license MIT - https://opensource.org/licenses/MIT
*
**/ ?>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col"></div>
	<div id="login_div" class="mdl-cell mdl-cell--6-col <?php primaryColor(); ?>">
		<center>
			<?php frontLogo(); ?>
		</center>

		<form enctype="multipart/form-data" name="registerUser" method="POST" action="" class="mdl-grid">

		  <div class="input-field mdl-cell mdl-cell--6-col">
		  <i class="material-icons prefix">label</i>
		  <input id="fname" name="fname" type="text">
		  <label for="fname">First Name</label>
		  </div>
		         
		  <div class="input-field mdl-cell mdl-cell--6-col">
		  <i class="material-icons prefix">label_outline</i>
		  <input id="lname" name="lname" type="text">
		  <label for="lname">Last Name</label>
		  </div>

		  <div class="input-field mdl-cell mdl-cell--6-col">
		  <i class="material-icons prefix">mail</i>
		  <input class="validate" id="email" name="email" type="email" value="<?php echo( $_GET['email'] ); ?>">
		  <label for="email" data-error="Please enter a valid email" data-success="OK!" class="center-align">Email Address</label>
		  </div>

		  <div class="input-field mdl-cell mdl-cell--6-col">
		  <i class="material-icons prefix">phone</i>
		  <input  id="phone" name="phone" type="text" value="254">
		  <label for="phone" >Phone Number</label>
		  </div>

		  <?php if ( $_GET['type'] !== "organization" ) { ?>
		  <div class="input-field mdl-cell mdl-cell--6-col">
		  <i class="material-icons prefix">lock</i>
		  <input id="password" name="password" type="text">
		  <label for="password">Password</label>
		  </div><?php } ?>

		  <input type="hidden" name="type" value="<?php echo( $_GET['type'] ); ?>">

		  <div class="input-field mdl-cell mdl-cell--6-col mdl-js-textfield getmdl-select getmdl-select__fix-height">
		    <i class="material-icons prefix">room</i>
		  <input class="mdl-textfield__input" type="text" id="counties" name="location" readonly tabIndex="-1" ><label for="counties">Location</label>
		  <ul for="counties" class="mdl-menu mdl-menu--top-left mdl-js-menu <?php primaryColor(); ?>" style="max-height: 250px !important; overflow-y: auto;">
		      <?php 
		      $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kajiado, kakamega, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";

		      $cities = "baringo, bomet, Bungoma, Busia, Elgeyo/Marakwet, Embu, Garissa, Homa Bay, Isiolo, Kajiado, Kakamega, Kericho, Kiambu, Kilifi, Kirinyaga, Kisii, Kisumu, Kitui, Kwale, Laikipia, Lamu, Machakos, Makueni, Mandera, Marsabit, Meru, Migori, Mombasa, Murang'a, nairobi city, Nakuru, Nandi, Narok, Nyamira, Nyandarua, Nyeri, Samburu, Siaya, Taita/Taveta, Tana River, Tharaka-Nithi, Trans Nzoia, Turkana, Uasin Gishu, Vihiga, Wajir, West Pokot";
		      $counties = explode( ", ", $county_list );
		      for ( $c=0; $c < count( $counties ); $c++) {
		          $label = ucwords( $counties[$c] );
		          echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
		      }
		       ?>
		  </ul>
		  </div>

		  <?php if ( $_GET['type'] !== "organization" ) { ?>
		  <div class="input-field  mdl-cell mdl-cell--6-col mdl-js-textfield mdl-textfield--floating-label getmdl-select">
		    <i class="mdi mdi-gender-transgender prefix"></i>
		   <input class="mdl-textfield__input" id="gender" name="gender" type="text" readonly tabIndex="-1" ><label for="gender">Gender</label>
		     <ul class="mdl-menu mdl-menu--top-left mdl-js-menu <?php primaryColor(); ?>" for="gender">
		       <li class="mdl-menu__item" data-val="male">Male</li>
		       <li class="mdl-menu__item" data-val="female">Female</li>
		       <li class="mdl-menu__item" data-val="other">Other</li>
		     </ul>
		  </div>
		  <?php } ?>
		  <div class="input-field mdl-cell mdl-cell--5-col">
		  <button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="create"><i class="material-icons">send</i></button>
		  </div>
		</form>  
	</div>
	<div class="mdl-cell mdl-cell--3-col"></div>
</div>
<?php require 'footer.php';