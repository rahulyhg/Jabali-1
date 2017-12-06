<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Modules Creation Client
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.06
* @link https://docs.jabalicms.org/api/modules/
**/

session_start();
require_once( '../init.php' );
require_once( '../load.php' );
require_once( 'header.php' );

if ( isset( $_POST['activemodule'] ) ) {
    $activex = $_POST['activemodule'];
    $modules = getOption('modules');
    $modules[] = $activex;
    $modules = json_encode( $modules );
    $GLOBALS['OPTIONS'] -> update( 'modules', $modules, date('Y-m-d H:i:s') );
}

if ( isset( $_POST['deactivatemodule'] ) ) {
    $activex = $_POST['deactivatemodule'];
    $modules = getOption('modules');
    // todo find module by array keys and unset
    unset( $modules[$activex] );
    $modules = json_encode( $modules );
    $GLOBALS['OPTIONS'] -> update( 'modules', $modules, date('Y-m-d H:i:s') );
}

if ( isset( $_POST['createmodule'] ) ) {
  $name = $_POST['modulename'];
  $slug = $_POST['moduleslug'];
  $description = $_POST['moduledescription'];
  $category = $_POST['modulecategory'];
  $author = $_POST['moduleauthor'];
  $website = $_POST['modulewebsite'];
  $support = $_POST['modulesupport'];
  $license = $_POST['modulelicense'];
  $licenselink = $_POST['modulelicenselink'];
  $facebook = $_POST['modulefacebook'];
  $twitter = $_POST['moduletwitter'];
  $github = $_POST['modulegithub'];
  $email = $_POST['moduleemail'];
  $version = $_POST['moduleversion'];

  $licensetext = 'MIT License

Copyright (c) '.date( 'Y' ).' '. $author.'

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.';

  $comments = "<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage ". $name ."
* @author ". $author ."
* @since ". $version ."
* @link ". $website ."
* @license ". $license ." - ". $licenselink  ."
**/";
  $tag = "$";
  $thdi = "<?php echo( _X ); ?>". $slug;
  $moduleclass = $comments."

namespace Modules\\".ucwords( $slug )."\Classes;

class ".ucwords( $slug )."
{
  public function __construct( \$args = \"\" )
  {
    //body
  }
}";

  $moduledir = _ABSX_ . $slug.'/';
  $templates = _ABSX_ . $slug.'/templates/';
  $css = _ABSX_ . $slug.'/assets/css/';
  $js = _ABSX_ . $slug.'/assets/js/';
  $images = _ABSX_ . $slug.'/assets/images/';
  $classes = _ABSX_ . $slug.'/classes/';

  $data = '{
  "name": "'.$name.'",
  "slug": "'.$slug.'",
  "version": "'.$version.'",
  "author": "'.$author.'",
  "modified": "'.$author.'",
  "category": "'.$category.'",
  "screenshot": "app/assets/images/avatar.png",
  "description": "'.$description.'",
  "social": {
    "facebook": "'.$facebook.'",
    "twitter": "'.$twitter.'",
    "github": "'.$github.'",
    "email": "'.$email.'"
  },
  "link": "https://jabalicms.org/modules/'.$slug.'",
  "website": "'.$website.'",
  "support": "'.$support.'",
  "download": "https://jabalicms.org/dl/modules/'.$slug.'.zip",
  "licences": {
    "'.$license.'": "'.$licenselink.'"
  }
}';

$script = "\$(document).ready(function(){
   //
});";
  if ( is_dir( _ABSX_ . $slug.'/' ) ) {
    _shout_( "<p>A module by that name already exists.</p>
    <h6>Tips: </h6>

    <li>Use a very unique slug e.g <pre>myveryuniqueslug<pre></li>
    <li>Prefix your slug e.g <pre>myprefixed_slug<pre></li>", "error" );
  } else {
    $umaskz = umask(0);
    if ( mkdir( $moduledir, 0777 )) {
      mkdir( $css, 0777, true );
      mkdir( $js, 0777, true );
      mkdir( $images, 0777, true );
      mkdir( $classes, 0777, true );

      $licensefile = fopen($moduledir.'LICENSE', 'w');
      $modulefunctions = fopen( $moduledir.'functions.php', 'w');
      $moduleclassfile = fopen( $moduledir.'classes/'.$slug.'.php', 'w');
      $modulestyles = fopen( $moduledir.'assets/css/'.$slug.'.css', 'w');
      $modulescripts = fopen( $moduledir.'assets/js/'.$slug.'.js', 'w');
      $jcss = file_get_contents( _STYLES.'made.css' );
      $moduledata = fopen( $moduledir.$slug.'.json', 'w');

      fwrite( $licensefile, $licensetext );
      fwrite( $modulefunctions, $comments );
      fwrite( $moduledata, $data );
      fwrite( $moduleclassfile, $moduleclass );
      fwrite( $modulescripts, $script );
      fwrite( $modulestyles, $jcss );

      fclose( $licensefile );
      fclose( $moduleclassfile );  
      fclose( $modulefunctions );
      fclose( $moduledata );
      fclose( $modulestyles );
      fclose( $modulescripts );

      _shout_( 'New module created successfully! <a href="?edit='.$slug.'&key='.$slug.'.php">Click here</a> to edit.', 'success' );
    } else {
      _shout_( "Could not create module files. Make sure Jabali has the correct write permissions to the installation directory and try again.", "error" );
    }
    umask( $umaskz );
  }
}

