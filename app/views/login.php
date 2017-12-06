<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Login page Layout
* @link https://docs.jabalicms.org/views/login/
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.09
* @license MIT - https://opensource.org/licenses/MIT
**/ ?>
<div class="mdl-grid snow">
	<div class="mdl-cell mdl-cell--4-col"></div>
	<div id="login_div" class="mdl-cell mdl-cell--4-col <?php primaryColor(); ?>">
		<center>
			<?php echo '<br><a href="'._ROOT.'"><img src="'._IMAGES.'logo-w.png" width="150px;"></a>'; 
			if ( isset( $_GET['alert'] ) ) {
			if ( $_GET['alert'] == "password" ) {
				_shout_('Wrong Password! Please Try Again', 'error');
			} elseif ( $_GET['alert'] == "user" ) { 
				_shout_('Wrong ID/Email/Username! Please Try Again', 'error'); 
			}
			} ?>
			<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--12-col mdl-grid">
				<div class="mdl-cell mdl-cell--3-col"></div>
				<div class="mdl-cell mdl-cell--6-col">
					<a class="mdl-button mdl-button--icon indigo" href="<?php echo _ROOT; ?>/login/facebook">
						<i class="fa fa-facebook mdl-color-text--white"></i>
					</a>
					<a class="mdl-button mdl-button--icon light-blue" href="<?php echo _ROOT; ?>/login/twitter">
						<i class="fa fa-twitter mdl-color-text--white"></i>
					</a>
					<a class="mdl-button mdl-button--icon red" href="<?php echo _ROOT; ?>/login/google">
						<i class="fa fa-google mdl-color-text--white"></i>
					</a>
				</div>
				<div class="mdl-cell mdl-cell--3-col"></div>
			</div>
			<div class="mdl-cell mdl-cell--12-col">
				<form enctype="multipart/form-data" method="POST" action="" class="mdl-grid">
					<div class="input-field mdl-cell mdl-cell--12-col">
						<i class="material-icons prefix">perm_identity</i>
						<input name="user" id="email" type="text">
						<label for="email" class="center-align">ID, Username or Email</label>
					</div>

					<div class="input-field mdl-cell mdl-cell--12-col">
						<i class="material-icons prefix">lock</i>
						<input name="password" id="password" type="password">
						<label for="password">Password</label>
					</div>

					<div class="mdl-cell mdl-cell--8-col">
						<span class="prefix"></span>
						<input type="checkbox" id="remember-me" name="stay" />
						<label for="remember-me">Remember me</label>
						<hr style="visibility: hidden;">
						<span class="prefix"></span>
						<a class="" href="<?php echo( _ROOT ); ?>/forgot">Forgot password?</a>
					</div>
					<?php csrf(); ?>
					<div class="input-field input-field mdl-cell mdl-cell--4-col">
						<button class="mdl-button mdl-button--fab mdl-js-button mdl-button--raised green alignright" type="submit" name="login"><i class="material-icons">exit_to_app</i></button>
					</div>
				</form>
			</div>
		</center>
	</div>
	<div class="mdl-cell mdl-cell--4-col"></div>
</div>