<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Progressive Web App
* @author Mauko Maunde
* @since 0.17.09
* @link https://docs.jabalicms.org/pwa/
**/
session_start();
require_once( '../init.php' );
require_once( '../load.php' );
require_once( 'header.php' );
if ( isset( $_GET['add'] ) ) { ?>
	<title><?php showOption( 'name' ); ?> Progressive Web App Icons</title>
		<form action="" style="padding: 15%;">
	    <div class="file-field input-field">
	      <div class="btn">
	        <span>File</span>
	        <input type="file">
	      </div>
	      <div class="file-path-wrapper">
	        <input class="file-path validate" type="text" placeholder="Select a .jbl or .json file to import">
	      </div>
	    </div>
			<button type="submit" name="rewrite" class="mdl-button mdl-button--fab mdl-button--colored"><i class="material-icons">forward</i></button>
		</form><?php
} else { ?>
	<title><?php showOption( 'name' ); ?> Progressive Web App</title>
  	<form class="mdl-grid" name=" action" method="">
  		
        <div class="mdl-cell mdl-cell--8-col <?php primaryColor(); ?> mdl-card">
        <div class="mdl-card__supporting-text">
          <div class="input-field">
          <i class="material-icons prefix">label</i>
            <input type="text" id="themename" name="name" value="<?php showOption( 'name' ); ?>">
            <label for="themename" >App Name</label>
          </div>
          <div class="input-field">
          <i class="material-icons prefix">label_outline</i>
            <input type="text" id="themesname" name="short_name" value="<?php showOption( 'description' ); ?>">
            <label for="themesname" >App Short Name</label>
          </div>
          <div class="input-field">
          <i class="material-icons prefix">description</i>
            <textarea id="themedesc" name="" class="materialize-textarea"><?php showOption( 'about' ); ?></textarea>
            <label for="themedesc" >App Description</label>
          </div>
          <div class="input-field">
          <i class="material-icons prefix">public</i>
            <input type="text" id="themename" name="" value=".">
            <label for="themename" >Home URL</label>
          </div>

          <div class="input-field">
          <i class="material-icons prefix">shop</i>
            <input type="text" id="themename" name="">
            <label for="themename" >Google Play App Link</label>
          </div>
        </div>
        <div class="mdl-card__menu"></div>
        </div>

        <div class="mdl-cell mdl-cell--4-col <?php primaryColor(); ?> mdl-card">
          <div class="mdl-card__supporting-text">
            <div class="input-field">
              <i class="material-icons prefix">developer_mode</i>
              <input type="text" id="themename" name="name" value="standalone">
              <label for="themename" >App Mode</label>
            </div>
            <div class="input-field">
              <i class="material-icons prefix">palette</i>
              <input type="text" id="themesname" name="short_name" value="<?php echo( $GLOBALS['GPrimary'] ); ?>">
              <label for="themesname" >Background Color</label>
            </div>
            <a href="?add=icons">Add Icons</a>
            <button type="submit" name="createtheme" class="mdl-button mdl-button--fab addfab mdl-button--colored"><i class="material-icons">forward</i></button>
          </div>
        </div>
  	</form><?php
}

include 'footer.php'; ?>
<?php ?>