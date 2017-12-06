<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Forgot password page Layout
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.09
* @link https://docs.jabalicms.org/views/forgot/
* @license MIT - https://opensource.org/licenses/MIT
**/ ?>
<div class="mdl-grid snow">
	<div class="mdl-cell mdl-cell--4-col"></div>
	<div id="login_div" class="mdl-cell mdl-cell--10-col <?php primaryColor(); ?>">
		<center><?php jblLogo(); ?></center>
		<form enctype="multipart/form-data" method="POST" action="" class="mdl-grid">

			<div class="input-field mdl-cell mdl-cell--10-col">
			<i class="material-icons prefix">mail</i>
			<input class="validate" name="email" id="email" type="email">
			<label for="email" data-error="Please Enter A Valid Email Address" data-success="Okay. Press the buton to submit" class="center-align">Enter Your Email Address</label>
			</div>

			<div class="input-field mdl-cell mdl-cell--2-col">
			<button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="forgot"><i class="material-icons">send</i></button>
			</div>

		</form>
	</div>
	<div class="mdl-cell mdl-cell--4-col"></div>
</div>