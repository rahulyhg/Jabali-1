<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Admin Transfer Tools
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.04
* @link https://docs.jabalicms.org/transfer/
**/
session_start();
require_once( '../init.php' );
require_once( '../load.php' );
require_once( 'header.php' ); ?>
<div class="mdl-grid"><?php 
	if ( isset( $_GET['page'] ) ) {
		if ( $_GET["page"] =="import" ) { ?>
			<title>Import Data - <?php showOption( 'name' ); ?></title>
			<form action="" class="mdl-cell mdl-cell--4-col <?php primaryColor(); ?> mdl-card">
				<div class="mdl-card__supporting-text">
				    <div class="file-field input-field">
				      <div class="btn">
				        <span>File</span>
				        <input type="file">
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" placeholder="Select a .jbl or .json file to import">
				      </div>
				    </div>
				</div>
				<div class="mdl-card__actions">
					<button type="submit" name="import" class="mdl-button mdl-button--colored green"><i class="material-icons">file_upload</i> import</button>
				</div>
			</form>

				<div class="mdl-cell mdl-cell--8-col <?php primaryColor(); ?>"></div><?php
		} elseif ( $_GET["page"] =="export" ) {?>
		<title>Export Data - <?php showOption( 'name' ); ?></title>
			<form action="" class="mdl-cell mdl-cell--5-col <?php primaryColor(); ?> mdl-card">
				<div class="mdl-card__supporting-text">
		             <div class="input-field mdl-js-textfield getmdl-select">
		               <i class="material-icons prefix">image</i>
		              <input class="mdl-textfield__input" id="location" name="location" type="text" tabIndex="-1" >
		              <label>Select File Type</label>
		                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu <?php primaryColor(); ?>" for="location">
		                  <li class="mdl-menu__item" data-val="header">.json</li>
		                  <li class="mdl-menu__item" data-val="header">.xml</li>
		                  <li class="mdl-menu__item" data-val="drawer">.jbl</li>
		                </ul>
		             </div>
					<br>
					<br>
					<br>
					<br>
					<button type="submit" name="import" class="mdl-button mdl-button--colored green alignright"><i class="material-icons">file_download</i> export</button>
				</div>
			</form>

				<ul class="mdl-cell mdl-cell--7-col mdl-card mdl-shadow--2dp collapsible popout" data-collapsible="accordion">
        <li class="<?php  primaryColor(); ?>">
        <div class="collapsible-header"><i class="material-icons">help</i>Installing module</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li class="<?php  primaryColor(); ?>">
        <div class="collapsible-header"><i class="material-icons">help</i>Activating module</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li class="<?php  primaryColor(); ?>">
        <div class="collapsible-header"><i class="material-icons">help</i>Deactivating module</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li class="<?php  primaryColor(); ?>">
        <div class="collapsible-header"><i class="material-icons">help</i>UnInstalling module</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li class="<?php  primaryColor(); ?>">
        <div class="collapsible-header"><i class="material-icons">delete</i>Deleting module</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
      </ul><?php
		}
	} else { ?>
		<title>Site Tools - <?php showOption( 'name' ); ?></title>
			<form action="" class="mdl-cell mdl-cell--4-col <?php primaryColor(); ?> mdl-card">
				<div class="mdl-card__supporting-text">
				    <div class="file-field input-field">
				      <div class="btn">
				        <span>File</span>
				        <input type="file">
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" placeholder="Select a .jbl or .json file to import">
				      </div>
				    </div>
				</div>
				<div class="mdl-card__actions">
					<button type="submit" name="import" class="mdl-button mdl-button--colored green"><i class="material-icons">file_upload</i> import</button>
				</div>
			</form>

				<div class="mdl-cell mdl-cell--8-col <?php primaryColor(); ?>"></div><?php
	} ?>
</div><?php
require_once( 'footer.php' );