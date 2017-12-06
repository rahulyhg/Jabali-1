<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage App Update API
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.04
* @link https://docs.jabalicms.org/update/
**/
session_start();
require_once( '../init.php' );
require_once( '../load.php' );
require_once( 'header.php' );
ini_set('max_execution_time',60); ?>
<title>Update Jabali - <?php showOption( 'name' ); ?></title>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp <?php primaryColor(); ?>"><?php

		$jJson = file_get_contents( _ROOT."/package.json" );
		$jD = json_decode( $jJson, true );
		$curr_version = $jD['version'];

		$nJson = file_get_contents( /**"https://jabalicms.org/api/"**/ 'https://cdn.mauko.co.ke/api' ); 
		if( !$nJson ){ ?>
			<div class="mdl-card__title">
				<span class="mdl-card__title-text">
					Oops! Something went wrong.
				</span>
				<div class="mdl-layout-spacer"></div>
				<div class="mdl-card__subtitle-text">
				    <i class="material-icons">error</i>
				</div>
			</div>
			<div class="mdl-card__supporting-text">
				<h4>Could Not Get Update Information</h4>
				<h5>We could not connect to <a href="https://mauko.co.ke">https://mauko.co.ke</a> to check for updates.</h5>
				<h6>You can try the following:</h6>
				<ul>
					<li>Check your internet connection.</li>
					<li>Check your app's configuration.</li>
				</ul>
			</div><?php
		} else {
			$nJD = json_decode( $nJson, true );
			$new_version = $nJD['version'];
			if ( $curr_version > $new_version) { ?>
				<div class="mdl-card__title">
					<span class="mdl-card__title-text">
						You like it buggy, ey?
					</span>
					<div class="mdl-layout-spacer"></div>
					<div class="mdl-card__subtitle-text">
					    <i class="material-icons">error</i>
					</div>
				</div>
				<div class="mdl-card__supporting-text">
					<h4>You are using a development version of Jabali - <?php echo( $curr_version ); ?></h4>
					<h5>Found some bugs? We'd love to hear from you!</h5>
					<ol>
						<li>Drop us an email at dev@jabalicms.org.</li>
						<li>Raise an issue <a href="https://github.com/JabaliCMS/Jabali/issues">here</a></li>
						<li>Fork us on <a href="https://github.com/JabaliCMS/Jabali">Github</a>, do your magic and make a pull request.</li>
					</ol>
				</div><?php
			} elseif ( $curr_version < $new_version ) { ?>
				<div class="mdl-card__title">
					<span class="mdl-card__title-text">
						Jabali Version <?php echo( $new_version ); ?> Available!
					</span>
					<div class="mdl-layout-spacer"></div>
					<div class="mdl-card__subtitle-text">
					    <i class="material-icons">error</i>
					</div>
				</div>
				<div class="mdl-card__supporting-text"><?php
					if ( !is_file(  _ABSTEMP_.'update/jabali-'.$new_version.'.zip' ) ) { 
						echo '<p>Downloading New Update...</p>';
						if ( fopen('https://jabalicms.org/dl/jabali/jabali_'.$new_version.'.zip', 'r') ) {
							$newUpdate = file_get_contents('https://jabalicms.org/dl/jabali/jabali_'.$new_version.'.zip');

							$directory = _ABSTEMP_ . "update/";

							if ( !is_dir( $directory) ) {
							  mkdir( $directory, 0777, true );
							  echo( '<p>Created temporay directory for saving update.</p>' );
							}

							$dlHandler = fopen(_ABSTEMP_.'update/jabali-'.$new_version.'.zip', 'w');
							  echo( '<p>Getting and saving update files...</p>' );

							if ( !fwrite($dlHandler, $newUpdate) ) { 
								echo '<p>Could not save new update. Operation aborted.</p>'; 
								exit(); 
							} else {
								echo '<p>Update downloaded and saved <a href="?do=update">Update now?</a></p>';
							}

							fclose($dlHandler);
						} else {
							echo '<p>Could not get update.</p>';
						}
					}

					if ( isset( $_GET['do'] ) ) {

						$maint = fopen( _ABS_.'.jbl', 'r');
						fclose($maint);

						//The update magic
						//Here, we open the downloaded zip file and copy new files/directories
						$zipHandle = zip_open( _ABSTEMP_.'/update/jabali-'.$new_version.'.zip' );
						echo '<ul>';
						while ($aF = zip_read($zipHandle) ) {
							$thisFileName = zip_entry_name($aF);
							$thisFileDir = dirname($thisFileName);
						   
							//Continue if its not a file
							if ( substr($thisFileName,-1,1) == '/') continue;
						   

							//Create new directories if we need to...
							if ( !is_dir ( _ABS_ . $thisFileDir ) ) {
								mkdir ( _ABS_ . $thisFileDir );
								echo '<li>Created Directory '.$thisFileDir.'</li>';
							}
						   
							//Overwrite old files
							if ( !is_dir( _ABS_.$thisFileName ) ) {
								echo '<li>'.$thisFileName.'...........';
								$contents = zip_entry_read( $aF, zip_entry_filesize( $aF ) );
								$contents = str_replace( "rn", "n", $contents );
								$updateThis = '';
							   
								//If we need to run commands, then do it.
								if ( $thisFileName == 'update.php' ) {
									$upgradeExec = fopen ('update.php','w');
									fwrite($upgradeExec, $contents);
									fclose($upgradeExec);
									include ('update.php');
									unlink('update.php');
									echo' EXECUTED</li>';
								} else {
									$updateThis = fopen(_ABS_.$thisFileName, 'w');
									fwrite($updateThis, $contents);
									fclose($updateThis);
									unset($contents);
									echo' UPDATED</li>';
								}
							}
						}
						echo '</ul>';
						$updated = TRUE;
						unlink( _ABS_.'.jbl' );
					} else { ?>
						<h3>Jabali <?php echo( $new_version ); ?> is Ready!</h3><?php
					} ?>
				</div>
				<div class="mdl-card__menu alignright">
					<a class="mdl-button mdl-button--fab mdl-button--colored" id="updatenow" href="?settings=update&do=true">
			        	<i class="material-icons">system_update_alt</i>
				    </a><div class="mdl-tooltip" for="updatenow">Update Now</div>
			    	<div class="mdl-layout-spacer"></div>
		        	<a class="mdl-button mdl-button--fab mdl-button--colored" id="dlnow" href="https://jabalicms.org/dl/jabali/jabali_<?php echo $new_version; ?>.zip">
		        		<i class="material-icons">file_download</i>
		        	</a><div class="mdl-tooltip" for="dlnow">Download Jabali</div>
	        	</div><?php
			} elseif ( $curr_version == $new_version ) { ?>
				<div class="mdl-card__supporting-text"><?php
					echo '<center><h3>You have the latest Version of Jabali</h3><img src="'._IMAGES.'404.jpg" width="500px"><h5>You don\'t have to do anything else</h5></center>'; ?>
				</div>
				<div class="mdl-card__menu">
			        <a id="updatenow" href="?settings=update&do=now">
			        	<i class="material-icons">system_update_alt</i>
			        </a><div class="mdl-tooltip" for="updatenow">Update Now</div>
			        <a id="dlnow" href="<?php echo( $nJD['download'] ); ?>">
			        	<i class="material-icons">file_download</i>
			        </a><div class="mdl-tooltip" for="dlnow">Download Jabali</div>
				</div><?php
			}
		} ?>
	</div>
	<div class="mdl-cell mdl-cell--4-col <?php primaryColor(); ?> mdl-card">
		<?php $xJson = file_get_contents( _API );
		$xD = json_decode( $xJson, true ); ?>
		<div class="mdl-card__title">
			<span class="mdl-card__title-text">
				<?php echo ucwords( $xD['name']); ?>
			</span>
			<div class="mdl-layout-spacer"></div>
			<div class="mdl-card__subtitle-text">
			    <a id="updatenow" href="https://jabalicms.org/versions/mshindi/">
			    	Version <?php echo ucwords( $xD['version']); ?>
			    </a>
			</div>
		</div>

		<article class="mdl-card__supporting-text">
			<h4><b>Developers</b></h4>
			<p><b>Lead Developer: </b><?php echo ucwords( $xD['author'] ); ?></p>

			<h4><b>Licenses </b></h4>
			<p>
			<a href="<?php echo $xD['licenses']['MIT']; ?>" class="">MIT License</a><br>
			<a href="<?php echo $xD['licenses']['GNU']; ?>" class="">GNU License</a><br>
			<a href="<?php echo $xD['licenses']['Apache']; ?>" class="">Apache License</a>
			</p>
			<h4><b>Requirements</b></h4>
			<p>PHP Version <?php echo ucwords( $xD['php']); ?><br>
			MYSQL Version <?php echo ucwords( $xD['mysql']); ?><br>
			SQLite Version <?php echo ucwords( $xD['sqlite']); ?><br>
			PostgreSQL Version <?php echo ucwords( $xD['postgresql']); ?></p>
		</article>
		<img src="<?php echo ucwords( $xD['screenshot']); ?>">
		<article class="mdl-card__supporting-text">
			<?php echo ucwords( $xD['description']); ?>
			<h4><b>Support</b></h4>
			<a href="<?php echo ucwords( $xD['website']); ?>"><i class="material-icons">public</i></a>
			<a href="<?php echo ucwords( $xD['support']); ?>"><i class="material-icons">help</i></a>
			<h4><b>Social</b></h4>
			<a href="<?php echo ucwords( $xD['social']['facebook']); ?>"><i class="fa fa-facebook fa-2x"></i></a>
			<a href="<?php echo ucwords( $xD['social']['twitter']); ?>"><i class="fa fa-twitter fa-2x"></i></a>
			<a href="<?php echo ucwords( $xD['social']['github']); ?>"><i class="fa fa-github fa-2x"></i></a>
			<a href="mailto:<?php echo $xD['social']['email']; ?>"><i class="fa fa-envelope fa-2x"></i></a>
		</article>
	</div>
</div><?php 
include 'footer.php';
?>