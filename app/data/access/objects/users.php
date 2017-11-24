<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Users Data Access Object
* @author Mauko Maunde
* @link https://docs.jabalicms.org/data/access/obects/users
* @since 0.17.09
* @license MIT - https://opensource.org/licenses/MIT
**/ 

namespace Jabali\Data\Access\Objects;

class Users {

  public $id;
  public $author;
  public $author_name;
  public $avatar;
  public $categories;
  public $company;
  public $created;
  public $custom;
  public $details;
  public $email;
  public $excerpt;
  public $gender;
  public $level;
  public $link;
  public $location;
  public $name;
  public $phone;
  public $social;
  public $status;
  public $style;
  public $type;
  public $updated;
  public $username;
  public $allowed = array( "id", "author", "avatar", "categories", "company", "created", "custom", "details", "email","excerpt", "gender", "level", "link", "location", "name", "phone", "social", "status", "style", "tags", "type", "updated", "username" );

  public $authkey;
  public $password;
  private $table = "users";

  public function create(){
    $cols = array( "authkey", "author", "author_name", "avatar", "categories", "company", "created", "custom", "details", "email","excerpt", "gender", "level", "link", "location", "name", "phone", "social", "status", "style", "tags", "type", "updated", "username", "password" );

    $vals = array( $this -> authkey, $this -> author, $this -> author_name, $this -> avatar, $this -> categories, $this -> company, $this -> created, $this -> custom, $this -> details, $this -> email, $this -> excerpt, $this -> gender, $this -> level, $this -> link, $this -> location, $this -> name, $this -> phone, $this -> social, $this -> status, $this -> style, $this -> tags, $this -> type, $this -> updated, $this -> username, $this -> password );

    if ( $GLOBALS['JBLDB'] -> insert( $this -> table, $cols, $vals ) ) {
      return array( "success" => "User created successfully with id ". $GLOBALS['JBLDB'] -> insertId() );
    } else {
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function update(){
    $cols = array( "authkey", "author", "author_name", "avatar", "categories", "company", "created", "custom", "details", "email","excerpt", "gender", "level", "link", "location", "name", "phone", "social", "status", "style", "tags", "type", "updated", "username", "password" );

    $vals = array( $this -> authkey, $this -> author, $this -> author_name, $this -> avatar, $this -> categories, $this -> company, $this -> created, $this -> custom, $this -> details, $this -> email, $this -> excerpt, $this -> gender, $this -> level, $this -> link, $this -> location, $this -> name, $this -> phone, $this -> social, $this -> status, $this -> style, $this -> tags, $this -> type, $this -> updated, $this -> username, $this -> password );

    $conds = array( "id" => $this -> id );

    if ( $GLOBALS['JBLDB'] -> update( $this -> table, $cols, $vals, $conds ) ) {
      return array( "status" => "User of id ". $this -> id ." updated successfully" );
    } else {
      return array(  "status" => "Failed", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getSingle( $code )
  {
    if ( is_numeric( $code ) ) {
      return $this -> getId( $code );
    } else {
      return $this -> getUser( $code );
    }
  }

  public function getId( $id ){
    $vars = get_object_vars( $this );

    $conds = array( "id" => $id );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );

    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $posts[] = $post;
        foreach ( $post as $var => $val ) {
          $this -> $var = $val;
        }
      }
      
      $GLOBALS['grecord'] = $posts[0];
      return $posts[0];
    } else {
      return array( "status" => "fail", "error" => "Post Not Found" );
    }
    
  }

  public function getsId( $id ){
    $conds = array( "id" => $id );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, "*", $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
        foreach ( $user as $var => $val ) {
          $this -> $var = $val;
        }
      }

      $GLOBALS['grecord'] = $posts[0];
      return $users[0];
    } else {
      return array( "status" => "fail", "error" => "User Not Found" );
    }
  }

  public function getUser( $username ){
    $conds = array( "username" => $username );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
        foreach ( $user as $var => $val ) {
          $this -> $var = $val;
        }
      }

