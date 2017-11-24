<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Themes Creation Client
* @author Mauko Maunde
* @since 0.17.06
* @link https://docs.jabalicms.org/api/themes/
**/

session_start();
require_once( '../init.php' );
require_once( '../load.php' );
require_once( 'header.php' );

if ( isset( $_POST['activetheme'] ) ) {
    $activex = $_POST['activetheme'];
    $GLOBALS['OPTIONS'] -> update( 'activetheme', $activex, date('Y-m-d H:i:s') );
}

if ( isset( $_POST['createtheme'] ) ) {
  $name = $_POST['themename'];
  $slug = $_POST['themeslug'];
  $description = $_POST['themedescription'];
  $category = $_POST['themecategory'];
  $author = $_POST['themeauthor'];
  $website = $_POST['themewebsite'];
  $support = $_POST['themesupport'];
  $license = $_POST['themelicense'];
  $licenselink = $_POST['themelicenselink'];
  $facebook = $_POST['themefacebook'];
  $twitter = $_POST['themetwitter'];
  $github = $_POST['themegithub'];
  $email = $_POST['themeemail'];
  $version = $_POST['themeversion'];
  $base = strtolower( $_POST['style'] );

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
  $thdi = "<?php echo( _THEMES ); ?>". $slug;
  switch ( $base ) {
    case 'normalize':
  $headertext = $comments." ?>
<!DOCTYPE html>
  <html lang=\"<?php showOption( 'language' ); ?>\" xmlns=\"https://www.w3.org/1999/html\">
    <head>
      <?php head();
      loadStyles( ['css/". $base .".css', 'css/". $slug .".css'], '".$slug ."' ); ?>
    </head>
    <body class=\"<?php //primaryColor(); ?>\" >
    <?php headerLogo(); ?>
    <main>";

  $atemplatetext = $comments." ?>
<?php //resetLoop(); ?>
<?php if( hasRecords() ): while( hasRecords() ): theRecord(); ?>
  <?php theImage('100%'); ?>
  <h1><?php theTitle(); ?></h1>
  <p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
  <p>In <?php theCategories(); ?></p>
  <p>Tagged <?php theTags(); ?></p>
  <article><?php theContent(); ?></article>
<?php endwhile; endif; ?>";

  $templatetext = $comments." ?>
<title><?php theTitle(); ?> - <?php showOption( 'name' ); ?></title>
<?php theImage('100%'); ?>
<h1><?php theTitle(); ?></h1>
<p><?php theDate(); ?></p>
<p><?php theCategories(); ?></p>
<p><?php theTags(); ?></p>
<article><?php theContent(); ?></article>";

  $footerertext = $comments." ?>
    </main>
    <footer>
      <?php theCopyright(); ?> - <?php theAttribution(); ?>
    </footer>
    <?php 
    if ( isLocalhost() ):
      loadScript( 'js/jquery.min.js', '".$slug ."');
    else:
      loadScript( 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    endif;
    loadScript( 'js/".$slug .".js', '".$slug ."'); ?>
  <body>
</html>";
      break;

    case 'materialize':
  $headertext = $comments." ?>
<!DOCTYPE html>
  <html lang=\"<?php showOption( 'language' ); ?>\" xmlns=\"https://www.w3.org/1999/html\">
    <head>
      <?php head();
      loadStyles( ['css/". $base .".css', 'css/". $slug .".css'], '".$slug ."' ); ?>
    </head>
    <body class=\"<?php //primaryColor(); ?>\" >
    <?php headerLogo(); ?>
    <main>";

  $atemplatetext = $comments." ?>
<?php //resetLoop(); ?>
<?php if( hasRecords() ): while( hasRecords() ): theRecord(); ?>
  <?php theImage('100%'); ?>
  <h1><?php theTitle(); ?></h1>
  <p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
  <p>In <?php theCategories(); ?></p>
  <p>Tagged <?php theTags(); ?></p>
  <article><?php theContent(); ?></article>
<?php endwhile; endif; ?>";

  $templatetext = $comments." ?>
<title><?php theTitle(); ?> - <?php showOption( 'name' ); ?></title>
<?php theImage('100%'); ?>
<h1><?php theTitle(); ?></h1>
<p><?php theDate(); ?></p>
<p><?php theCategories(); ?></p>
<p><?php theTags(); ?></p>
<article><?php theContent(); ?></article>";

  $footerertext = $comments." ?>
    </main>
    <footer>
      <?php theCopyright(); ?> - <?php theAttribution(); ?>
    </footer>
    <?php 
    if ( isLocalhost() ):
      loadScript( 'js/jquery.min.js', '".$slug ."');
    else:
      loadScript( 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    endif;
    loadScripts( ['js/".$base .".js', 'js/".$slug .".js'], '".$slug ."'); ?>
  <body>
</html>";
      break;

    case 'skeleton':
  $headertext = $comments." ?>
<!DOCTYPE html>
  <html lang=\"<?php showOption( 'language' ); ?>\" xmlns=\"https://www.w3.org/1999/html\">
    <head>
      <?php head();
      loadStyles( ['css/". $base .".css', 'css/". $slug .".css'], '".$slug ."' ); ?>
    </head>
    <body class=\"<?php //primaryColor(); ?>\" >
    <?php headerLogo(); ?>
    <main>";

  $atemplatetext = $comments." ?>
<?php //resetLoop(); ?>
<?php if( hasRecords() ): while( hasRecords() ): theRecord(); ?>
  <?php theImage('100%'); ?>
  <h1><?php theTitle(); ?></h1>
  <p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
  <p>In <?php theCategories(); ?></p>
  <p>Tagged <?php theTags(); ?></p>
  <article><?php theContent(); ?></article>
<?php endwhile; endif; ?>";

  $templatetext = $comments." ?>
<title><?php theTitle(); ?> - <?php showOption( 'name' ); ?></title>
<?php theImage('100%'); ?>
<h1><?php theTitle(); ?></h1>
<p><?php theDate(); ?></p>
<p><?php theCategories(); ?></p>
<p><?php theTags(); ?></p>
<article><?php theContent(); ?></article>";

  $footerertext = $comments." ?>
    </main>
    <footer>
      <?php theCopyright(); ?> - <?php theAttribution(); ?>
    </footer>
    <?php 
    if ( isLocalhost() ):
      loadScript( 'js/jquery.min.js', '".$slug ."');
    else:
      loadScript( 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    endif;
    loadScript( 'js/".$slug .".js', '".$slug ."'); ?>
  <body>
</html>";
      break;

    case 'bootstrap':
  $headertext = $comments." ?>
<!DOCTYPE html>
  <html lang=\"<?php showOption( 'language' ); ?>\" xmlns=\"https://www.w3.org/1999/html\">
    <head>
      <?php head();
      loadStyles( ['css/". $base .".css', 'css/". $slug .".css'], '".$slug ."' ); ?>
    </head>
    <body class=\"<?php //primaryColor(); ?>\" >
    <?php headerLogo(); ?>
    <main>";

  $atemplatetext = $comments." ?>
<?php //resetLoop(); ?>
<?php if( hasRecords() ): while( hasRecords() ): theRecord(); ?>
  <?php theImage('100%'); ?>
  <h1><?php theTitle(); ?></h1>
  <p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
  <p>In <?php theCategories(); ?></p>
  <p>Tagged <?php theTags(); ?></p>
  <article><?php theContent(); ?></article>
<?php endwhile; endif; ?>";

  $templatetext = $comments." ?>
<title><?php theTitle(); ?> - <?php showOption( 'name' ); ?></title>
<?php theImage('100%'); ?>
<h1><?php theTitle(); ?></h1>
<p><?php theDate(); ?></p>
<p><?php theCategories(); ?></p>
<p><?php theTags(); ?></p>
<article><?php theContent(); ?></article>";

  $footerertext = $comments." ?>
    </main>
    <footer>
      <?php theCopyright(); ?> - <?php theAttribution(); ?>
    </footer>
    <?php 
    if ( isLocalhost() ):
      loadScript( 'js/jquery.min.js', '".$slug ."');
    else:
      loadScript( 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    endif;
    loadScripts( ['js/".$base .".js', 'js/".$slug .".js'], '".$slug ."'); ?>
  <body>
</html>";
      break;
    
    default:
  $headertext = $comments." ?>
<!DOCTYPE html>
  <html lang=\"<?php showOption( 'language' ); ?>\" xmlns=\"https://www.w3.org/1999/html\">
    <head>
      <?php head();
      loadStyle( 'css/". $slug .".css', '".$slug ."' ); ?>
    </head>
    <body class=\"<?php //primaryColor(); ?>\" >
    <?php headerLogo(); ?>
    <main>";

  $atemplatetext = $comments." ?>
<?php //resetLoop(); ?>
<?php if( hasRecords() ): while( hasRecords() ): theRecord(); ?>
  <?php theImage('100%'); ?>
  <h1><?php theTitle(); ?></h1>
  <p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
  <p>In <?php theCategories(); ?></p>
  <p>Tagged <?php theTags(); ?></p>
  <article><?php theContent(); ?></article>
<?php endwhile; endif; ?>";

  $templatetext = $comments." ?>
<title><?php theTitle(); ?> - <?php showOption( 'name' ); ?></title>
<?php theImage('100%'); ?>
<h1><?php theTitle(); ?></h1>
<p><?php theDate(); ?></p>
<p><?php theCategories(); ?></p>
<p><?php theTags(); ?></p>
<article><?php theContent(); ?></article>";

  $footerertext = $comments." ?>
    </main>
    <footer>
      <?php theCopyright(); ?> - <?php theAttribution(); ?>
    </footer>
    <?php 
    if ( isLocalhost() ):
      loadScript( 'js/jquery.min.js', '".$slug ."');
    else:
      loadScript( 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    endif;
    loadScript( 'js/".$slug .".js', '".$slug ."'); ?>
  <body>
</html>";
      break;
  }

    $themeclass = $comments."

namespace Themes\\".ucwords( $slug )."\Classes;

class ".ucwords( $slug )."
{
  public function __construct( \$args = \"\" )
  {
    //body
  }
}";

  $themedir = _ABSTHEMES_ . $slug.'/';
  $templates = _ABSTHEMES_ . $slug.'/templates/';
  $css = _ABSTHEMES_ . $slug.'/assets/css/';
  $js = _ABSTHEMES_ . $slug.'/assets/js/';
  $images = _ABSTHEMES_ . $slug.'/assets/images/';
  $classes = _ABSTHEMES_ . $slug.'/classes/';

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
  "link": "https://jabalicms.org/themes/'.$slug.'",
  "website": "'.$website.'",
  "support": "'.$support.'",
  "download": "https://jabalicms.org/dl/themes/'.$slug.'.zip",
  "licences": {
    "'.$license.'": "'.$licenselink.'"
  }
}';

$script = "\$(document).ready(function(){
   //
});";

  if ( is_dir( _ABSTHEMES_ . $slug.'/' ) ) {
    _shout_( "<p>Sorry, could not create new theme.</p>
    <p>A directory named <b><code>". $slug."</code></b> already exists.</p>
    <h6>Naming Tips: </h6>

    <li>Use a very unique slug e.g  <b><code>myveryuniqueslug</code></b></li>
    <li>Prefix your slug e.g  <b><code>my_prefixed_slug</code></b></li>", "error" );
  } else {
    $umaskz = umask(0);
    if ( mkdir( $themedir, 0777 )) {
      mkdir( $templates, 0777, true );
      mkdir( $css, 0777, true );
      mkdir( $js, 0777, true );
      mkdir( $images, 0777, true );
      mkdir( $classes, 0777, true );

      $licensefile = fopen($themedir.'LICENSE', 'w');
      $themefunctions = fopen( $themedir.$slug.'.php', 'w');
      $themeheader = fopen( $themedir.'header.php', 'w');
      $themefooter = fopen( $themedir.'footer.php', 'w');
      $themearchivetemplate = fopen( $themedir.'templates/archive.php', 'w');
      $themeclassfile = fopen( $themedir.'classes/'.$slug.'.php', 'w');
      $themeposttemplate = fopen( $themedir.'templates/single.php', 'w');
      $themestyles = fopen( $themedir.'assets/css/'.$slug.'.css', 'w');
      $themebstyle = fopen( $themedir.'assets/css/'.$base.'.css', 'w');
      $themescripts = fopen( $themedir.'assets/js/'.$slug.'.js', 'w');
      $jquery = file_get_contents( _SCRIPTS.'jquery-3.2.1.min.js' );
      $jcss = file_get_contents( _STYLES.'colors.css' );
      $basecss = file_get_contents( _STYLES.$base.'.css' );
      $themejquery = fopen( $themedir.'assets/js/jquery.min.js', 'w');
      $themedata = fopen( $themedir.$slug.'.json', 'w');

      fwrite( $licensefile, $licensetext );
      fwrite( $themefunctions, $comments );
      fwrite( $themedata, $data );
      fwrite( $themeheader, $headertext );
      fwrite( $themeclassfile, $themeclass );
      fwrite( $themearchivetemplate, $atemplatetext );
      fwrite( $themeposttemplate, $templatetext );
      fwrite( $themefooter, $footerertext );
      fwrite( $themejquery, $jquery );
      fwrite( $themescripts, $script );
      fwrite( $themestyles, $jcss );
      fwrite( $themebstyle, $basecss );

      fclose( $licensefile );
      fclose( $themeclassfile );  
      fclose( $themefunctions );
      fclose( $themedata );
      fclose( $themeheader );
      fclose( $themearchivetemplate );
      fclose( $themeposttemplate );
      fclose( $themestyles );
      fclose( $themebstyle );
      fclose( $themescripts );
      fclose( $themefooter );

      if ( $base == "bootstrap" || $base == "materialize" ) {
        file_put_contents( $themedir.'assets/js/'.$base.'.js', file_get_contents( _SCRIPTS.$base.'.js') );
      }

      _shout_( 'New theme created successfully! <a href="?edit='.$slug.'&key='.$slug.'.php">Click here</a> to edit.', 'success' );
    } else {
      _shout_( "Could not create theme files. Make sure Jabali has the correct write permissions to the installation directory and try again.", "error" );
    }
    umask( $umaskz );
  }
}

if ( isset( $_POST['copytheme'] ) ) {
  $source = $_POST['source'];
  $name = $_POST['themename'];
  $slug = $_POST['themeslug'];
  $description = $_POST['themedescription'];
  $author = $_POST['themeauthor'];
  $website = $_POST['themewebsite'];
  $support = $_POST['themesupport'];
  $license = $_POST['themelicense'];
  $licenselink = $_POST['themelicenselink'];
  $facebook = $_POST['themefacebook'];
  $twitter = $_POST['themetwitter'];
  $github = $_POST['themegithub'];
  $email = $_POST['themeemail'];
  $version = $_POST['themeversion'];

  $comments = "
  <?php
  /**
  * @package Jabali - The Plug-N-Play Framework
  * @subpackage ". $name ."
  * @author ". $author ."
  * @link ". $website ."
  * @since ". $version ."
  **/\n";

  $newtheme = _ABSTHEMES_ . $slug.'/';
  $oldtheme = _ABSTHEMES_ . $source.'/';
  $templates = _ABSTHEMES_ . $slug.'/templates/';
  $css = _ABSTHEMES_ . $slug.'/assets/css/';
  $js = _ABSTHEMES_ . $slug.'/assets/js/';
  $images = _ABSTHEMES_ . $slug.'/assets/images/';
  $classes = _ABSTHEMES_ . $slug.'/classes/';

  $headertext = $comments."?>";

  $templatetext = $comments."?>\n";

  $footerertext = $comments."?>\n";

  $data = array( "name" => $name, "slug" => $slug, "version" => $version, "author" => $author, "category" => $category, "screenshot" => "", "description" => $description, "social" => array( "facebook" => $facebook, "twitter" => $twitter, "github" => $github, "email" => $email ), "website" => $website, "support" => $support, "download" => "https://jabali.io/themes/".$slug, "licenses" => array( $license => $licenselink ) );

  if ( reCopy( $oldtheme, $newtheme ) ) {
    file_put_contents($newtheme.$slug.'.php', $comments);
    file_put_contents($newtheme.$slug.'.json', $data);
    file_put_contents($css.$slug.'.css', $data);
    file_put_contents($js.$slug.'.js', $data);

    _shout_( 'New theme created from '. $source.'! <a href="?edit='.$slug.'&key='.$slug.'.php">Click here</a> to edit', 'success' );
  } else {
    _shout_( 'Could not create theme files. Make sure Jabali has the correct write permissions to the installation directory and try again.', 'error');
  }
}

if ( isset( $_POST['savefile'] ) ) {
  $theme = $_POST['theme'];
  $file = $_POST['file'];
  $contents = $_POST['filecontents'];

  if ( file_put_contents( _ABSTHEMES_.$theme.'/'.$file, $contents ) ) {
    _shout_( ucwords( $file )." Saved Successfully!", "success" );
  } else{
    _shout_( "Could not save ".$file, "error" );
  }
}

if ( isset( $_POST['deletefile'] ) ) {
  $theme = $_POST['theme'];
  $file = $_POST['deletefile'];

  if ( unlink( _ABSTHEMES_.$theme.'/'.$file ) ) {
    _shout_( ucwords( $file )." Deleted Successfully!", "success" );
  } else{
    _shout_( "Could not delete ".$file, "error" );
  }
}

if ( isset( $_POST['uploadtheme'] ) ) {
  $filename = $_FILES["up_theme"]["name"];
  $source = $_FILES["up_theme"]["tmp_name"];
  $type = $_FILES["up_theme"]["type"];
  
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
      $zip->extractTo( _ABSTHEMES_ );
      $zip->close();
  
      unlink($target_path);
    }
    $message = "Your .zip file was uploaded and unpacked.";
  } else {  
    $message = "There was a problem with the upload. Please try again.";
  }
}
if ( isset( $_GET['install'] ) ) {
  if ( isset( $_GET['download'] ) ) {
    $download = $_GET['download'];
  } else {
    $download = 'https://jabalicms.org/dl/jabali/themes/'.$_GET['install'].'.zip';
  }

  if ( !is_file(  _ABSTEMP_.'themes/'.$_GET['install'].'.zip' ) ) { ?>
     <div class="mdl-grid" >
      <div class="mdl-cell mdl-cell--12-col mdl-card <?php primaryColor() ?>" >
        <div class="mdl-card__supporting-text">
        <p>Downloading Theme from Jabali</p><?php
    if ( fopen( $download, 'r') ) {

      $directory = _ABSTEMP_ . "themes/";

      if ( !is_dir( $directory ) ) { mkdir( $directory, 0777, true ); }

      file_put_contents( _ABSTEMP_.'themes/'.$_GET['install'].'.zip', fopen('https://jabalicms.org/dl/jabali/themes/'.$_GET['install'].'.zip', 'r') );
      echo '<p>Theme Downloaded And Saved</p>Installing theme...';
      intallTheme( _ABSTEMP_.'themes/'.$_GET['install'].".zip" );
    } else {
      echo '<p>Could not get theme from Jabali.</p></div></div></div>';
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
          <input type="file" name="up_theme">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text" value="Select Theme Zip To Upload">
        </div>
      </div>

      <div class="mdl-cell mdl-cell--4-col file-field input-field">
        <button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="uploadtheme"><i class="material-icons">forward</i></button>
      </div>
    </form>
    <div class="mdl-cell mdl-cell--4-col file-field input-field mdl-card mdl-shadow--2dp <?php primaryColor(); ?>">
      
       <a class="mdl-button mdl-button--fab mdl-button--colored addfab" href="?create=theme"><i class ="material-icons">create</i></a>
      <div><?php
        $path = _ABSTHEMES_;
        $dir = new DirectoryIterator($path);
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $theme = $fileinfo->getFilename();
                $xJson = file_get_contents( _ABSTHEMES_.$theme."/".$theme.".json" );
                $xD = json_decode( $xJson, true ); ?>
                      <a href="?copy=theme&source=<?php echo $xD[ 'slug' ] ; ?>" class="mdl-list__item"><i class="mdi mdi-content-copy mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $xD[ 'name' ] ; ?></span></a><?php
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
                    $path = _ABSTHEMES_;
                    $dir = new DirectoryIterator($path);
                    foreach ($dir as $fileinfo) {
                        if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                            $theme = $fileinfo->getFilename(); ?>
                                  <a href="?create=copy&source=<?php echo $theme; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo ucwords( $theme ); ?></span></a><?php
                        }
                    } ?>
           </ul>
          <label for="type" >Select Source</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">label</i>
          <!-- To-Do: Generate randm fancy names for theme + lowecase for slug -->
          <input type="text" id="themename" name="themename" required >
          <label for="themename" >Theme Name</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">label_outline</i>
          <input type="text" id="themeslug" name="themeslug" required >
          <label for="themeslug" >Theme Slug</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">bubble_chart</i>
          <input type="text" id="themecategory" name="themecategory" value="Blog">
          <label for="themecategory" >Theme Category</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">description</i>
          <textarea id="themedesc" name="themedescription" class="materialize-textarea"></textarea>
          <label for="themedesc" >Theme Description</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">bubble_chart</i>
          <input type="text" id="themeversion" name="themeversion" value="<?php echo( "0.".date( 'Y.m' ) ); ?>">
          <label for="themeversion" >Theme Version</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">perm_identity</i>
          <input type="text" id="themeauthor" name="themeauthor" required >
          <label for="themeauthor" >Theme Author</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">public</i>
          <input type="text" id="themewebsite" name="themewebsite" value="https://jabalicms.org/themes/">
          <label for="themewebsite" >Theme Website</label>
        </div>

        <div class="input-field">
          <i class="material-icons prefix">help</i>
          <input type="text" id="themesupport" name="themesupport" required >
          <label for="themesupport" >Theme Support</label>
        </div>

        <div class="input-field">
          <i class="material-icons prefix">lock_outline</i>
          <input type="text" id="themelicense" name="themelicense" value="MIT">
          <label for="themelicense" >Theme License</label>
        </div>

        <div class="input-field">
          <i class="material-icons prefix">link</i>
          <input type="text" id="themelicenselink" name="themelicenselink" value="https://opensource.org/licenses/MIT">
          <label for="themelicenselink" >License Link</label>
        </div>
        <?php csrf(); ?>

      </div>
      </div>
      <div class="mdl-cell mdl-cell--4-col <?php primaryColor(); ?> mdl-card">
        <div class="mdl_card__image">
          <img src="<?php echo _IMAGES . 'placeholder.png'; ?>" width="100%">
        </div>
        <div class="mdl-card__supporting-text">
          <h3>Theme Social</h3>
          <div class="input-field">
          <i class="fa fa-facebook prefix"></i>
          <input type="text" id="themefb" name="themefacebook">
          <label for="themefb" >Facebook</label>
          </div>
          <div class="input-field">
            <i class="fa fa-twitter prefix"></i>
            <input type="text" id="themetwitter" name="themetwitter">
            <label for="themetwitter" >Twitter</label>
          </div>
          <div class="input-field">
            <i class="fa fa-github prefix"></i>
            <input type="text" id="themegithub" name="themegithub">
            <label for="themegithub" >Github</label>
          </div>
          <div class="input-field">
            <i class="fa fa-envelope prefix"></i>
            <input type="text" id="themeemail" name="themeemail" required >
            <label for="themeemail" >Email</label>
          </div>
        </div>

        <button type="submit" name="copytheme" class="mdl-button mdl-button--fab addfab mdl-button--colored"><i class="material-icons">forward</i></button>
      </div>
    </form><?php 
  } else { ?>
    <form method="POST" action="" class="mdl-grid">
      <div class="mdl-cell mdl-cell--8-col <?php primaryColor(); ?> mdl-card">
      <div class="mdl-card__supporting-text">
        <div class="input-field">
          <i class="material-icons prefix">label</i>
          <!-- To-Do: Generate randm fancy names for theme + lowecase for slug -->
          <input type="text" id="themename" name="themename" required >
          <label for="themename" >Theme Name</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">label_outline</i>
          <input type="text" id="themeslug" name="themeslug" required >
          <label for="themeslug" >Theme Slug</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">bubble_chart</i>
          <input type="text" id="themecategory" name="themecategory" value="Blog">
          <label for="themecategory" >Theme Category</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">description</i>
          <textarea id="themedesc" name="themedescription" class="materialize-textarea">My amazing theme.</textarea>
          <label for="themedesc" >Theme Description</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">bubble_chart</i>
          <input type="text" id="themeversion" name="themeversion" value="<?php echo( "0.".date( 'y.m' ) ); ?>">
          <label for="themeversion" >Theme Version</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">perm_identity</i>
          <input type="text" id="themeauthor" name="themeauthor" required >
          <label for="themeauthor" >Theme Author</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">public</i>
          <input type="text" id="themewebsite" name="themewebsite" value="https://jabalicms.org/themes/">
          <label for="themewebsite" >Theme Website</label>
        </div>

        <div class="input-field">
          <i class="material-icons prefix">help</i>
          <input type="text" id="themesupport" name="themesupport" required >
          <label for="themesupport" >Theme Support</label>
        </div>

        <div class="input-field">
          <i class="material-icons prefix">lock_outline</i>
          <input type="text" id="themelicense" name="themelicense" value="MIT">
          <label for="themelicense" >Theme License</label>
        </div>

        <div class="input-field">
          <i class="material-icons prefix">link</i>
          <input type="text" id="themelicenselink" name="themelicenselink" value="https://opensource.org/licenses/MIT">
          <label for="themelicenselink" >License Link</label>
        </div>
        <?php csrf(); ?>

      </div>
      </div>
      <div class="mdl-cell mdl-cell--4-col <?php primaryColor(); ?> mdl-card">
        <div class="mdl_card__image">
          <img src="<?php echo _IMAGES . 'placeholder.png'; ?>" width="100%">
        </div>
        <div class="mdl-card__supporting-text">
          <div class="input-field getmdl-select">
          <i class="material-icons prefix">palette</i>
           <input class="mdl-textfield__input" id="style" name="style" type="text" readonly tabIndex="-1" value="Normalize" >
             <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu <?php primaryColor(); ?>" for="style" style="max-height: 500px !important; overflow-y: auto;">
              <li class="mdl-menu__item" data-val="">Normalize</li>
              <li class="mdl-menu__item" data-val="">Skeleton</li>
              <li class="mdl-menu__item" data-val="">Materialize</li>
              <li class="mdl-menu__item" data-val="">Bootstrap</li>
              <li class="mdl-menu__item" data-val="">Basic</li>
             </ul>
            <label for="style" >Base Stylesheet</label>
          </div>
          <h3>Theme Social</h3>
          <div class="input-field">
          <i class="fa fa-facebook prefix"></i>
          <input type="text" id="themefb" name="themefacebook" value="https://facebook.com/">
          <label for="themefb" >Facebook</label>
          </div>
          <div class="input-field">
            <i class="fa fa-twitter prefix"></i>
            <input type="text" id="themetwitter" name="themetwitter" value="https://twitter.com/">
            <label for="themetwitter" >Twitter</label>
          </div>
          <div class="input-field">
            <i class="fa fa-github prefix"></i>
            <input type="text" id="themegithub" name="themegithub" value="https://github.com/">
            <label for="themegithub" >Github</label>
          </div>
          <div class="input-field">
            <i class="fa fa-envelope prefix"></i>
            <input type="text" id="themeemail" name="themeemail">
            <label for="themeemail" >Email</label>
          </div>
        </div>

        <button type="submit" name="createtheme" class="mdl-button mdl-button--fab addfab mdl-button--colored"><i class="material-icons">forward</i></button>
      </div>
    </form><?php 
  }
} elseif ( isset( $_GET['edit'] ) ) {
  $theme =  $_GET['edit'];
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
      <p><?php echo '<code>themes/' . $theme . '/' . $file . '</code>'; ?><span class="alignright"><button class="mdl-button mdl-button--icon mdl-button--colored" type="submit" name="deletefile" value="<?php echo $file; ?>"><i class="material-icons">delete</i></button></span></p>
      <div class="input-field">
      <i class="material-icons prefix">label</i>
        <input type="text" id="filename" name="file" value="<?php echo( $file ); ?>">
        <label for="filename" >File Name</label>
      </div>
      <div class="input-field">
        <textarea class="materialize-textarea" name="filecontents" id="filecontents" data-editor="<?php echo $mode; ?>" data-theme="<?php showOption( 'acetheme'); ?>" data-gutter="1" width="100%" style="height: 800px;"><?php 
        if ( file_exists( _ABSTHEMES_ . $theme . '/' . $file ) ) {
          $contents = file_get_contents( _ABSTHEMES_ . $theme . '/' . $file );
        } else {
          $contents = "Sorry, this file does not exist.";
        }
        echo $contents; ?></textarea>
      </div>
      <input type="hidden" name="theme" value="<?php echo( $theme ); ?>">
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
                $path = _ABSTHEMES_ . $_GET['edit'] . '/';
                $dir = new DirectoryIterator($path);
                foreach ($dir as $fileinfo) {
                    if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                        $theme = $fileinfo->getFilename(); ?>
                              <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo $theme; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $theme ; ?></span></a><?php
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
                  <span class="mdl-card__title-text">Templates</span>
                <div class="mdl-layout-spacer"></div>
              </div>
              <div class="mdl-card__supporting-text mdl-card--expand">
                <?php
                $path = _ABSTHEMES_ . $_GET['edit'] . '/templates/';
                if ( is_dir( $path ) ) {
                  $dir = new DirectoryIterator($path);
                  foreach ($dir as $fileinfo) {
                      if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                          $theme = $fileinfo->getFilename(); ?>
                                <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo 'templates/'.$theme; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $theme ; ?></span></a><?php
                      }
                  }
                 } ?>
              </div>

              <div class="mdl-card__menu">
              <a href="?add=template&key=<?php echo $_GET['edit']; ?>" class="mdl-button mdl-button--icon"><i class="material-icons">add</i></a>
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
                $path = _ABSTHEMES_ . $_GET['edit'] . '/assets/css/';
                 if ( is_dir( $path ) ) {
                    $dir = new DirectoryIterator($path);
                    foreach ($dir as $fileinfo) {
                        if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                            $theme = $fileinfo->getFilename(); ?>
                                  <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo 'assets/css/'.$theme; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $theme ; ?></span></a><?php
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
                $path = _ABSTHEMES_ . $_GET['edit'] . '/assets/js/';
                if (is_dir( $path ) ) {
                  $dir = new DirectoryIterator($path);
                  foreach ($dir as $fileinfo) {
                      if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                          $theme = $fileinfo->getFilename(); ?>
                                <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo 'assets/js/'.$theme; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $theme; ?></span></a><?php
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
                $path = _ABSTHEMES_ . $_GET['edit'] . '/classes/';
                if ( is_dir( $path ) ) {
                  $dir = new DirectoryIterator($path);
                  foreach ($dir as $fileinfo) {
                      if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                          $theme = $fileinfo->getFilename(); ?>
                                <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo 'classes/'.$theme; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $theme ; ?></span></a><?php
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
  $theme =  $_GET['add'];
  $file =  $_GET['key'];

  if ( $theme == "file" ) {
     $path = "";
     $mode = "php";
   } elseif ( $theme == "template" ) {
     $path = "templates";
     $mode = "php";
   } elseif ( $theme == "css" ) {
     $path = "assets/css";
     $mode = "css";
   } elseif ( $theme == "js" ) {
     $path = "assets/js";
     $mode = "javascript";
   } elseif ( $theme == "class" ) {
     $path = "classes";
     $mode = "php";
   } else {
     $path = "";
     $mode = "php";
   } ?>
  <title>Adding File To <?php echo( ucwords( $_GET['key'] ) ); ?> Theme - <?php showOption( 'name' ); ?></title>
  <form class="mdl-grid" method="POST" action="">
        <div class="mdl-cell mdl-cell--8-col mdl-card">
          <div class="mdl-card__supporting-text <?php primaryColor(); ?>">
          <p><?php echo '<code>themes/' . $file . '/~.'. $theme .'</code>'; ?></p>
            <div class="input-field">
            <i class="material-icons prefix">label</i>
              <input type="text" id="filename" name="file" value="<?php echo( $path ); ?>/">
              <label for="filename" >File Name</label>
            </div>
          <div class="input-field">
            <textarea class="materialize-textarea" name="filecontents" id="filecontents" data-editor="<?php echo $mode; ?>" data-theme="<?php showOption( 'acetheme'); ?> data-gutter="1" width="100%" style="height: 600px;"><?php
            $theme = file_get_contents( _ABSTHEMES_ . $file .'/'. $file.'.json');
            $deets = json_decode( $theme, true );
            echo '<?php';
            echo "\r\n";
            echo '/**';
            echo "\r\n";
            echo '* @package Jabali - The Plug-N-Play Framework';
            echo "\r\n";
            echo '* @subpackage '. $deets['name'];
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
          <input type="hidden" name="theme" value="<?php echo( $file ); ?>">
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
              $path = _ABSTHEMES_ . $_GET['key'] . '/';
              $dir = new DirectoryIterator($path);
              foreach ($dir as $fileinfo) {
                  if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                      $theme = $fileinfo->getFilename(); ?>
                            <a href="?edit=<?php echo $_GET['key']; ?>&key=<?php echo $theme; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $theme ; ?></span></a><?php
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
                    $path = _ABSTHEMES_ . $_GET['key'] . '/templates/';
                    if ( is_dir( $path ) ) {
                      $dir = new DirectoryIterator($path);
                      foreach ($dir as $fileinfo) {
                          if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                              $theme = $fileinfo->getFilename(); ?>
                                    <a href="?edit=<?php echo $_GET['key']; ?>&key=<?php echo 'templates/'.$theme; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $theme ; ?></span></a><?php
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
                    $path = _ABSTHEMES_ . $_GET['key'] . '/assets/css/';
                     if ( is_dir( $path ) ) {
                        $dir = new DirectoryIterator($path);
                        foreach ($dir as $fileinfo) {
                            if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                                $theme = $fileinfo->getFilename(); ?>
                                      <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo 'assets/css/'.$theme; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $theme ; ?></span></a><?php
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
                    $path = _ABSTHEMES_ . $_GET['key'] . '/assets/js/';
                    if (is_dir( $path ) ) {
                      $dir = new DirectoryIterator($path);
                      foreach ($dir as $fileinfo) {
                          if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                              $theme = $fileinfo->getFilename(); ?>
                                    <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo 'assets/js/'.$theme; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $theme; ?></span></a><?php
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
                    $path = _ABSTHEMES_ . $_GET['key'] . '/classes/';
                    if ( is_dir( $path ) ) {
                      $dir = new DirectoryIterator($path);
                      foreach ($dir as $fileinfo) {
                          if ($fileinfo->isFile() && !$fileinfo->isDot()) {
                              $theme = $fileinfo->getFilename(); ?>
                                    <a href="?edit=<?php echo $_GET['edit']; ?>&key=<?php echo 'classes/'.$theme; ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $theme ; ?></span></a><?php
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
  $theme = $_GET['view'];
  $xJson = file_get_contents( _ABSTHEMES_.$theme."/".$theme.".json" );
  $xD = json_decode( $xJson, true );

  $path = _ABSTHEMES_;
  $dir = new DirectoryIterator($path);
  $installed = array();
  foreach ($dir as $fileinfo) {
    if ($fileinfo->isDir() && !$fileinfo->isDot()) {
      $theme = $fileinfo->getFilename();
      $installed[] = $theme;
    }
  } ?>
  <title>Theme: <?php echo( $_GET['key'] ); ?> - <?php showOption( 'name' ); ?></title>
  <div class="mdl-grid">
  <form method="POST" action="" class="mdl-cell mdl-cell--7-col mdl-shadow--2dp <?php primaryColor(); ?> mdl-card">
            <div class="mdl-card__image">
          <img src="<?php echo _IMAGES . 'placeholder.png'; ?>" width="100%" style="overflow: hidden;" >
        </div>
              <div class="mdl-card__supporting-text">
                <?php echo $xD[ 'description' ] ; ?>
              </div>
              <div class="mdl-card__menu">
                <a href="?edit=<?php echo $xD[ 'slug' ] ; ?>&key=<?php echo $xD[ 'slug' ] ; ?>.php" class="material-icons">create</a>
                <a href="options?options=<?php echo $xD[ 'settings' ] ; ?>&page=theme settings" class="material-icons" >settings</a>
              </div>
              <div class="mdl-card__actions mdl-card--border"><?php
                if ( in_array( $xD[ 'slug' ], $installed )) { ?>
                    <div class="input-field">
                        <button class="mdl-button mdl-button--icon <?php if ( activeTheme( $xD[ 'slug' ] ) ) {
                          echo "mdl-button--colored";
                        } ?>" id="<?php echo $xD[ 'slug' ] ; ?>" name="activetheme" value="<?php echo $xD[ 'slug' ] ; ?>" type="submit">
                          <?php csrf(); ?>
                            <i class="material-icons"><?php if ( activeTheme( $xD[ 'slug' ] ) ) {
                          echo "check";
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
      <a href="?create=copy&source=<?php echo $xD[ 'slug' ] ; ?>" class="mdl-button mdl-button--fab addfab mdl-button--colored"><i class="material-icons">content_copy</i></a>
    </form>
      <ul class="mdl-cell mdl-cell--5-col mdl-card mdl-shadow--2dp collapsible popout" data-collapsible="accordion">
        <li class="<?php  primaryColor(); ?>">
        <div class="collapsible-header active"><i class="material-icons">file_downloadp</i>Installing theme</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li class="<?php  primaryColor(); ?>">
        <div class="collapsible-header"><i class="material-icons">power</i>Activating theme</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li class="<?php  primaryColor(); ?>">
        <div class="collapsible-header"><i class="material-icons">help</i>Deactivating theme</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li class="<?php  primaryColor(); ?>">
        <div class="collapsible-header"><i class="material-icons">help</i>UnInstalling theme</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li class="<?php  primaryColor(); ?>">
        <div class="collapsible-header"><i class="material-icons">delete</i>Deleting theme</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
      </ul>
    </div>
  </div> 
  </div><?php
} elseif ( isset( $_GET['showcase'] ) ) { ?>
  <title>Themes Showcase - <?php showOption( 'name' ); ?></title>
  <form method="POST" action="" class="mdl-grid"><?php
    $themes = file_get_contents( 'https://mauko.co.ke/api/themes/' );
    if ( $themes !== false ){
      $showcase = json_decode( $themes, true );
      foreach ($showcase as $theme => $xD ) { ?>
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
            <?php $path = _ABSTHEMES_;
            $dir = new DirectoryIterator($path);
            $installed = array();
            foreach ($dir as $fileinfo) {
              if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $theme = $fileinfo->getFilename();
                $installed[] = $theme;
              }
            }

            if ( !in_array( $xD[ 'slug' ], $installed )) { ?>
              <a class="waves-effect waves-light btn red" href="?install=<?php echo $xD[ 'slug' ] ; ?>">INSTALL</a><?php
            } else { ?>
              <div class="input-field">
                      <button class="mdl-button mdl-button--icon <?php if ( activeTheme( $xD[ 'slug' ] ) ) {
                        echo "mdl-button--colored";
                      } ?>" id="<?php echo $xD[ 'slug' ] ; ?>" name="activetheme" value="<?php echo $xD[ 'slug' ] ; ?>" type="submit">
                          <i class="material-icons"><?php if ( activeTheme( $xD[ 'slug' ] ) ) {
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
              <a href="<?php echo $xD[ 'website'] ; ?>" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon"></i><span style="padding-left: 20px">Author: <?php echo $xD[ 'author' ] ; ?></span></a>
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
    <li><a class="btn-floating red" href="?create=theme"><i class="material-icons">mode_edit</i></a></li>
    <li><a class="btn-floating green" href="?create=upload"><i class="material-icons">publish</i></a></li>
    <li><a class="btn-floating blue" href="?create=copy"><i class="material-icons">content_copy</i></a></li>
  </ul>
  </div><?php
} else { ?>
  <title>Themes - <?php showOption( 'name' ); ?></title>
  <form method="POST" action="" class="mdl-grid"><?php
      $path = _ABSTHEMES_;
      $dir = new DirectoryIterator($path);
      foreach ($dir as $fileinfo) {
          if ($fileinfo->isDir() && !$fileinfo->isDot()) {
              $theme = $fileinfo->getFilename();
              if( file_exists( _ABSTHEMES_.$theme."/".$theme.".json" ) ) {
              $xJson = file_get_contents( _ABSTHEMES_.$theme."/".$theme.".json" );
              $xD = json_decode( $xJson, true ); ?>
            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--4dp <?php primaryColor(); ?>">
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
            <div class="mdl-card__image">
          <img src="imagen.php?s=008080_F_400_400&t=<?php echo $xD[ 'slug' ] ; ?>" width="100%" style="overflow: hidden;" >
        </div>
              <div class="mdl-card__actions mdl-card--border">
                    <div class="input-field">
                        <button class="mdl-button mdl-button--icon <?php if ( activeTheme( $xD[ 'slug' ] ) ) {
                          echo "mdl-button--colored";
                        } ?>" id="<?php echo $xD[ 'slug' ] ; ?>" name="activetheme" value="<?php echo $xD[ 'slug' ] ; ?>" type="submit">
                            <i class="material-icons"><?php if ( activeTheme( $xD[ 'slug' ] ) ) {
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
                    <a href="<?php echo $xD[ 'website'] ; ?>" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon"></i><span style="padding-left: 20px">Author: <?php echo $xD[ 'author' ] ; ?></span></a>
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
      <li><a class="btn-floating red" href="?create=theme"><i class="material-icons">mode_edit</i></a></li>
      <li><a class="btn-floating green" href="?create=upload"><i class="material-icons">publish</i></a></li>
      <li><a class="btn-floating green" href="?showcase=all&page=themes showcase"><i class="material-icons">cloud_download</i></a></li>
      <li><a class="btn-floating blue" href="?create=copy"><i class="material-icons">content_copy</i></a></li>
    </ul>
  </div><?php 
}

include 'footer.php'; ?>