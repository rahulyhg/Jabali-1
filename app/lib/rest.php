<?php 
/**
* @class REST
* @see https://jabalicms.org/restful/
* @return mixed JSON string of requested resource
* @since 0.17.10
* @author Mauko Maunde < hi@mauko.co.ke >
* @license MIT - https://opensource.org/licenses/MIT
*/

namespace Jabali\Lib;

class REST
{
  public $key;
  public $secret;
  public $data;

  public $retval;

  public function __construct( $elements = [], $key = null, $secret = null, $data = null )
  {
    $this -> key = $key;
    $this -> secret = $secret;
    $this -> data = $data;

    if ( empty( $elements[0] && $elements[0] !== "themes" ) ) {
      $this -> app();
    } elseif ( $elements[0] == "themes" ) {
      $this -> themes();
    } else {
      $table = strtoupper( $elements[0] );
      $this -> process( $elements, $table );
    }
  }

  public function process( $elements, $table )
  {
    if ( empty( $elements[1] ) ) {
      $this -> retval = $GLOBALS[$table] -> sweep();
    } else switch ( $elements[1] ) {
      case 'create':
        $this -> create();
        break;

      case 'update':
        $details = json_decode( $data, true );
        foreach ($details as $field => $value) {
          $props = get_class_vars( $GLOBALS[$table] );

          if ( in_array( $field, $props ) ) {
            $GLOBALS[$table] -> $field = $value;
          }
        }
        
        $this -> retval = $GLOBALS[$table] -> update();
        break;
      
      case 'delete':
        $details = json_decode( $data, true );
        $this -> retval = $GLOBALS[$table] -> delete( $details['id'] );
        break;

      case 'view':
        $this -> view( $elements, $table );
        break;

      default:
        $this -> retval = $GLOBALS[$table] -> getSingle( $elements[1] );
        break;
    }
  }

  public function app()
  {
    $this -> retval = array( 
      "name" => "Jabali Ruby", 
      "slug" => "ruby", 
      "version" => "0.17.12", 
      "author" => "Mauko Maunde", 
      "screenshot" => "https://mauko.co.ke/app/assets/images/avatar.png", 
      "description" => "Opensource web application framework with material design components for quick deployment.", 
      "social" => array(
        "facebook" => "https://facebook.com/jabalicms",
        "twitter" => "https://twitter.com/jabalicms",
        "github" => "https://github.com/JabaliCMS",
        "email" => "dev@jabalicms.org"
      ),
      "website" => "https://jabalicms.org/",
      "support" => "https://jabalicms.org/support",
      "documentation" => "https://docs.jabalicms.org",
      "download" => "https://jabalicms.org/dl/jabali/jabali_0.17.11.zip",
      "licenses" => array(
        "MIT" => "https://opensource.org/licenses/MIT",
        "GNU" => "https://opensource.org/licenses/gpl-license",
        "Apache" => "https://opensource.org/licenses/Apache-2.0"
      ),
      "php" => "7.0+",
      "mysql" => "5.0+",
      "sqlite" => "3.0+",
      "postgresql" => "5.0+"
    );
  }

  public function themes()
  {
    $themes = array();
    $path = _ABSTHEMES_;
    if ( is_dir( $path ) ) {
      $dir = new DirectoryIterator($path);
      foreach ($dir as $fileinfo) {
          if ($fileinfo->isDir() && !$fileinfo->isDot()) {
              $themef = $fileinfo->getFilename();
          $theme = file_get_contents( _ABSTHEMES_.$themef."/".$themef.".json" );
          $theme = json_decode( $theme, true );

          $themes[$themef] = $theme;
          }
      }
    }

    if ( !empty( $elements[1] ) ) {
      $this -> retval = $themes[$elements[1]];
    } else {
      $this -> retval = $themes;
    }
  }

  public function create()
  {
    if ( is_null( $this -> key ) || is_null( $this -> secret ) ) {
      $this -> retval = array( 
        'status' => 'fail', 
        'message' => 'App Key/Secret Missing' 
      );
    } elseif( !validateClient( $this -> key, $this -> secret )){
      $this -> retval = array( 
        'status' => 'fail', 
        'message' => 'Wrong App Key/Secret' 
      );
    } else {
      $details = json_decode( $data, true );
      foreach ($details as $field => $value) {
        $props = get_class_vars( $GLOBALS[$table] );
        
        if ( in_array( $field, $props ) ) {
          $GLOBALS[$table] -> $field = $value;
        }
      }
      
      $this -> retval = $GLOBALS[$table] -> create();
      }
  }

  public function view( $elements, $table )
  {
    if ( empty( $elements[2] ) ) {
           $this -> retval = $GLOBALS[$table] -> sweep();
        } elseif ( is_numeric( $elements[2] ) ) {
          $this -> retval = $GLOBALS[$table] -> getId( $elements[2] );
        } else {
          if ( empty( $elements[3] ) ) {
            $type = substr( $elements[2], 0,-1);
            $this -> retval = $GLOBALS[$table] -> getTypes( $type );
          } else {
            if ( empty( $elements[4] ) ) {
              if ( is_numeric( $elements[3] ) ) {
                $this -> retval = $GLOBALS[$table] -> getCreated( $elements[3] );
              } elseif ( $elements[3] == "writers") {
                $this -> retval =listWriters();
              } elseif ( $elements[3] == "categories") {
                $type = substr( $elements[2], 0,-1);
                $this -> retval = $GLOBALS[$table] -> getCategories( $elements[4], $type );
              } elseif ( $elements[3] == "tags" ) {
                $type = substr( $elements[2], 0,-1);
                $this -> retval = $GLOBALS[$table] -> getTags( $elements[4], $type );
              } elseif ( $elements[3] == "portfolio") {
                $this -> retval =listPortfolio();
              } else {
                $this -> retval = $GLOBALS[$table] -> getSingle( $elements[3] );
              }
            } else {

              if ( is_numeric( $elements[3] ) ) {
                if ( empty( $elements[5] ) ) {
                  $this -> retval = $GLOBALS[$table] -> getCreated( $elements[3].'-'.$elements[4] );
                } else {
                  $this -> retval = $GLOBALS[$table] -> getCreated( $elements[3].'-'.$elements[4].'-'.$elements[5] );
                }
              } elseif ( $elements[3] == "authors") {
                $this -> retval = $GLOBALS[$table] -> getAuthor( $elements[4] );
              } elseif ( $elements[3] == "categories") {
                $type = substr( $elements[2], 0,-1);
                $this -> retval = $GLOBALS[$table] -> getCategories( $elements[4], $type );
              } elseif ( $elements[3] == "tags") {
                $type = substr( $elements[2], 0,-1);
                $this -> retval = $GLOBALS[$table] -> getTags( $elements[4], $type );
              } else {
                $this -> retval = $GLOBALS[$table] -> getSingle( $elements[3] );
              }
            }
          }
        }
  }
}