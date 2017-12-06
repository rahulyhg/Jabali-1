<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Users Data Access Object
* @author Mauko Maunde < hi@mauko.co.ke >
* @link https://docs.jabalicms.org/data/access/obects/users
* @since 0.17.09
* @license MIT - https://opensource.org/licenses/MIT
**/ 

namespace Jabali\Data\Access\Objects;

class Users 
{
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
  public $allowed = array( 
    "id", 
    "author", 
    "avatar", 
    "categories", 
    "company", 
    "created", 
    "custom", 
    "details", 
    "email",
    "excerpt",
    "gender", 
    "level", 
    "link", 
    "location", 
    "name", 
    "phone", 
    "social", 
    "status", 
    "style", 
    "tags", 
    "type", 
    "updated", 
    "username",
    "password" 
    );

  public $authkey;
  public $password;
  private $table = "users";

  /**
  * Create new user
  */
  public function create()
  {
    $cols = array( 
      "authkey", 
      "author", 
      "author_name", 
      "avatar", 
      "categories", 
      "company", 
      "created", 
      "custom", 
      "details", 
      "email",
      "excerpt", 
      "gender", 
      "level", 
      "link", 
      "location", 
      "name", 
      "phone", 
      "social", 
      "status", 
      "style", 
      "tags", 
      "type", 
      "updated", 
      "username", 
      "password" 
    );

    $vals = array( 
      $this -> authkey, 
      $this -> author, 
      $this -> author_name, 
      $this -> avatar, 
      $this -> categories, 
      $this -> company, 
      $this -> created, 
      $this -> custom, 
      $this -> details, 
      $this -> email, 
      $this -> excerpt, 
      $this -> gender, 
      $this -> level, 
      $this -> link, 
      $this -> location, 
      $this -> name, 
      $this -> phone, 
      $this -> social, 
      $this -> status, 
      $this -> style, 
      $this -> tags, 
      $this -> type, 
      $this -> updated, 
      $this -> username, 
      $this -> password 
    );

    if ( $GLOBALS['JBLDB'] -> insert( $this -> table, $cols, $vals ) ) {
      return array( 
        "status" => "success",
        "message" => "User created successfully with id ". $GLOBALS['JBLDB'] -> insertId() 
      );
    } else {
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  /**
  * Update user
  */
  public function update()
  {
    $cols = array( 
      "authkey", 
      "author", 
      "author_name", 
      "avatar", 
      "categories", 
      "company", 
      "created", 
      "custom", 
      "details", 
      "email",
      "excerpt", 
      "gender", 
      "level", 
      "link", 
      "location", 
      "name", 
      "phone", 
      "social", 
      "status", 
      "style", 
      "tags", 
      "type", 
      "updated", 
      "username", 
      "password" 
    );

    $vals = array( 
      $this -> authkey, 
      $this -> author, 
      $this -> author_name, 
      $this -> avatar, 
      $this -> categories, 
      $this -> company, 
      $this -> created, 
      $this -> custom, 
      $this -> details, 
      $this -> email, 
      $this -> excerpt, 
      $this -> gender, 
      $this -> level, 
      $this -> link, 
      $this -> location, 
      $this -> name, 
      $this -> phone, 
      $this -> social, 
      $this -> status, 
      $this -> style, 
      $this -> tags, 
      $this -> type, 
      $this -> updated, 
      $this -> username, 
      $this -> password 
    );

    $conds = array( 
      "id" => $this -> id 
    );

    if ( $GLOBALS['JBLDB'] -> update( $this -> table, $cols, $vals, $conds ) ) {
      return array( 
        "status" => "success", 
        "message" => "User of id ". $this -> id ." updated successfully" 
      );
    } else {
      return array(  
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }


  /**
  * Get single user
  * @param int/string $user User identifier (id, email or username)
  */
  public function getSingle( $user )
  {
    if ( is_numeric( $user ) ) {
      return $this -> getId( $user );
    } elseif ( isEmail( $user ) ) {
      return $this -> getEmail( $user );
    } else {
      return $this -> getUser( $user );
    }
  }

  /**
  * Get single user by id
  * @param int $id User id
  */
  public function getId( $id ){
    $vars = get_object_vars( $this );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, [ "id" => $id ] );

    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users[] = $user;
        foreach ( $user as $var => $val ) {
          $this -> $var = $val;
        }
      }
      
      $GLOBALS['grecord'] = $users[0];
      return $users[0];
    } else {
      return array( 
        "status" => "fail", 
        "error" => "Post Not Found" 
      );
    }   
  }

  /**
  * Get single user by id
  * @param int $id User id
  */
  public function getsId( $id ){
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, "*", [ "id" => $id ] );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
        foreach ( $user as $var => $val ) {
          $this -> $var = $val;
        }
      }

