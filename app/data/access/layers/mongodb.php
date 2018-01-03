<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Jabali MongoDB Data Access Layer
* @author Mauko Maunde < hi@mauko.co.ke >
* @link https://docs.jabalicms.org/data/access/layers/mysql/
* @license MIT - https://opensource.org/licenses/MIT
* @since 0.17.09
**/

namespace Jabali\Data\Access\Layers;

class MongoDB
{
	private $host;
	private $user;
	private $name;

	private $conn;

	function __construct( $dbhost, $dbuser, $dbname )
	{
		$client = new \MongoClient();
		$this -> conn = $client -> $dbname;
		if (!$this -> conn) {
		    die("MongoDB connection aborted");
		}

	}

	function __destruct()
	{
		$this -> conn -> close();
	}

	function query( $sql )
	{
		return $this -> conn -> query( $sql );
	}

	function execute( $table )
	{
		return $this -> conn -> createCollection( $table );
	}

	function error()
	{
		return $this -> conn -> error;
	}

	/**
	* @return Returns an associative array of database records from a query result, 
	* or null if there are no rows in the result
	**/
	function fetchAssoc( $result )
	{
		return json_decode( $result, true );
	}

	/**
	* @return Returns each row of database records from a query result as an object, 
	* or null if there are no rows in the result
	**/
	function fetchObject( $result )
	{
		return json_decode( $result );
	}

	/**
	* @return Returns an object of database records from a query result, 
	* or null if there are no rows in the result. All results as an associative array
	**/
	function fetchAll( $result )
	{
		return json_decode( $result, true );
	}

	/**
	* Preparing our data
	**/

	/**
	* @return Returns escaped data to prevent mysqli injection
	**/
	function clean( $data )
	{
		return mysqli_real_escape_string( $this -> conn, $data );
	}



	function setCols( $cols )
	{
		if ( is_array( $cols ) ) {

			array_walk( $cols, array($this, 'clean' ) );

			$sql = implode(", ", $cols);
		} else {
			$sql = $this -> clean( $cols );
		}

		return $sql;
	}

	function setVals( $cols, $vals )
	{
		if ( is_array( $cols ) && is_array( $vals ) ) {
			$sql = array_combine( $cols, $vals );
		} else {
			$sql = array( $cols => $vals );
		}

		return $sql;
	}

	function setCond( $conds )
	{
		$where = array();

		foreach ( $conds as $id => $val ) {
	        $where[] = $id . "='" . $val . "'";
	    }

	    if ( count( $where ) > 0){
	      $sql = " WHERE " . implode( ' AND ', $where );
	    }

		return $sql;
	}

	function setLike( $conds )
	{

		$where = array();

		foreach ( $conds as $id => $val ) {
	        $where[] = $id . " LIKE '%" . $val . "%'";
	    }

	    if ( count( $where ) > 0){
	      $sql = " WHERE " . implode( ' AND ', $where );
	    }

		return $sql;
	}

	/**
	* Creating Data
	**/
	function insert( $table, $cols, $vals, $conds = null )
	{
		$collection = $this -> conn -> _DBPREFIX . $table;
		$sql = $this -> setVals( $cols, $vals );

		if ( !is_null( $conds ) ) {
		 	$sql .= $this -> setCond( $conds );
		}

		return $collection -> insert( $sql ); 
	}

	function insertId()
	{
		return $this -> conn -> insert_id;
	}

	function update( $table, $cols, $vals, $conds = null )
	{
		$collection = $this -> conn -> _DBPREFIX . $table;
		$sql .= $this -> setVals( $cols, $vals );
		return $collection -> update( $conds, ['$set' => $sql] ); 
	}

	/**
	* Creating Data
	**/
	function sweep( $table, $limit = 10 )
	{
		$collection = $this -> conn -> _DBPREFIX . $table;

		return $collection -> find();
	}

	function select( $table, $cols, $conds = null, $order = null, $limit = null, $offset = null )
	{
		$collection = $this -> conn -> _DBPREFIX . $table;

		return $this -> conn -> find($conds, $cols) ->limit( $limit ) -> skip( $offset ) -> sort($order);
	}

	function selectUnique( $table, $cols, $conds = null, $order = null, $limit = null, $offset = null )
	{
		$collection = $this -> conn -> _DBPREFIX . $table;

		return $this -> conn -> findOne($conds, $cols);
	}

	function selectLike( $table, $cols, $like = null, $order = null, $limit = null, $offset = null )
	{
		$collection = $this -> conn -> _DBPREFIX . $table;
		$sql = "SELECT ";
		$sql .= $this -> setCols( $cols );
		$sql .= " FROM ". _DBPREFIX . $table . " ";

		if ( !is_null( $like ) ) {
			$sql .= $this -> setLike( $like );
		}

		if ( !is_null( $order ) ) {
			$sql .= "ORDER BY ";
			if ( is_array( $order ) ) {
				$sql .= $order[0] ." ". $order[1];
			} else {
				$sql .= $order . " ASC";
			}
		}

		if ( !is_null( $offset ) ) {
			$sql .= "OFFSET " . $offset;
		}

		if ( !is_null( $limit ) ) {
			$sql .= "LIMIT " . $limit;
		}

		return $this -> query( $sql );
	}

	function search( $table, $cols, $conds, $val = null )
	{
		$collection = $this -> conn -> _DBPREFIX . $table;
		$sql = "SELECT ";
		$sql .= $this -> setCols( $cols );
		$sql .= " FROM". _DBPREFIX . $table . " ";

		if ( !is_null( $conds ) ) {
			$sql .= $this -> setCond( $conds );
		}

		$sql .= $this -> setLike( $val );

		return $this -> query( $sql ); 
	}

	/**
	* Deleting Data
	**/
	function delete( $table, $conds )
	{
		$collection = $this -> conn -> _DBPREFIX . $table;
		return $collection -> remove( $conds, false );
	}

	/**
	* Query Reports
	**/
	function rowsCount( $table, $cols )
	{
		$collection = $this -> conn -> _DBPREFIX . $table;
		return $collection -> fetch();
	}

	/**
	* Query Reports
	**/
	function numRows( $result )
	{
		return $result -> num_rows;
	}

	function rowExists ( $sql )
	{
		if ( $this -> query( $sql -> num_rows > 0 ) ) {
			return true;
		} else {
			return false;
		}
	}

	function affectedRows()
	{
		return $this -> conn -> affected_rows;
	}

	function reset( $result, $row = 0 )
	{
    	return mysqli_data_seek( $result, $row );
  	}
}