if ( isset( $_POST['copymodule'] ) ) {
  $source = $_POST['source'];
  $name = $_POST['modulename'];
  $slug = $_POST['moduleslug'];
  $description = $_POST['moduledescription'];
  $category = $_POST['modulecategory'];
  $author = $_POST['moduleauthor'];
  $website = $_POST['modulewebsite'];
  $support = $_POST['modulesupport'];
  $license = $_POST['modulelicense'];
  $licenselink = $_POST['modulelicenselink'];
  $facebook = $_POST['modulefacebook'];
  $twitter = $_POST['moduletwitter'];
  $github = $_POST['modulegithub'];
  $email = $_POST['moduleemail'];
  $version = $_POST['moduleversion'];

  $comments = "<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage ". $name ."
* @author ". $author ."
* @since ". $version ."
* @link ". $website ."
* @license ". $license ." - ". $licenselink  ."
**/";

  $newmodule = _ABSX_ . $slug.'/';
  $oldmodule = _ABSX_ . $source.'/';
  $templates = _ABSX_ . $slug.'/templates/';
  $css = _ABSX_ . $slug.'/assets/css/';
  $js = _ABSX_ . $slug.'/assets/js/';
  $images = _ABSX_ . $slug.'/assets/images/';
  $classes = _ABSX_ . $slug.'/classes/';

  $data = '{
  "name": "'.$name.'",
  "slug": "'.$slug.'",
  "version": "'.$version.'",
  "author": "'.$author.'",
  "modified": "'.$author.'",
  "category": "'.$category.'",
  "screenshot": "app/assets/images/avatar.png",
  "description": "'.$description.'",
  "social": {
    "facebook": "'.$facebook.'",
    "twitter": "'.$twitter.'",
    "github": "'.$github.'",
    "email": "'.$email.'"
  },
  "link": "https://jabalicms.org/modules/'.$slug.'",
  "website": "'.$website.'",
  "support": "'.$support.'",
  "download": "https://jabalicms.org/dl/modules/'.$slug.'.zip",
  "licences": {
    "'.$license.'": "'.$licenselink.'"
  }
}';

  if ( reCopy( $oldmodule, $newmodule ) ) {
    file_put_contents($newmodule.'functions.php', $comments);
    file_put_contents($newmodule.$slug.'.json', $data);
    file_put_contents($css.$slug.'.css', str_replace('<?php', "/* Edit!!! */", $comments) );
    file_put_contents($js.$slug.'.js', str_replace('<?php', "/* Edit!!! */", $comments) );

    unlink( $newmodule.$source.'.json');

    _shout_( 'Copy successful! '.$slug.' module created from '. $source.'! <a href="?edit='.$slug.'&key='.$slug.'.php">Click here</a> to edit', 'success' );
  } else {
    _shout_( 'Could not create module files. Make sure Jabali has the correct write permissions to the installation directory and try again.', 'error');
  }
}

if ( isset( $_POST['savefile'] ) ) {
  $module = $_POST['module'];
  $file = $_POST['file'];
  $contents = $_POST['filecontents'];

  if ( file_put_contents( _ABSX_.$module.'/'.$file, $contents ) ) {
    _shout_( ucwords( $file )." Saved Successfully!", "success" );
  } else{
    _shout_( "Could not save ".$file, "error" );
  }
}

if ( isset( $_POST['deletefile'] ) ) {
  $module = $_POST['module'];
  $file = $_POST['deletefile'];

  if ( unlink( _ABSX_.$module.'/'.$file ) ) {
    _shout_( ucwords( $file )." Deleted Successfully!", "success" );
  } else{
    _shout_( "Could not delete ".$file, "error" );
  }
}

