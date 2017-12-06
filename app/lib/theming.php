<?php 
/**
* Theme content creation utility class
* @since 0.17.10
* @author Mauko Maunde < hi@mauko.co.ke >
* @see https://jabalicms.org/dbtables/
* @license MIT - https://opensource.org/licenses/MIT
**/

namespace Jabali\Lib;

/**
* Utility class to generate html/php code for themes created by Jabali
*/
class Theming
{
    public $slug;
    public $comments;
    public $base;

    public $header;
    public $archive;
    public $single;
    public $footer;
    
    public function __construct( $slug, $comments, $base )
    
        $this -> slug = $this -> slug;
        $this -> comments = $this -> comments;
        $this -> base = $base;
        return call_user_func_array([$this, $this -> base], []);
    }

    public function normalize()
    {
  $this -> header = $this -> comments." ?>
<!DOCTYPE html>
  <html lang=\"<?php showOption( 'language' ); ?>\" xmlns=\"https://www.w3.org/1999/html\">
    <head>
      <?php head();
      loadStyles( ['css/". $this -> base .".css', 'css/". $this -> slug .".css'], '".$this -> slug ."' ); ?>
    </head>
    <body class=\"<?php //primaryColor(); ?>\" >
    <?php headerLogo(); ?>
    <main>";

  $this -> archive = $this -> comments." ?>
<?php //resetLoop(); ?>
<h1><?php archiveHeader($data); ?></h1>
<?php if( hasRecords() ): while( hasRecords() ): theRecord(); ?>
  <div>
    <figure><?php theImage('100%'); ?></figure>
    <h1><?php theTitle(); ?></h1>
    <p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
    <p>In <?php theCategories(); ?></p>
    <p>Tagged <?php theTags(); ?></p>
    <article><?php theContent(); ?></article>
    <button><?php theLink(); ?></button>
  </div>
  <br>
<?php endwhile; endif; ?>";

  $this -> single = $this -> comments." ?>
<title><?php theTitle(); ?> - <?php showOption( 'name' ); ?></title>
<?php theImage('100%'); ?>
<h1><?php theTitle(); ?></h1>
<p><?php theDate(); ?></p>
<p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
<p>In <?php theCategories(); ?></p>
<p>Tagged <?php theTags(); ?></p>
<article><?php theContent(); ?></article>";

  $this -> footer = $this -> comments." ?>
    </main>
    <footer>
      <?php theCopyright(); ?> - <?php theAttribution(); ?>
    </footer>
    <?php 
    if ( isLocalhost() ):
      loadScript( 'js/jquery.min.js', '".$this -> slug ."');
    else:
      loadScript( 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    endif;
    loadScript( 'js/".$this -> slug .".js', '".$this -> slug ."'); ?>
  <body>
</html>";
}

    public function materialize()
    {
  $this -> header = $this -> comments." ?>
<!DOCTYPE html>
  <html lang=\"<?php showOption( 'language' ); ?>\" xmlns=\"https://www.w3.org/1999/html\">
    <head>
      <?php head();
      loadStyles( ['css/". $this -> base .".css', 'css/". $this -> slug .".css'], '".$this -> slug ."' ); ?>
    </head>
    <body class=\"<?php //primaryColor(); ?>\" >
    <?php headerLogo(); ?>
    <main>";

  $this -> archive = $this -> comments." ?>
<?php //resetLoop(); ?>
<h1><?php archiveHeader($data); ?></h1>
<?php if( hasRecords() ): while( hasRecords() ): theRecord(); ?>
  <div>
    <?php theImage('100%'); ?>
    <h1><?php theTitle(); ?></h1>
    <p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
    <p>In <?php theCategories(); ?></p>
    <p>Tagged <?php theTags(); ?></p>
    <article><?php theContent(); ?></article>
    <button><?php theLink(); ?></button>
  </div>
  <br>
<?php endwhile; endif; ?>";

  $this -> single = $this -> comments." ?>
<title><?php theTitle(); ?> - <?php showOption( 'name' ); ?></title>
<?php theImage('100%'); ?>
<h1><?php theTitle(); ?></h1>
<p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
<p>In <?php theCategories(); ?></p>
<p>Tagged <?php theTags(); ?></p>
<article><?php theContent(); ?></article>";

  $this -> footer = $this -> comments." ?>
    </main>
    <footer>
      <?php theCopyright(); ?> - <?php theAttribution(); ?>
    </footer>
    <?php 
    if ( isLocalhost() ):
      loadScript( 'js/jquery.min.js', '".$this -> slug ."');
    else:
      loadScript( 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    endif;
    loadScripts( ['js/".$this -> base .".js', 'js/".$this -> slug .".js'], '".$this -> slug ."'); ?>
  <body>
</html>";
}

    public function skeleton()
    {
  $this -> header = $this -> comments." ?>
<!DOCTYPE html>
  <html lang=\"<?php showOption( 'language' ); ?>\" xmlns=\"https://www.w3.org/1999/html\">
    <head>
      <?php head();
      loadStyles( ['css/". $this -> base .".css', 'css/". $this -> slug .".css'], '".$this -> slug ."' ); ?>
    </head>
    <body class=\"<?php //primaryColor(); ?>\" >
    <?php headerLogo(); ?>
    <main>";

  $this -> archive = $this -> comments." ?>
<?php //resetLoop(); ?>
<h1><?php archiveHeader($data); ?></h1>
<?php if( hasRecords() ): while( hasRecords() ): theRecord(); ?>
  <div>
    <?php theImage('100%'); ?>
    <h1><?php theTitle(); ?></h1>
    <p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
    <p>In <?php theCategories(); ?></p>
    <p>Tagged <?php theTags(); ?></p>
    <article><?php theContent(); ?></article>
    <button><?php theLink(); ?></button>
  </div>
  <br>
<?php endwhile; endif; ?>";

  $this -> single = $this -> comments." ?>
<title><?php theTitle(); ?> - <?php showOption( 'name' ); ?></title>
<?php theImage('100%'); ?>
<h1><?php theTitle(); ?></h1>
<p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
<p>In <?php theCategories(); ?></p>
<p>Tagged <?php theTags(); ?></p>
<article><?php theContent(); ?></article>";

  $this -> footer = $this -> comments." ?>
    </main>
    <footer>
      <?php theCopyright(); ?> - <?php theAttribution(); ?>
    </footer>
    <?php 
    if ( isLocalhost() ):
      loadScript( 'js/jquery.min.js', '".$this -> slug ."');
    else:
      loadScript( 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    endif;
    loadScript( 'js/".$this -> slug .".js', '".$this -> slug ."'); ?>
  <body>
</html>";
}

    public function bootstrap()
    {
  $this -> header = $this -> comments." ?>
<!DOCTYPE html>
  <html lang=\"<?php showOption( 'language' ); ?>\" xmlns=\"https://www.w3.org/1999/html\">
    <head>
      <?php head();
      loadStyles( ['css/". $this -> base .".css', 'css/". $this -> slug .".css'], '".$this -> slug ."' ); ?>
    </head>
    <body class=\"<?php //primaryColor(); ?>\" >
    <?php headerLogo(); ?>
    <main>";

  $this -> archive = $this -> comments." ?>
<?php //resetLoop(); ?>
<h1><?php archiveHeader($data); ?></h1>
<?php if( hasRecords() ): while( hasRecords() ): theRecord(); ?>
  <div>
    <?php theImage('100%'); ?>
    <h1><?php theTitle(); ?></h1>
    <p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
    <p>In <?php theCategories(); ?></p>
    <p>Tagged <?php theTags(); ?></p>
    <article><?php theContent(); ?></article>
    <button><?php theLink(); ?></button>
  </div>
  <br>
<?php endwhile; endif; ?>";

  $this -> single = $this -> comments." ?>
<title><?php theTitle(); ?> - <?php showOption( 'name' ); ?></title>
<?php theImage('100%'); ?>
<h1><?php theTitle(); ?></h1>
<p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
<p>In <?php theCategories(); ?></p>
<p>Tagged <?php theTags(); ?></p>
<article><?php theContent(); ?></article>";

  $this -> footer = $this -> comments." ?>
    </main>
    <footer>
      <?php theCopyright(); ?> - <?php theAttribution(); ?>
    </footer>
    <?php 
    if ( isLocalhost() ):
      loadScript( 'js/jquery.min.js', '".$this -> slug ."');
    else:
      loadScript( 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    endif;
    loadScripts( ['js/".$this -> base .".js', 'js/".$this -> slug .".js'], '".$this -> slug ."'); ?>
  <body>
</html>";
}
    
    public function basic()
    {
  $this -> header = $this -> comments." ?>
<!DOCTYPE html>
  <html lang=\"<?php showOption( 'language' ); ?>\" xmlns=\"https://www.w3.org/1999/html\">
    <head>
      <?php head();
      loadStyle( 'css/". $this -> slug .".css', '".$this -> slug ."' ); ?>
    </head>
    <body class=\"<?php //primaryColor(); ?>\" >
    <?php headerLogo(); ?>
    <main>";

  $this -> archive = $this -> comments." ?>
<?php //resetLoop(); ?>
<h1><?php archiveHeader($data); ?></h1>
<?php if( hasRecords() ): while( hasRecords() ): theRecord(); ?>
  <div>
    <figure><?php theImage('100%'); ?></figure>
    <h1><?php theTitle(); ?></h1>
    <p>Published by <?php theAuthor(); ?> on <?php theDate(); ?></p>
    <p>In <?php theCategories(); ?></p>
    <p>Tagged <?php theTags(); ?></p>
    <article><?php theContent(); ?></article>
    <button><?php theLink(); ?></button>
  </div>
  <br>
<?php endwhile; endif; ?>";

  $this -> single = $this -> comments." ?>
<title><?php theTitle(); ?> - <?php showOption( 'name' ); ?></title>
<?php theImage('100%'); ?>
<h1><?php theTitle(); ?></h1>
<p><?php theDate(); ?></p>
<p><?php theCategories(); ?></p>
<p><?php theTags(); ?></p>
<article><?php theContent(); ?></article>";

  $this -> footer = $this -> comments." ?>
    </main>
    <footer>
      <?php theCopyright(); ?> - <?php theAttribution(); ?>
    </footer>
    <?php 
    if ( isLocalhost() ):
      loadScript( 'js/jquery.min.js', '".$this -> slug ."');
    else:
      loadScript( 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    endif;
    loadScript( 'js/".$this -> slug .".js', '".$this -> slug ."'); ?>
  <body>
</html>"
  }
}