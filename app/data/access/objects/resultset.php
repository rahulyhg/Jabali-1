<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Options Data Access Object
* @author Mauko Maunde
* @link https://docs.jabalicms.org/data/access/obects/options
* @since 0.17.09
* @license MIT - https://opensource.org/licenses/MIT
**/

namespace Jabali\Data\Access\Objects;
/**
* @link https://www.onlamp.com/pub/a/php/2004/08/05/dataobjects.html?page=1
**/

class ResultSet {
	// This member variable will hold the native result set
  private $result;

	// Assign the native result set to an instance variable
  function __construct( $result ){
    $this -> result = $result;
  }

	// Receives an instance of the DataObject we're working on
  function getNext( $dao ){
    $posts = $GLOBALS['JBLDB'] -> fetchAssoc( $this -> result );

      foreach ( $posts as $var => $val ) {
        $dao -> $var = $posts[$var];
      }
    
    return $dao;
  }

  // Move the pointer back to the beginning of the result set
  function reset(){
    return $GLOBALS['JBLDB'] -> reset( $this -> result );
  }

  // Return the number of rows in the result set
  function rowCount(){
    return $GLOBALS['JBLDB'] -> numRows( $this -> result );
  }
}