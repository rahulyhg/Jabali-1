<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Signup page Layout
* @link https://docs.jabalicms.org/views/signup
* @author Mauko Maunde
* @since 0.17.09
* @license MIT - https://opensource.org/licenses/MIT
**/ ?>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--4-col"></div>
	<div id="login_div" class="mdl-cell mdl-cell--4-col <?php primaryColor(); ?>">
	<center><br><?php frontLogo();
	if ( isset( $_GET['create'] ) ) {
	if ( $_GET['create'] == "success" ) { ?>
	<div id="success" class="alert green">
	  <span>Success!<br>Check your email for a confirmation link</span>
	</div><?php 
	} elseif ( $_GET['create'] == "fail" ) { ?>
	<div id="fail" class="alert red">
	<span>Oops!<br>We Ran Into A Problem. Please Try Again</span>
	</div><?php 
	} elseif ( $_GET['create'] == "exists" ) { ?>
	<div id="exists" class="alert red">
	<span>Oops!<br>A User Already Exists With That Email. Please Try Again With A Different Email.</span>
	</div><?php 
	}
	} ?>
	</center>

	<form enctype="multipart/form-data" name="registerUser" method="GET" action="" class="mdl-grid">

	<div class="input-field mdl-cell mdl-cell--12-col">
	<i class="material-icons prefix">mail</i>
	<input id="email" name="email" type="text">
	<label for="email">Email Address</label>
	</div>

	<div class="input-field mdl-js-textfield getmdl-select mdl-cell mdl-cell--10-col">
	<i class="material-icons prefix">perm_identity</i>
	 <input class="mdl-textfield__input" id="type" name="type" type="text" readonly tabIndex="-1"><label for="type">Type</label>
	   <ul class="mdl-menu mdl-menu--top-left mdl-js-menu <?php primaryColor(); ?>" for="type" >
	     <li class="mdl-menu__item" data-val="organization">Organization<i class="mdl-color-text--white mdi mdi-city alignright" role="presentation"></i></li>
	     <li class="mdl-menu__item" data-val="editor">Buyer<i class="mdl-color-text--white mdi mdi-note alignright" role="presentation"></i></li>
	     <li class="mdl-menu__item" data-val="author">Seller<i class="mdl-color-text--white mdi mdi-note-plus alignright" role="presentation"></i></li>
	     <li class="mdl-menu__item" data-val="subscriber">Subscriber<i class="mdl-color-text--white mdi mdi-email alignright" role="presentation"></i></li>
	   </ul>
	</div>
	
	<button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="register" value="true"><i class="material-icons">arrow_forward</i></button>
	</form>  
	</div>
	<div class="mdl-cell mdl-cell--4-col"></div>
</div>