if ( isset( $_POST['uploadmodule'] ) ) {
  $filename = $_FILES["up_module"]["name"];
  $source = $_FILES["up_module"]["tmp_name"];
  $type = $_FILES["up_module"]["type"];
  
  $name = explode(".", $filename);
  $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
  foreach($accepted_types as $mime_type) {
    if($mime_type == $type) {
      $okay = true;
      break;
    } 
  }
  
  $continue = strtolower($name[1]) == 'zip' ? true : false;
  if(!$continue) {
    $message = "The file you are trying to upload is not a .zip file. Please try again.";
  }

  $target_path = _ABSTEMP_ . $filename;
  if(move_uploaded_file($source, $target_path)) {
    $zip = new ZipArchive();
    $x = $zip->open($target_path);
    if ($x === true) {
      $zip->extractTo( _ABSX_ );
      $zip->close();
  
      unlink($target_path);
    }
    $message = "Your .zip file was uploaded and unpacked.";
  } else {  
    $message = "There was a problem with the upload. Please try again.";
  }
}
if ( isset( $_GET['moduleimage'] ) ) {
  $my_img = imagecreate( 300, 300 );
  $background = imagecolorallocate( $my_img, 0, 0, 255 );
  $text_colour = imagecolorallocate( $my_img, 255, 255, 0 );
  $line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
  imagestring( $my_img, 4, 30, 25, $_GET['moduleimage'], $text_colour );
  imagesetthickness ( $my_img, 5 );
  imageline( $my_img, 30, 45, 165, 45, $line_colour );

  header( "Content-type: image/png" );
  imagepng( $my_img );
  imagecolordeallocate( $line_color );
  imagecolordeallocate( $text_color );
  imagecolordeallocate( $background );
  imagedestroy( $my_img );
}
if ( isset( $_GET['install'] ) ) {
  if ( isset( $_GET['download'] ) ) {
    $download = $_GET['download'];
  } else {
    $download = 'https://jabalicms.org/dl/jabali/modules/'.$_GET['install'].'.zip';
  }

  if ( !is_file(  _ABSTEMP_.'modules/'.$_GET['install'].'.zip' ) ) { ?>
     <div class="mdl-grid" >
      <div class="mdl-cell mdl-cell--12-col mdl-card <?php primaryColor() ?>" >
        <div class="mdl-card__supporting-text">
        <p>Downloading Module from Jabali</p><?php
    if ( fopen( $download, 'r') ) {

      $directory = _ABSTEMP_ . "modules/";

      if ( !is_dir( $directory ) ) { mkdir( $directory, 0777, true ); }

      file_put_contents( _ABSTEMP_.'modules/'.$_GET['install'].'.zip', fopen('https://jabalicms.org/dl/jabali/modules/'.$_GET['install'].'.zip', 'r') );
      echo '<p>Module Downloaded And Saved</p>Installing module...';
      intallModule( _ABSTEMP_.'modules/'.$_GET['install'].".zip" );
    } else {
      echo '<p>Could not get module from Jabali.</p></div></div></div>';
    }
  } 
} elseif ( isset( $_GET['create'] ) ) {
  $create = $_GET['create']; ?>
  <title>Add <?php echo( ucwords( $create ) ); ?> - <?php showOption( 'name' ); ?></title>
  <?php if ( $create == "upload" ) { ?>
    <div class="mdl-grid">
    <form method="POST" action="" class="mdl-cell mdl-cell--8-col mdl-grid mdl-shadow--2dp <?php primaryColor(); ?>" style="padding: 15%" >
      <div class="mdl-cell mdl-cell--8-col file-field input-field">
        <div class="btn">
          <span class="material-icons">attach_file</span>
          <input type="file" name="up_module">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text" value="Select Module Zip To Upload">
        </div>
      </div>

      <div class="mdl-cell mdl-cell--4-col file-field input-field">
        <button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="uploadmodule"><i class="material-icons">forward</i></button>
      </div>
    </form>
    <div class="mdl-cell mdl-cell--4-col file-field input-field mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
      
       <a class="mdl-button mdl-button--fab mdl-button--colored addfab" href="?create=module"><i class ="material-icons">create</i></a>
      <div><?php
        $path = _ABSX_;
        $dir = new DirectoryIterator($path);
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $module = $fileinfo->getFilename();
                $xJson = file_get_contents( _ABSX_.$module."/".$module.".json" );
                $xD = json_decode( $xJson, true ); ?>
                      <a href="?copy=module&source=<?php echo $xD[ 'slug' ] ; ?>" class="mdl-list__item"><i class="mdi mdi-content-copy mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $xD[ 'name' ] ; ?></span></a><?php
            }
        } ?>
      </div>
    </div>
    <div class="mdl-cell mdl-cell--12-col mdl-shadow--2dp <?php primaryColor(); ?>">
    </div>
    </div><?php
  } elseif ( $create == "copy" ) { ?>
    <form method="POST" action="" class="mdl-grid">
      <div class="mdl-cell mdl-cell--8-col <?php primaryColor(); ?> mdl-card">
      <div class="mdl-card__supporting-text">
        <div class="input-field getmdl-select">
        <i class="material-icons prefix">content_copy</i>
         <input class="mdl-textfield__input" id="type" name="source" type="text" readonly tabIndex="-1" value="<?php if (isset( $_GET['source'] ) ){ echo $_GET['source']; } else{ echo 'Select Source'; } ?>" >
           <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu <?php primaryColor(); ?> option-drop" for="type" style="max-height: 500px !important; overflow-y: auto;"><?php
                    $path = _ABSX_;
                    $dir = new DirectoryIterator($path);
                    foreach ($dir as $fileinfo) {
                        if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                            $module = $fileinfo->getFilename(); ?>
                                  <a href="?create=copy&source=<?php echo $module; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo ucwords( $module ); ?></span></a><?php
                        }
                    } ?>
           </ul>
          <label for="type" >Select Source</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">label</i>
          <input type="text" id="modulename" name="modulename">
          <label for="modulename" >Module Name</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">label_outline</i>
          <input type="text" id="moduleslug" name="moduleslug">
          <label for="moduleslug" >Module Slug</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">bubble_chart</i>
          <input type="text" id="modulecategory" name="modulecategory">
          <label for="modulecategory" >Module Category</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">description</i>
          <textarea id="moduledesc" name="moduledescription" class="materialize-textarea"></textarea>
          <label for="moduledesc" >Module Description</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">bubble_chart</i>
          <input type="text" id="moduleversion" name="moduleversion">
          <label for="moduleversion" >Module Version</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">perm_identity</i>
          <input type="text" id="moduleauthor" name="moduleauthor">
          <label for="moduleauthor" >Module Author</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">public</i>
          <input type="text" id="modulewebsite" name="modulewebsite">
          <label for="modulewebsite" >Module Website</label>
        </div>

        <div class="input-field">
          <i class="material-icons prefix">help</i>
          <input type="text" id="modulesupport" name="modulesupport">
          <label for="modulesupport" >Module Support</label>
        </div>

        <div class="input-field">
          <i class="material-icons prefix">lock_outline</i>
          <input type="text" id="modulelicense" name="modulelicense">
          <label for="modulelicense" >Module License</label>
        </div>

        <div class="input-field">
          <i class="material-icons prefix">link</i>
          <input type="text" id="modulelicenselink" name="modulelicenselink">
          <label for="modulelicenselink" >License Link</label>
        </div>
        <?php csrf(); ?>

      </div>
      </div>
      <div class="mdl-cell mdl-cell--4-col <?php primaryColor(); ?> mdl-card">
        <div class="mdl_card__image">
          <img src="<?php echo _IMAGES . 'placeholder.png'; ?>" width="100%">
        </div>
        <div class="mdl-card__supporting-text">
          <h3>Module Social</h3>
          <div class="input-field">
          <i class="fa fa-facebook prefix"></i>
          <input type="text" id="modulefb" name="modulefacebook">
          <label for="modulefb" >Facebook</label>
          </div>
          <div class="input-field">
            <i class="fa fa-twitter prefix"></i>
            <input type="text" id="moduletwitter" name="moduletwitter">
            <label for="moduletwitter" >Twitter</label>
          </div>
          <div class="input-field">
            <i class="fa fa-github prefix"></i>
            <input type="text" id="modulegithub" name="modulegithub">
            <label for="modulegithub" >Github</label>
          </div>
          <div class="input-field">
            <i class="fa fa-envelope prefix"></i>
            <input type="text" id="moduleemail" name="moduleemail">
            <label for="moduleemail" >Email</label>
          </div>
        </div>

        <button type="submit" name="copymodule" class="mdl-button mdl-button--fab addfab mdl-button--colored"><i class="material-icons">forward</i></button>
      </div>
    </form><?php 
  } else { ?>
    <form method="POST" action="" class="mdl-grid">
      <div class="mdl-cell mdl-cell--8-col <?php primaryColor(); ?> mdl-card">
      <div class="mdl-card__supporting-text">
        <div class="input-field">
          <i class="material-icons prefix">label</i>
          <input type="text" id="modulename" name="modulename">
          <label for="modulename" >Module Name</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">label_outline</i>
          <input type="text" id="moduleslug" name="moduleslug">
          <label for="moduleslug" >Module Slug</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">bubble_chart</i>
          <input type="text" id="modulecategory" name="modulecategory">
          <label for="modulecategory" >Module Category</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">description</i>
          <textarea id="moduledesc" name="moduledescription" class="materialize-textarea"></textarea>
          <label for="moduledesc" >Module Description</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">bubble_chart</i>
          <input type="text" id="moduleversion" name="moduleversion">
          <label for="moduleversion" >Module Version</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">perm_identity</i>
          <input type="text" id="moduleauthor" name="moduleauthor">
          <label for="moduleauthor" >Module Author</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">public</i>
          <input type="text" id="modulewebsite" name="modulewebsite">
          <label for="modulewebsite" >Module Website</label>
        </div>

        <div class="input-field">
          <i class="material-icons prefix">help</i>
          <input type="text" id="modulesupport" name="modulesupport">
          <label for="modulesupport" >Module Support</label>
        </div>

        <div class="input-field">
          <i class="material-icons prefix">lock_outline</i>
          <input type="text" id="modulelicense" name="modulelicense">
          <label for="modulelicense" >Module License</label>
        </div>

        <div class="input-field">
          <i class="material-icons prefix">link</i>
          <input type="text" id="modulelicenselink" name="modulelicenselink">
          <label for="modulelicenselink" >License Link</label>
        </div>
        <?php csrf(); ?>

      </div>
      </div>
      <div class="mdl-cell mdl-cell--4-col <?php primaryColor(); ?> mdl-card">
        <div class="mdl_card__image">
          <img src="<?php echo _IMAGES . 'placeholder.png'; ?>" width="100%">
        </div>
        <div class="mdl-card__supporting-text">
          <h3>Module Social</h3>
          <div class="input-field">
          <i class="fa fa-facebook prefix"></i>
          <input type="text" id="modulefb" name="modulefacebook">
          <label for="modulefb" >Facebook</label>
          </div>
          <div class="input-field">
            <i class="fa fa-twitter prefix"></i>
            <input type="text" id="moduletwitter" name="moduletwitter">
            <label for="moduletwitter" >Twitter</label>
          </div>
          <div class="input-field">
            <i class="fa fa-github prefix"></i>
            <input type="text" id="modulegithub" name="modulegithub">
            <label for="modulegithub" >Github</label>
          </div>
          <div class="input-field">
            <i class="fa fa-envelope prefix"></i>
            <input type="text" id="moduleemail" name="moduleemail">
            <label for="moduleemail" >Email</label>
          </div>
        </div>

        <button type="submit" name="createmodule" class="mdl-button mdl-button--fab addfab mdl-button--colored"><i class="material-icons">forward</i></button>
      </div>
    </form><?php 
  }
} elseif ( isset( $_GET['edit'] ) ) {
  $module =  $_GET['edit'];
  $file =  $_GET['key'];
  $parts = explode(".", $file.'.' );
  if ( $parts[1] == "js" ) {
     $mode = "javascript";
   } else {
     $mode = $parts[1];
   } ?>
  <title>Editing <?php echo( $_GET['key'] ); ?> - <?php showOption( 'name' ); ?></title>
  <form class="mdl-grid" method="POST" action="">
    <div class="mdl-cell mdl-cell--8-col mdl-card">
      <div class="mdl-card__supporting-text <?php primaryColor(); ?>">
      <p><?php echo '<code>modules/' . $module . '/' . $file . '</code>'; ?><span class="alignright"><button class="mdl-button mdl-button--icon mdl-button--colored" type="submit" name="deletefile" value="<?php echo $file; ?>"><i class="material-icons">delete</i></button></span></p>
      <div class="input-field">
      <i class="material-icons prefix">label</i>
        <input type="text" id="filename" name="file" value="<?php echo( $file ); ?>">
        <label for="filename" >File Name</label>
      </div>
      <div class="input-field">
        <textarea class="materialize-textarea" name="filecontents" id="filecontents" data-editor="<?php echo $mode; ?>" data-module="<?php showOption( 'acemodule'); ?>" data-gutter="1" width="100%" style="height: 800px;"><?php 
        if ( file_exists( _ABSX_ . $module . '/' . $file ) ) {
          $contents = file_get_contents( _ABSX_ . $module . '/' . $file );
        } else {
          $contents = "Sorry, this file does not exist.";
        }
        echo $contents; ?></textarea>
      </div>
      <input type="hidden" name="module" value="<?php echo( $module ); ?>">
      <?php csrf(); ?>
      </div>
    </div>
    <div class="mdl-cell mdl-cell--4-col">
      <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
        <div class="mdl-card__title">
                  <span class="mdl-card__title-text">Other Files</span>
                <div class="mdl-layout-spacer"></div>
              </div>
              <div class="mdl-card__supporting-text mdl-card--expand">
                <?php
                $path = _ABSX_ . $_GET['edit'] . '/';
                $dir = new DirectoryIterator($path);
                foreach ($dir as $fileinfo) {
                    if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                        $module = $fileinfo->getFilename(); ?>
                              <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo $module; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $module ; ?></span></a><?php
                    }
                } ?>
              </div>

              <div class="mdl-card__menu">
              <a href="?add=file&key=<?php echo( $_GET['edit'] ); ?>" class="mdl-button mdl-button--icon"><i class="material-icons">add</i></a>
              </div>
      </div>
      <br>
      <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
        <div class="mdl-card__title">
                  <span class="mdl-card__title-text">Stylesheets</span>
                <div class="mdl-layout-spacer"></div>
              </div>
              <div class="mdl-card__supporting-text mdl-card--expand">
                <?php
                $path = _ABSX_ . $_GET['edit'] . '/assets/css/';
                 if ( is_dir( $path ) ) {
                    $dir = new DirectoryIterator($path);
                    foreach ($dir as $fileinfo) {
                        if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                            $module = $fileinfo->getFilename(); ?>
                                  <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo 'assets/css/'.$module; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $module ; ?></span></a><?php
                        }
                    }
                  } ?>
              </div>

              <div class="mdl-card__menu">
              <a href="?add=css&key=<?php echo $_GET['edit']; ?>" class="mdl-button mdl-button--icon"><i class="material-icons">add</i></a>
              </div>
      </div>
      <br>
      <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
        <div class="mdl-card__title">
                  <span class="mdl-card__title-text">Scripts</span>
                <div class="mdl-layout-spacer"></div>
              </div>
              <div class="mdl-card__supporting-text mdl-card--expand">
                <?php
                $path = _ABSX_ . $_GET['edit'] . '/assets/js/';
                if (is_dir( $path ) ) {
                  $dir = new DirectoryIterator($path);
                  foreach ($dir as $fileinfo) {
                      if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                          $module = $fileinfo->getFilename(); ?>
                                <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo 'assets/js/'.$module; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $module; ?></span></a><?php
                      }
                  }
                 } ?>
              </div>

              <div class="mdl-card__menu">
              <a href="?add=js&key=<?php echo $_GET['edit']; ?>" class="mdl-button mdl-button--icon"><i class="material-icons">add</i></a>
              </div>
      </div>
      <br>
      <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
        <div class="mdl-card__title">
                  <span class="mdl-card__title-text">Classes</span>
                <div class="mdl-layout-spacer"></div>
              </div>
              <div class="mdl-card__supporting-text mdl-card--expand">
                <?php
                $path = _ABSX_ . $_GET['edit'] . '/classes/';
                if ( is_dir( $path ) ) {
                  $dir = new DirectoryIterator($path);
                  foreach ($dir as $fileinfo) {
                      if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                          $module = $fileinfo->getFilename(); ?>
                                <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo 'classes/'.$module; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $module ; ?></span></a><?php
                      }
                  }
                } ?>
              </div>

              <div class="mdl-card__menu">
              <a href="?add=class&key=<?php echo $_GET['edit']; ?>" class="mdl-button mdl-button--icon"><i class="material-icons">add</i></a>
              </div>
      </div>
      <button class="mdl-button mdl-button--fab addfab red right" name="savefile" type="submit"><i class="material-icons">save</i></button>
    </div>
    </form><?php
} elseif ( isset( $_GET['add'] ) ) {
  $module =  $_GET['add'];
  $file =  $_GET['key'];

  if ( $module == "file" ) {
     $path = "";
     $mode = "php";
   } elseif ( $module == "template" ) {
     $path = "templates";
     $mode = "php";
   } elseif ( $module == "css" ) {
     $path = "assets/css";
     $mode = "css";
   } elseif ( $module == "js" ) {
     $path = "assets/js";
     $mode = "javascript";
   } elseif ( $module == "class" ) {
     $path = "classes";
     $mode = "php";
   } else {
     $path = "";
     $mode = "php";
   } ?>
  <title>Adding File To <?php echo( ucwords( $_GET['key'] ) ); ?> Module - <?php showOption( 'name' ); ?></title>
  <form class="mdl-grid" method="POST" action="">
        <div class="mdl-cell mdl-cell--8-col mdl-card">
          <div class="mdl-card__supporting-text <?php primaryColor(); ?>">
          <p><?php echo '<code>modules/' . $file . '/~.'. $module .'</code>'; ?></p>
            <div class="input-field">
            <i class="material-icons prefix">label</i>
              <input type="text" id="filename" name="file" value="<?php echo( $path ); ?>/">
              <label for="filename" >File Name</label>
            </div>
          <div class="input-field">
            <textarea class="materialize-textarea" name="filecontents" id="filecontents" data-editor="<?php echo $mode; ?>" data-module="<?php showOption( 'acemodule'); ?> data-gutter="1" width="100%" style="height: 600px;"><?php
            $module = file_get_contents( _ABSX_ . $file .'/'. $file.'.json');
            $deets = json_decode( $module, true );
            echo '<?php';
            echo "\r\n";
            echo '/**';
            echo "\r\n";
            echo '* @package '. $deets['name'];
            echo "\r\n";
            echo '* @subpackage ~ ';
            echo "\r\n";
            echo '* @link '. $deets['website'];
            echo "\r\n";
            echo '* @author '. $deets['author'];
            echo "\r\n";
            echo '* @since '. $deets['version'];
            echo "\r\n";
            echo '**/';
            echo "\r\n";
            echo '?>';
            ?></textarea>
          </div>
          <input type="hidden" name="module" value="<?php echo( $file ); ?>">
          <?php csrf(); ?>
          </div>
        </div>
          <div class="mdl-cell mdl-cell--4-col">

          <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
            <div class="mdl-card__title">
                      <span class="mdl-card__title-text">Other Files</span>
                    <div class="mdl-layout-spacer"></div>
                  </div>
                  <div class="mdl-card__supporting-text mdl-card--expand">
                    <?php
                    $path = _ABSX_ . $_GET['key'] . '/';
                    $dir = new DirectoryIterator($path);
                    foreach ($dir as $fileinfo) {
                        if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                            $module = $fileinfo->getFilename(); ?>
                                  <a href="?edit=<?php echo $_GET['key']; ?>&key=<?php echo $module; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $module ; ?></span></a><?php
                        }
                    } ?>
                  </div>

                  <div class="mdl-card__menu">
                  <a href="?add=file&key=<?php echo( $_GET['key'] ); ?>" class="mdl-button mdl-button--icon"><i class="material-icons">add</i></a>
                  </div>
          </div>
          <br>
          <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
            <div class="mdl-card__title">
                      <span class="mdl-card__title-text">Templates</span>
                    <div class="mdl-layout-spacer"></div>
                  </div>
                  <div class="mdl-card__supporting-text mdl-card--expand">
                    <?php
                    $path = _ABSX_ . $_GET['key'] . '/templates/';
                    if ( is_dir( $path ) ) {
                      $dir = new DirectoryIterator($path);
                      foreach ($dir as $fileinfo) {
                          if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                              $module = $fileinfo->getFilename(); ?>
                                    <a href="?edit=<?php echo $_GET['key']; ?>&key=<?php echo 'templates/'.$module; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $module ; ?></span></a><?php
                          }
                      }
                     } ?>
                  </div>

                  <div class="mdl-card__menu">
                  <a href="?add=template&key=<?php echo $_GET['key']; ?>" class="mdl-button mdl-button--icon"><i class="material-icons">add</i></a>
                  </div>
          </div>


          <br>
          <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
            <div class="mdl-card__title">
                      <span class="mdl-card__title-text">Stylesheets</span>
                    <div class="mdl-layout-spacer"></div>
                  </div>
                  <div class="mdl-card__supporting-text mdl-card--expand">
                    <?php
                    $path = _ABSX_ . $_GET['key'] . '/assets/css/';
                     if ( is_dir( $path ) ) {
                        $dir = new DirectoryIterator($path);
                        foreach ($dir as $fileinfo) {
                            if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                                $module = $fileinfo->getFilename(); ?>
                                      <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo 'assets/css/'.$module; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $module ; ?></span></a><?php
                            }
                        }
                      } ?>
                  </div>

                  <div class="mdl-card__menu">
                  <a href="?add=css&key=<?php echo $_GET['key']; ?>" class="mdl-button mdl-button--icon"><i class="material-icons">add</i></a>
                  </div>
          </div>
          <br>
          <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
            <div class="mdl-card__title">
                      <span class="mdl-card__title-text">Scripts</span>
                    <div class="mdl-layout-spacer"></div>
                  </div>
                  <div class="mdl-card__supporting-text mdl-card--expand">
                    <?php
                    $path = _ABSX_ . $_GET['key'] . '/assets/js/';
                    if (is_dir( $path ) ) {
                      $dir = new DirectoryIterator($path);
                      foreach ($dir as $fileinfo) {
                          if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                              $module = $fileinfo->getFilename(); ?>
                                    <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo 'assets/js/'.$module; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $module; ?></span></a><?php
                          }
                      }
                     } ?>
                  </div>

                  <div class="mdl-card__menu">
                  <a href="?add=js&key=<?php echo $_GET['key']; ?>" class="mdl-button mdl-button--icon"><i class="material-icons">add</i></a>
                  </div>
          </div>

          <br>
          <div class="mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
            <div class="mdl-card__title">
                      <span class="mdl-card__title-text">Classes</span>
                    <div class="mdl-layout-spacer"></div>
                  </div>
                  <div class="mdl-card__supporting-text mdl-card--expand">
                    <?php
                    $path = _ABSX_ . $_GET['key'] . '/classes/';
                    if ( is_dir( $path ) ) {
                      $dir = new DirectoryIterator($path);
                      foreach ($dir as $fileinfo) {
                          if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                              $module = $fileinfo->getFilename(); ?>
                                    <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo 'classes/'.$module; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $module ; ?></span></a><?php
                          }
                      }
                    } ?>
                  </div>

                  <div class="mdl-card__menu">
                  <a href="?add=class&key=<?php echo $_GET['key']; ?>" class="mdl-button mdl-button--icon"><i class="material-icons">add</i></a>
                  </div>
          </div>
          </div>
          <button class="mdl-button mdl-button--fab addfab red right" name="savefile" type="submit"><i class="material-icons">save</i></button>
      </form><?php
} elseif ( isset( $_GET['view'] ) ) { 
  $module = $_GET['view'];
  $xJson = file_get_contents( _ABSX_.$module."/".$module.".json" );
  $xD = json_decode( $xJson, true );

  $path = _ABSX_;
  $dir = new DirectoryIterator($path);
  $installed = array();
  foreach ($dir as $fileinfo) {
    if ($fileinfo->isDir() && !$fileinfo->isDot()) {
      $module = $fileinfo->getFilename();
      $installed[] = $module;
    }
  } ?>
  <title>Module - <?php echo( $_GET['key'] ); ?> - <?php showOption( 'name' ); ?></title>
  <div class="mdl-grid">
  <form method="POST" action="" class="mdl-cell mdl-cell--8-col mdl-shadow--2dp <?php primaryColor(); ?> mdl-card">
            <div class="mdl-card-media">
          <img src="<?php echo _IMAGES . 'placeholder.png'; ?>" width="100%" style="overflow: hidden;" >
        </div>
              <div class="mdl-card__supporting-text">
                <?php echo $xD[ 'description' ] ; ?>
              </div>
              <div class="mdl-card__menu">
                <a href="?edit=<?php echo $xD[ 'slug' ] ; ?>&key=<?php echo $xD[ 'slug' ] ; ?>.php" class="material-icons">create</a>
                <a href="options?options=<?php echo $xD[ 'settings' ] ; ?>&page=module settings" class="material-icons" >settings</a>
              </div>
              <div class="mdl-card__actions mdl-card--border"><?php
                if ( in_array( $xD[ 'slug' ], $installed )) { ?>
                    <div class="input-field">
                        <button class="mdl-button mdl-button--icon <?php if ( activex( $xD[ 'slug' ] ) ) {
                          echo "mdl-button--colored";
                        } ?>" id="<?php echo $xD[ 'slug' ] ; ?>" name="activemodule" value="<?php echo $xD[ 'slug' ] ; ?>" type="submit">
                          <?php csrf(); ?>
                            <i class="material-icons"><?php if ( isActiveX( $xD[ 'slug' ] ) ) {
                          echo "check";
                        } else {
                          echo "save";
                          } ?></i>
                        </button>
                        <button class="mdl-button mdl-button--icon <?php if ( activex( $xD[ 'slug' ] ) ) {
                          echo "mdl-button--colored";
                        } ?>" id="<?php echo $xD[ 'slug' ] ; ?>" name="deactivemodule" value="<?php echo $xD[ 'slug' ] ; ?>" type="submit">
                          <?php csrf(); ?>
                            <i class="material-icons"><?php if ( isActiveX( $xD[ 'slug' ] ) ) {
                          echo "clear";
                        } else {
                          echo "save";
                          } ?></i>
                        </button>
                    </div>
                        <?php } ?>
              <div class="mdl-layout-spacer"></div>
                  <?php 

                    if ( !in_array( $xD[ 'slug' ], $installed )) { ?>
                      <a class="waves-effect waves-light btn red" href="?install=">INSTALL</a>
                    <?php } ?>
                    <a id="<?php echo $xD[ 'slug' ] ; ?>web" href="<?php echo $xD[ 'website' ] ; ?>" class="mdl-button mdl-button--icon"><i class="material-icons">public</i></a>
                    <div class="mdl-tooltip" for="<?php echo $xD[ 'slug' ] ; ?>web"><?php echo $xD[ 'name' ] ; ?> Website</div>
                    <a id="<?php echo $xD[ 'slug' ] ; ?>help" href="<?php echo $xD[ 'support' ] ; ?>" class="mdl-button mdl-button--icon"><i class="material-icons">help</i></a>
                    <div class="mdl-tooltip" for="<?php echo $xD[ 'slug' ] ; ?>help"><?php echo $xD[ 'name' ] ; ?> Help</div>
                    <a href="<?php echo $xD[ 'website'] ; ?>" class="mdl-button mdl-button--icon"><i class="mdi mdi-globe mdl-list__item-icon"></i></a>
                    <a href="<?php echo $xD[ 'website'] ; ?>" class="mdl-button mdl-button--icon"><i class="mdi mdi-account mdl-list__item-icon"></i></a>
                    <a href="<?php echo $xD[ 'social' ]['facebook'] ; ?>" class="mdl-button mdl-button--icon"><i class="mdi mdi-facebook mdl-list__item-icon"></i></a>
                    <a href="<?php echo $xD[ 'social' ]['twitter'] ; ?>" class="mdl-button mdl-button--icon"><i class="mdi mdi-twitter mdl-list__item-icon"></i></a>
                    <a href="<?php echo $xD[ 'social' ]['github'] ; ?>" class="mdl-button mdl-button--icon"><i class="mdi mdi-github-circle mdl-list__item-icon"></i></a>
                    <a href="mailto:<?php echo $xD[ 'social' ][ 'email' ] ; ?>" class="mdl-button mdl-button--icon"><i class="mdi mdi-email mdl-list__item-icon"></i></a>
              </div>
      <button type="submit" class="mdl-button mdl-button--fab addfab mdl-button--colored right"><i class="material-icons">create</i></button>
    </form>

  <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp  <?php primaryColor(); ?>">
    <div class="mdl-card__title">
    <i class="material-icons">help</i>
      <span class="mdl-button">Tips on extending Jabali</span>
    </div>
    <div class="mdl-card__supporting-text mdl-card--expand">
     <ul class="collapsible popout" data-collapsible="accordion">
        <li>
        <div class="collapsible-header"><i class="material-icons">help</i>Installing module</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li>
        <div class="collapsible-header"><i class="material-icons">help</i>Activating module</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li>
        <div class="collapsible-header"><i class="material-icons">help</i>Deactivating module</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li>
        <div class="collapsible-header"><i class="material-icons">help</i>UnInstalling module</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li>
        <div class="collapsible-header"><i class="material-icons">delete</i>Deleting module</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
      </ul>
    </div>
  </div> 
  </div><?php
} elseif ( isset( $_GET['showcase'] ) ) { ?>
  <title>Modules Showcase - <?php showOption( 'name' ); ?></title>
  <form method="POST" action="" class="mdl-grid"><?php
    $modules = file_get_contents( 'https://mauko.co.ke/api/modules/' );
    if ( $modules !== false ){
      $showcase = json_decode( $modules, true );
      foreach ($showcase as $module => $xD ) { ?>
        <div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
          <div class="mdl-card__title mdl-card--expand">
            <h5 class="mdl-card__title-text"><?php echo $xD[ 'name' ] ; ?></h5>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-card__subtitle-text">
            <a id="<?php echo $xD[ 'slug' ] ; ?>web" href="<?php echo $xD[ 'website' ] ; ?>" class="material-icons">public</a>
            <div class="mdl-tooltip" for="<?php echo $xD[ 'slug' ] ; ?>web"><?php echo $xD[ 'name' ] ; ?> Help</div>
            <a id="<?php echo $xD[ 'slug' ] ; ?>help" href="<?php echo $xD[ 'support' ] ; ?>" class="material-icons">help</a>
            <div class="mdl-tooltip" for="<?php echo $xD[ 'slug' ] ; ?>help"><?php echo $xD[ 'name' ] ; ?> Help</div>
          </div>
          </div>
          <div class="mdl-card-media">
            <img src="<?php echo _IMAGES . 'placeholder.png'; ?>" width="100%" style="overflow: hidden;" >
          </div>
          <div class="mdl-card__actions mdl-card--border">
            <?php $path = _ABSX_;
            $dir = new DirectoryIterator($path);
            $installed = array();
            foreach ($dir as $fileinfo) {
              if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $module = $fileinfo->getFilename();
                $installed[] = $module;
              }
            }

            if ( !in_array( $xD[ 'slug' ], $installed )) { ?>
              <a class="waves-effect waves-light btn red" href="?install=<?php echo $xD[ 'slug' ] ; ?>">INSTALL</a><?php
            } else { ?>
              <div class="input-field">
                      <button class="mdl-button mdl-button--icon <?php if ( activeModule( $xD[ 'slug' ] ) ) {
                        echo "mdl-button--colored";
                      } ?>" id="<?php echo $xD[ 'slug' ] ; ?>" name="activemodule" value="<?php echo $xD[ 'slug' ] ; ?>" type="submit">
                          <i class="material-icons"><?php if ( isActiveX( $xD[ 'slug' ] ) ) {
                        echo "check";
                      } else {
                        echo "save";
                        } ?></i>
                      </button>
                  </div><?php
              } ?>
              <div class="mdl-layout-spacer"></div>
              <a id = "<?php echo $xD[ 'slug' ] ; ?>author" href="#" class="material-icons alignright">more_vert</a>
              <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-right <?php primaryColor(); ?> option-drop" for="<?php echo $xD[ 'slug' ] ; ?>author" style="overflow-y: auto;">
              <a href="?view=<?php echo $xD[ 'slug' ] ; ?>&key=<?php echo $xD[ 'name'] ; ?>" class="mdl-list__item"><i class="mdi mdi-details mdl-list__item-icon"></i><span style="padding-left: 20px">Full Details</span></a>
              <a href="<?php echo $xD[ 'website'] ; ?>" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $xD[ 'author' ] ; ?></span></a>
              <div class="mdl-layout-spacer"></div>
              <a href="<?php echo $xD[ 'social' ]['facebook'] ; ?>" class="mdl-list__item"><i class="mdi mdi-facebook mdl-list__item-icon"></i><span style="padding-left: 20px">Facebook</span></a>
              <a href="<?php echo $xD[ 'social' ]['twitter'] ; ?>" class="mdl-list__item"><i class="mdi mdi-twitter mdl-list__item-icon"></i><span style="padding-left: 20px">Twitter</span></a>
              <a href="<?php echo $xD[ 'social' ]['github'] ; ?>" class="mdl-list__item"><i class="mdi mdi-github-circle mdl-list__item-icon"></i><span style="padding-left: 20px">Github</span></a>
              <a href="mailto:<?php echo $xD[ 'social' ][ 'email' ] ; ?>" class="mdl-list__item"><i class="mdi mdi-email mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $xD[ 'social' ][ 'email' ] ; ?></span></a>
              </ul>
          </div>
        </div><?php
      } 
    } else {
        _shout_( 'Error: Problem connecting to Jabalicms.org. Please try again later.', 'error');
      } ?>
  </form>
  <div class="fixed-action-btn horizontal">
  <a class="btn-floating btn-large accent">
    <i class="large material-icons">add</i>
  </a>
  <ul>
    <li><a class="btn-floating red" href="?create=module"><i class="material-icons">mode_edit</i></a></li>
    <li><a class="btn-floating green" href="?create=upload"><i class="material-icons">publish</i></a></li>
    <li><a class="btn-floating blue" href="?create=copy"><i class="material-icons">content_copy</i></a></li>
  </ul>
  </div><?php
} else { ?>
  <title>Modules - <?php showOption( 'name' ); ?></title>
  <form method="POST" action="" class="mdl-grid"><?php
      $path = _ABSX_;
      $dir = new DirectoryIterator($path);
      foreach ($dir as $fileinfo) {
          if ($fileinfo->isDir() && !$fileinfo->isDot()) {
              $module = $fileinfo->getFilename();
              if( file_exists( _ABSX_.$module."/".$module.".json" ) ) {
              $xJson = file_get_contents( _ABSX_.$module."/".$module.".json" );
              $xD = json_decode( $xJson, true ); ?>
            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
              <div class="mdl-card__title mdl-card--expand">
                <h5 class="mdl-card__title-text"><?php echo $xD[ 'name' ] ; ?></h5>
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card__subtitle-text">
                    <a id="<?php echo $xD[ 'slug' ] ; ?>web" href="<?php echo $xD[ 'website' ] ; ?>" class="material-icons">public</a>
                    <div class="mdl-tooltip" for="<?php echo $xD[ 'slug' ] ; ?>web"><?php echo $xD[ 'name' ] ; ?> Help</div>
                    <a id="<?php echo $xD[ 'slug' ] ; ?>help" href="<?php echo $xD[ 'support' ] ; ?>" class="material-icons">help</a>
                    <div class="mdl-tooltip" for="<?php echo $xD[ 'slug' ] ; ?>help"><?php echo $xD[ 'name' ] ; ?> Help</div>
              </div>
              </div>
            <div class="mdl-card-media">
          <img src="imagen.php?s=008080_F_500_500&t=<?php echo $xD[ 'slug' ] ; ?>" width="100%" style="overflow: hidden;" >
        </div>
              <div class="mdl-card__actions mdl-card--border">
                    <div class="input-field">
                        <button class="mdl-button mdl-button--icon <?php if ( isActiveX( $xD[ 'slug' ] ) ) {
                          echo "mdl-button--colored";
                        } ?>" id="<?php echo $xD[ 'slug' ] ; ?>" name="activemodule" value="<?php echo $xD[ 'slug' ] ; ?>" type="submit">
                            <i class="material-icons"><?php if ( isActiveX( $xD[ 'slug' ] ) ) {
                          echo "check";
                        } else {
                          echo "save";
                          } ?></i>
                        </button>
                    </div>
              <div class="mdl-layout-spacer"></div>
                    <a href="?edit=<?php echo $xD[ 'slug' ] ; ?>&key=<?php echo $xD[ 'slug' ] ; ?>.php" class="material-icons">create</a>
                    <a id = "<?php echo $xD[ 'slug' ] ; ?>author" href="#" class="material-icons alignright">more_vert</a>
                    <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-right <?php primaryColor(); ?> option-drop" for="<?php echo $xD[ 'slug' ] ; ?>author" style="overflow-y: auto;">
                    <a href="?view=<?php echo $xD[ 'slug' ] ; ?>&key=<?php echo $xD[ 'name'] ; ?>" class="mdl-list__item"><i class="mdi mdi-details mdl-list__item-icon"></i><span style="padding-left: 20px">Full Details</span></a>
                    <a href="<?php echo $xD[ 'website'] ; ?>" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $xD[ 'author' ] ; ?></span></a>
                    <div class="mdl-layout-spacer"></div>
                    <a href="<?php echo $xD[ 'social' ]['facebook'] ; ?>" class="mdl-list__item"><i class="mdi mdi-facebook mdl-list__item-icon"></i><span style="padding-left: 20px">Facebook</span></a>
                    <a href="<?php echo $xD[ 'social' ]['twitter'] ; ?>" class="mdl-list__item"><i class="mdi mdi-twitter mdl-list__item-icon"></i><span style="padding-left: 20px">Twitter</span></a>
                    <a href="<?php echo $xD[ 'social' ]['github'] ; ?>" class="mdl-list__item"><i class="mdi mdi-github-circle mdl-list__item-icon"></i><span style="padding-left: 20px">Github</span></a>
                    <a href="mailto:<?php echo $xD[ 'social' ][ 'email' ] ; ?>" class="mdl-list__item"><i class="mdi mdi-email mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $xD[ 'social' ][ 'email' ] ; ?></span></a>
                    </ul>
              </div>
              <?php csrf(); ?>
            </div><?php }
          }
      } ?>
    </form>

     <div class="fixed-action-btn horizontal">
    <a class="btn-floating btn-large accent">
      <i class="large material-icons">add</i>
    </a>
    <ul>
      <li><a class="btn-floating red" href="?create=module"><i class="material-icons">mode_edit</i></a></li>
      <li><a class="btn-floating green" href="?create=upload"><i class="material-icons">publish</i></a></li>
      <li><a class="btn-floating green" href="?showcase=all&page=modules showcase"><i class="material-icons">cloud_download</i></a></li>
      <li><a class="btn-floating blue" href="?create=copy"><i class="material-icons">content_copy</i></a></li>
    </ul>
  </div><?php 
}

include 'footer.php'; ?>