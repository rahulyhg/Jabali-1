<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Comments Data Access Object
* @author Mauko Maunde
* @link https://docs.jabalicms.org/data/access/objects/comments/
* @since 0.17.11
* @license MIT - https://opensource.org/licenses/MIT
**/

namespace Jabali\Data\Access\Objects;

class Comments {

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

  private $table = "messages";

  public function create(){
    $cols = array( "name", "author", "author_name", "avatar", "categories", "created", "details", "gallery", "authkey", "level", "link", "excerpt", "readings", "status", "subtitle", "slug", "tags", "updated", "template", "type" );

    $vals = array( $this -> name, $this -> author, $this -> author_name, $this -> avatar, $this -> categories, $this -> created, $this -> details, $this -> gallery, $this -> authkey, $this -> level, $this -> link, $this -> excerpt, $this -> readings, $this -> status, $this -> subtitle, $this -> slug, $this -> tags, $this -> updated, $this -> template, $this -> type );

    if ( $GLOBALS['JBLDB'] -> insert( $this -> table, $cols, $vals ) ) {
      return array( "status" => "Post created successfully with id ". $GLOBALS['JBLDB'] -> insertId() );
    } else {
      return array( "status" => "Failed", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function update(){
    $cols = array( "name", "author", "author_name", "avatar", "categories", "created", "details", "gallery", "authkey", "level", "link", "excerpt", "readings", "status", "subtitle", "slug", "tags", "updated", "template", "type" );

    $vals = array( $this -> name, $this -> author, $this -> author_name, $this -> avatar, $this -> categories, $this -> created, $this -> details, $this -> gallery, $this -> authkey, $this -> level, $this -> link, $this -> excerpt, $this -> readings, $this -> status, $this -> subtitle, $this -> slug, $this -> tags, $this -> updated, $this -> template, $this -> type );

    $conds = array( "id" => $this -> id );

    if ( $GLOBALS['JBLDB'] -> update( $this -> table, $cols, $vals, $conds ) ) {
      return array( "status" => "Post ". $this -> id . " updated successfully!" );
    } else {
      return array( "status" => "Failed", "error" => $GLOBALS['JBLDB'] -> error() );
    }
    
  }

  public function getId( $id ){
    $vars = get_object_vars( $this );

    $conds = array( "id" => $id );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this->allowed, $conds );

    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $posts[] = $post;
        foreach ( $post as $var => $val ) {
          $this -> $var = $val;
        }
      }

      return $posts[0];
    } else{
      return array( "status" => "Request Failed", "error" => "Post Not Found" );
    }
    
  }

  public function getPost( $slug ){

    $conds = array( "slug" => $slug );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $posts[] = $post;
        foreach ( $post as $var => $val ) {
          $this -> $var = $val;
        }
      }

      return $posts[0];
    } else{
      return array( "status" => "Request Failed", "error" => "Post Not Found" );
    }

  }

  public function getAuthor( $author ){

    $conds = array( "author" => $author );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
            while ( $post = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $posts[] = $post;
        $posts['status'] = "success";
      }     

      return $posts;
    } else{
      return array( "status" => "Request Failed", "error" => "Posts Not Found" );
    }
  }

  public function getCategories( $category, $type = "article" ){

    $conds = array( "template" => $skin, "type" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
            while ( $post = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $posts[] = $post;
        $posts['status'] = "success";
      }     

      return $posts;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCompany( $company, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
            while ( $post = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $posts[] = $post;
        $posts['status'] = "success";
      }     

      return $posts;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCreated( $date, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
            while ( $post = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $posts[] = $post;
        $posts['status'] = "success";
      }     

      return $posts;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getLevel( $level, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
            while ( $post = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $posts[] = $post;
        $posts['status'] = "success";
      }     

      return $posts;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getLocation( $location, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
            while ( $post = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $posts[] = $post;
        $posts['status'] = "success";
      }     

      return $posts;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getState( $status, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
            while ( $post = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $posts[] = $post;
        $posts['status'] = "success";
      }     

      return $posts;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getTypes( $type = "article", $limit = 10 ){

    $conds = array( "type" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
            while ( $post = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $posts[] = $post;
        $posts['status'] = "success";
      }     

      return $posts;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getUpdated( $date, $type = "article" ){

    $conds = array( "updated" => $date );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
            while ( $post = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $posts[] = $post;
        $posts['status'] = "success";
      }     

      return $posts;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function delete( $id ){

    $conds = array( "id" => $id );
    if( $GLOBALS['JBLDB'] -> delete( $this -> table, $conds ) ){
      return array("success" => "Post deleted Successfully");
    } else {
      return array("error" => "Post deletion Failed", "cause" => $GLOBALS['JBLDB'] -> error());
    }
  }

  public function sweep( $type = "article", $limit = 10 ){

    $conds = array( "status" => "published", "type" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchAssoc( $results ) ) {
        $posts[] = $post;
      }

      return $posts;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function sweepy( $type = "article"){

    $conds = array( "status" => "published", "type" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    return new ResultSet( $posts );
  }
}