      $GLOBALS['grecord'] = $users[0];
      return $users[0];
    } else {
      return array( 
        "status" => "fail", 
        "error" => "User Not Found"
      );
    }
  }

  /**
  * Get single user by email
  * @param string $email User email address
  */
  public function getEmail( $email ){
    $vars = get_object_vars( $this );

    $conds = array( "email" => $email );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );

    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users[] = $user;
        foreach ( $user as $var => $val ) {
          $this -> $var = $val;
        }
      }
      
      $GLOBALS['grecord'] = $users[0];
      return $users[0];
    } else {
      return array( 
        "status" => "fail", 
        "error" => "Post Not Found" 
      );
    }   
  }

  /**
  * Get single user by username
  * @param string $username User username
  */
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

      $GLOBALS['grecord'] = $users[0];
      return $users[0];
    } else {
      return array( 
        "status" => "fail", 
        "message" => $GLOBALS['JBLDB'] -> error()
      );
    }
  }

  /**
  * Get all users created by author
  * @param int $author id of user
  */
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
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  /**
  * Get all users in category
  * @param string $category Category ro search
  */
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
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  /**
  * List all categories in users table or posts in category
  * @param string $category Category to search
  */
  public function listCategory( $category = null) 
  {
    $categories = array();

    if ( !is_null( $category ) ) {
      $cats = $GLOBALS['JBLDB'] -> selectUnique( $this -> table, ['id', 'categories', 'type'], ['categories' => $category ]);
    } else {
      $cats = $GLOBALS['JBLDB'] -> selectUnique( $this -> table, ['id', 'categories']);
    }

    if ( $cats && $GLOBALS['JBLDB'] -> numRows( $cats ) > 0 ) {
       while ( $cat = $GLOBALS['JBLDB'] -> fetchAssoc( $cats ) ) {
        if ( strpos($cat, ',')) {
          $cats = explode(', ', $cat);
          foreach ($cats as $cat ) {
            $categories[] = $cat;
          }
        } else {
         $categories[] = $cat;
        } 
       }

       return array(
        'status' => 'success',
        'count' => count( $categories ),
        'categories' => $categories
       );
     } else {
      return array(
        'status' => 'fail',
        'count' => 0
       );
     }
  }

  /**
  * Get all users from a given organization
  * @param string $company Organization to search
  */
  public function getCompany( $company )
  {
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
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  /**
  * Get all users created on a given date
  * @param string $date Date to search
  * Format yyyy or yyy-mm or yyyy-mm-dd or yyyy-mm-dd hh:ii:ss or 
  * Format yyyy or yyy/mm or yyyy/mm/dd or yyyy/mm/dd hh:ii:ss
  */
  public function getCreated( $date )
  {
    $conds = array( "created" => $date );
    $results = $GLOBALS['JBLDB'] -> selectLike( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  /**
  * Get all users of a given gender
  * @param string $gender User gender to search 
  */
  public function getGender( $gender )
  {
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
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  /**
  * Get all users of a given level
  * @param string $level User level to search 
  */
  public function getLevel( $level )
  {
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
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  /**
  * Get all users of a given country/region/city
  * @param string $location Location to search 
  */
  public function getLocation( $location )
  {
    $conds = array( "location" => $location );
    $results = $GLOBALS['JBLDB'] -> selectLike( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  /**
  * Get all users of a given status active | pending
  * @param string $location User location to search 
  */
  public function getStatus( $status )
  {
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
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  /**
  * Get the skin theme active for a given user
  * @param int $id User ID to search 
  */
  public function getStyle( $id )
  {
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
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error()
      );
    }
  }

  /**
  * Get all users of a given type
  * @param string $type User $type to search 
  */
  public function getTypes( $type )
  {
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
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  /**
  * Get all users updated on a given date
  * @param string $date Date to search
  * Format yyyy or yyy-mm or yyyy-mm-dd or yyyy-mm-dd hh:ii:ss or 
  * Format yyyy or yyy/mm or yyyy/mm/dd or yyyy/mm/dd hh:ii:ss
  */
  public function getUpdated( $date )
  {
    $conds = array( "updated" => $date );
    $results = $GLOBALS['JBLDB'] -> selectLike( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results )) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( 
        "status" => "fail", 
        "error" => $GLOBALS['JBLDB'] -> error() 
      );
    }
  }

  /**
  * Delete a given user
  * @param int $id User ID to delete
  **/
  public function delete( $id )
  {
    $conds = array( "id" => $id );
    if( $GLOBALS['JBLDB'] -> delete( $this -> table, $conds ) ){
      return array(
        "status" => "success",
        "message" => "User deleted Successfully"
      );
    } else {
      return array(
        "status" => "fail",
        "error" => "User deletion Failed"
      );
    }
  }

  /**
  * Sweep user table for all users
  **/
  public function sweep()
  {
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, ["status" => "active"] );
    if ( $results && $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchAssoc( $results ) ) {
        $users['status'] = "success";
        $users[] = $user;
      }

      return $users;
    } else{
      return array( 
        "status" => "fail", 
        "error" => "This app has no users yet." 
      );
    }
  }

  /**
  * Login user
  * @param string $redirect Url to redirect to after login, relative to the home url
  **/
  public function login( $redirect = "admin/index?page=my dashboard" )
  {

    $user = $GLOBALS['JBLDB'] -> clean( stripslashes( $_POST['user'] ) );
    $password = $GLOBALS['JBLDB'] -> clean( stripslashes( $_POST['password'] ) );
    $password = md5( $password );

    $userDetails = $this -> getSingle( $user );

    if ( !isset( $userDetails['error']) ) {
      if ( $this -> password == $password ) {
        $_SESSION[JBLSALT.'Alias'] = $this -> name;
        $_SESSION[JBLSALT.'Username'] = $this -> username;
        $_SESSION[JBLSALT.'Code'] = $this -> id;
        $_SESSION[JBLSALT.'Email'] = $this -> email;
        $_SESSION[JBLSALT.'Phone'] = $this -> phone;
        $_SESSION[JBLSALT.'Org'] = $this -> company;
        $_SESSION[JBLSALT.'Cap'] = $this -> type;
        $_SESSION[JBLSALT.'Location'] = $this -> location;
        $_SESSION[JBLSALT.'Avatar'] = $this -> avatar;
        $_SESSION[JBLSALT.'Gender'] = $this -> gender;

        header( 'Location: '._ROOT.'/'.$redirect );
        exit();
      } else {
        header('Location: '._ROOT.'/login/?alert=password' );
        exit();
      }
    } else {
      header('Location: '._ROOT.'/login/?alert=user' );
      exit();
    }
  }

  /**
  * Register new user/organization
  * @param string $redirect Url to redirect to after login, relative to the home url
  **/
  public function register()
  {
    
    if ( emailExists( $_POST['email'] ) )
    {
      header( "Location: "._ROOT."/register/?create=exists" );
    } else {

      $this -> hash = str_shuffle(md5( $email.$date ) );
      $this -> abbr = substr( $_POST['lname'], 0,3 );

      $this -> name = $_POST['fname'].' '.$_POST['lname'];
      $this -> author = substr( $hash, 20 );
      $this -> created = date( "Y-m-d H:i:s" );
      $this -> avatar = _IMAGES.'avatar.png';
      $this -> company = $_POST['company'];
      $this -> email = $_POST['email'];
      $this -> details = "";
      $this -> created = date('Ymd' );
      $this -> email  = $_POST['email'];
      $this -> gender = strtolower( $_POST['gender'] );
      $this -> authkey = $hash;
      $this -> level = $_POST['level'];
      $this -> link = _ROOT."/users/";
      $this -> location = strtolower( $_POST['location'] );
      $this -> excerpt = "Account created on ".$date;
      $this -> password = md5( $_POST['password'] );
      $this -> phone = $_POST['phone'];

      if ( !$_POST['status'] ) {
        $this -> status = "pending";
      } else {
        $this -> status = $_POST['status'];
      }
      $this -> social = '{"facebook":"https://www.facebook.com/","twitter":"https://twitter.com/","instagram":"https://instagram.com/","github":"https://github.com/"}';
      $this -> style = "zahra";
      $this -> type = strtolower( $_POST['type'] );
      $this -> username = strtolower( $_POST['fname'].$abbr );

      if ( $this -> create() ) {
        header( "Location: "._ROOT."/register/?create=sucess" );
      }
    }
  }

  /**
  * Reset user password and Authentication Key
  * @param int $id User ID for whom to reset
  * @param string $key User key to authenticate request
  **/
  public function reset( $id, $key )
  {
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