      $GLOBALS['grecord'] = $posts[0];
      return $users[0];
    } else{
      return array( "status" => "fail", "message" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getAuthor( $author ){
    $conds = array( "author" => $author );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCategories( $category ){
    $conds = array( "status" => "active" );
    $results = $GLOBALS['JBLDB'] -> search( $this -> table, $this -> allowed, $conds, $category );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCompany( $company ){
    $conds = array( "company" => $company );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCreated( $date ){
    $conds = array( "created" => $date );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getGender( $gender ){
    $conds = array( "gender" => $gender );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getLevel( $level ){
    $conds = array( "level" => $level );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCity( $location ){
    $conds = array( "city" => $location );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getRegion( $location ){
    $conds = array( "region" => $location );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCountry( $location ){
    $conds = array( "country" => $location );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getState( $status ){
    $conds = array( "status" => $status );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getStyle( $id ){
    $conds = array( "id" => $id );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, 'style', $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users[0];
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getTypes( $type ){
    $conds = array( "type" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getUpdated( $date ){
    $conds = array( "updated" => $date );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function delete( $id ){
    $conds = array( "id" => $id );
    if( $GLOBALS['JBLDB'] -> delete( $this -> table, $conds ) ){
      return array("success" => "User deleted Successfully");
    } else {
      return array("error" => "User deletion Failed", "cause" => $GLOBALS['JBLDB'] -> error());
    }
  }

  public function sweep(){
    $conds = array( "status" => "active" );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
    
  }

  public function sweepy(){
    $conds = array( "status" => "active" );
    $users = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    return new ResultSet( $users );
  }

  function login() {
    $user=$_POST['user'];
    $password=$_POST['password'];

    $user = stripslashes( $user );
    $password = stripslashes( $password );
    $user = $GLOBALS['JBLDB'] -> clean( $user );
    $password = $GLOBALS['JBLDB'] -> clean( $password );
    $password = md5($password);

    if ( isEmail( $user ) ) {
      $result = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE email  = '".$user."'" );
    } else {
      $result = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE username = '".$user."'" );
    }

    if ( $result -> num_rows > 0 ) {
      while ( $userDetails = mysqli_fetch_assoc( $result ) ) {
        if ( $userDetails['password'] == $password ) {
          $_SESSION[JBLSALT.'Alias'] = $userDetails['name'];
          $_SESSION[JBLSALT.'Username'] = $userDetails['username'];
          $_SESSION[JBLSALT.'Code'] = $userDetails['id'];
          $_SESSION[JBLSALT.'Email'] = $userDetails['email'];
          $_SESSION[JBLSALT.'Phone'] = $userDetails['phone'];
          $_SESSION[JBLSALT.'Org'] = $userDetails['company'];
          $_SESSION[JBLSALT.'Cap'] = $userDetails['type'];
          $_SESSION[JBLSALT.'Location'] = $userDetails['location'];
          $_SESSION[JBLSALT.'Avatar'] = $userDetails['avatar'];
          $_SESSION[JBLSALT.'Gender'] = $userDetails['gender'];

          header( 'Location: '._ROOT.'/admin/index?page=my dashboard' );
          exit();
        } else {
          header('Location: '._ROOT.'/login/?alert=password' );
          exit();
        }
      }
    } else {
      header('Location: '._ROOT.'/login/?alert=user' );
      exit();
    }
  }

  function register() {
    
    if ( emailExists( $_POST['email'] ) )
    {
      header( "Location: ./register?create=exists" );
    } else 
    {
        $date = date( "YmdHms" );
        $email = $_POST['email'];

        $hash = str_shuffle(md5( $email.$date ) );
        $abbr = substr( $_POST['lname'], 0,3 );

        $name = $_POST['fname'].' '.$_POST['lname'];
        $author = substr( $hash, 20 );
        
        $avatar = _IMAGES.'avatar.png';
        $company = mysqli_real_escape_string( $conn, $_POST['company'] );
        $id = md5(date('l jS \of F Y h:i:s A').rand(10,1000) );
        $details = "";
        $created = date('Ymd' );
        $email  = mysqli_real_escape_string( $conn, $_POST['email'] );
        $gender = strtolower( $_POST['gender'] );
        $authkey = $hash;
        $level = mysqli_real_escape_string( $conn, $_POST['level'] );
        $link = _ROOT."users?view=$id&key=$name";
        $location = strtolower( $_POST['location'] );
        $excerpt = "Account created on ".$date;
        $password = md5( $_POST['password'] );
        $phone = mysqli_real_escape_string( $conn, $_POST['phone'] );

        if ( !$_POST['status'] ) {
          $status = "pending";
        } else {
          $status = $_POST['status'];
        }
        $social = '{"facebook":"https://www.facebook.com/","twitter":"https://twitter.com/","instagram":"https://instagram.com/","github":"https://github.com/"}';
        $style = "zahra";
        $type = strtolower( $_POST['type'] );
        $username = strtolower( $_POST['fname'].$abbr );

      if ( $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."users (name, author, avatar, company, id, created, details, email , gender, authkey, level, link, location, excerpt, password, phone, social, status, style, type, username) VALUES ('".$name."', '".$author."', '".$avatar."', '".$company."', '".$id."', '".$created."', '".$details."', '".$email ."', '".$gender."', '".$authkey."', '".$level."', '".$link."', '".$location."', '".$excerpt."', '".$password."', '".$phone."', '".$social."', '".$status."', '".$style."', '".$type."', '".$username."' )" ) ) {
      header( "Location: ./register?create=success" );
      } else {
      //header( "Location: ./register?create=fail" );
      echo "Error: " . $conn -> error;
      }
    }
  }

  function reset( $id, $key ) {
    if ( $GLOBALS['JBLDB'] -> query( "UPDATE ". _DBPREFIX ."users SET password = '".md5( $_POST['password'] )."', authkey = '".md5(date('YmdHms' ))."' WHERE id = '".$_POST['id']."'" ) ) {
      if ( $hUser -> emailUser( $user[0]['email'], "reset", $user[0]['authkey'] ) ) {
        header( "Location: ./forgot?error=null" );
      } else {
        header( "Location: ./forgot?error=email" );
      }
    } else {
      header( "Location: ./reset?error=update" );
    }
  }
}