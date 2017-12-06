<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Resurces Data Access Object
* @author Mauko Maunde < hi@mauko.co.ke >
* @link https://docs.jabalicms.org/data/access/objects/resources/
* @since 0.17.09
* @license MIT - https://opensource.org/licenses/MIT
**/

namespace Jabali\Data\Access\Objects;

class Resources {

  public $name;
  public $author;
  public $author_name;
  public $avatar;
  public $categories;
  public $id;
  public $created;
  public $details;
  public $gallery;
  public $authkey;
  public $level;
  public $link;
  public $excerpt;
  public $readings;
  public $status;
  public $subtitle;
  public $slug;
  public $tags;
  public $template;
  public $type;
  public $updated;
  public $allowed = array( "name", "author", "author_name", "avatar", "categories", "id", "created", "details", "gallery", "level", "link", "excerpt", "readings", "status", "subtitle", "slug", "tags", "template", "type", "updated" );

  private $table = "resources";

  public function create(){
    $cols = array( "name", "author", "author_name", "avatar", "categories", "created", "details", "gallery", "authkey", "level", "link", "excerpt", "readings", "status", "subtitle", "slug", "tags", "updated", "template", "type" );

    $vals = array( $this -> name, $this -> author, $this -> author_name, $this -> avatar, $this -> categories, $this -> created, $this -> details, $this -> gallery, $this -> authkey, $this -> level, $this -> link, $this -> excerpt, $this -> readings, $this -> status, $this -> subtitle, $this -> slug, $this -> tags, $this -> updated, $this -> template, $this -> type );

    if ( $GLOBALS['JBLDB'] -> insert( $this -> table, $cols, $vals ) ) {
      return array( "status" => "Resource created successfully with id ". $GLOBALS['JBLDB'] -> insertId() );
    } else {
      return array( "status" => "Failed", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function update(){
    $cols = array( "name", "author", "author_name", "avatar", "categories", "created", "details", "gallery", "authkey", "level", "link", "excerpt", "readings", "status", "subtitle", "slug", "tags", "updated", "template", "type" );

    $vals = array( $this -> name, $this -> author, $this -> author_name, $this -> avatar, $this -> categories, $this -> created, $this -> details, $this -> gallery, $this -> authkey, $this -> level, $this -> link, $this -> excerpt, $this -> readings, $this -> status, $this -> subtitle, $this -> slug, $this -> tags, $this -> updated, $this -> template, $this -> type );

    $conds = array( "id" => $this -> id );

    if ( $GLOBALS['JBLDB'] -> update( $this -> table, $cols, $vals, $conds ) ) {
      return array( "status" => "Resource ". $this -> id . " updated successfully!" );
    } else {
      return array( "status" => "Failed", "error" => $GLOBALS['JBLDB'] -> error() );
    }
    
  }

  public function getSingle( $code )
  {
    if ( is_numeric( $code ) ) {
      return $this -> getId( $code );
    } else {
      return $this -> getResource( $code );
    }
  }

  public function getId( $id ){
    $vars = get_object_vars( $this );

    $conds = array( "id" => $id );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this->allowed, $conds );

    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $resources = array();
      while ( $resource = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $resources[] = $resource;
        foreach ( $resource as $var => $val ) {
          $this -> $var = $val;
        }
      }

      return $resources[0];
    } else{
      return array( "status" => "fail", "error" => "Resource Not Found" );
    }
    
  }

  public function getResource( $slug ){

    $conds = array( "slug" => $slug );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $resources = array();
      while ( $resource = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $resources[] = $resource;
        foreach ( $resource as $var => $val ) {
          $this -> $var = $val;
        }
      }

      return $resources[0];
    } else{
      return array( "status" => "fail", "error" => "Resource Not Found" );
    }

  }

  public function getAuthor( $author ){

    $conds = array( "author" => $author );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $resources = array();
            while ( $resource = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $resources['status'] = "success";
        $resources[] = $resource;
      }     

      return $resources;
    } else{
      return array( "status" => "fail", "error" => "Resources By Author Not Found" );
    }
  }

  public function getCategories( $category, $type = "article" ){

    $conds = array( "categories" => $category, "type" => $type );
    $results = $GLOBALS['JBLDB'] -> selectLike( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $resources = array();
            while ( $resource = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $resources['status'] = "success";
        $resources[] = $resource;
      }     

      return $resources;
    } else{
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  public function getTags( $tag, $type = "article" ){

    $conds = array( "tags" => $tag, "type" => $type );
    $results = $GLOBALS['JBLDB'] -> selectLike( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $resources = array();
            while ( $resource = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $resources['status'] = "success";
        $resources[] = $resource;
      }     

      return $resources;
    } else{
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  public function getCompany( $company, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $resources = array();
            while ( $resource = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $resources['status'] = "success";
        $resources[] = $resource;
      }     

      return $resources;
    } else{
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  public function getCreated( $date, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $resources = array();
            while ( $resource = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $resources['status'] = "success";
        $resources[] = $resource;
      }     

      return $resources;
    } else{
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  public function getLevel( $level, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $resources = array();
            while ( $resource = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $resources['status'] = "success";
        $resources[] = $resource;
      }     

      return $resources;
    } else{
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  public function getLocation( $location, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $resources = array();
            while ( $resource = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $resources['status'] = "success";
        $resources[] = $resource;
      }     

      return $resources;
    } else{
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  public function getState( $status, $type = "article" ){

    $conds = array( "status" => $status, "type" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $resources = array();
            while ( $resource = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $resources['status'] = "success";
        $resources[] = $resource;
      }     

      return $resources;
    } else{
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  public function getTypes( $type = "article", $limit = 10 ){

    $conds = array( "type" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $resources = array();
            while ( $resource = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $resources['status'] = "success";
        $resources[] = $resource;
      }     

      return $resources;
    } else{
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  public function getUpdated( $date, $type = "article" ){

    $conds = array( "updated" => $date );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $resources = array();
            while ( $resource = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $resources['status'] = "success";
        $resources[] = $resource;
      }     

      return $resources;
    } else{
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  public function delete( $id ){

    $conds = array( "id" => $id );
    if( $GLOBALS['JBLDB'] -> delete( $this -> table, $conds ) ){
      return array("success" => "Resource deleted Successfully");
    } else {
      return array("error" => "Resource deletion Failed", "cause" => $GLOBALS['JBLDB'] -> error());
    }
  }

  public function sweep( $type = "article", $limit = 10 ){

    $conds = array( "status" => "published", "type" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $resources = array();
      while ( $resource = $GLOBALS['JBLDB'] -> fetchAssoc( $results ) ) {
        $resources['status'] = "success";
        $resources[] = $resource;
      }

      return $resources;
    } else{
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }
}