<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Jabali PostgreSQL Data Access Layer
* @author Mauko Maunde < hi@mauko.co.ke >
* @link https://docs.jabalicms.org/data/access/layers/postgre/
* @license MIT - https://opensource.org/licenses/MIT
* @since 0.17.09
**/
 
namespace Jabali\Data\Access\Layers;

class PostgreDB {

	private $host;
	private $user;
	private $pass;
	private $name;

	private $conn;

	public function __construct( $dbhost, $dbuser, $dbpass, $dbname, $dbport ){
		   $host = "host = ".$dbhost;
		   $port = "port = ".$dbport;
		   $dbname = "dbname = ".$dbname;
		   $user = "user = ".$dbuser;
		   $password = "password = ".$dbpass;

		   $this -> conn = pg_connect( $host $port $dbname $user $password );
		   if( !$this -> conn ) {
		      echo "Error : Unable to open database\n";
		   }
	}

	public function __destruct()
	{
		$this -> conn -> close();
	}

	public function query( $sql )
	{
		return pg_query( $sql );
	}

	public function execute( $sql )
	{
		return pg_query( $sql );
	}

	public function error()
	{
		return pg_last_error();
	}

	/**
	* @return Returns an associative array of database records from a query result, 
	* or null if there are no rows in the result
	**/
	public function fetchAssoc( $result )
	{
		return pg_fetch_array( $result, NULL, PGSQL_ASSOC );
	}

	/**
	* @return Returns an object of database records from a query result, 
	* or null if there are no rows in the result
	**/
	public function fetchObject( $result )
	{
		return (object)pg_fetch_array( $result, NULL, PGSQL_ASSOC );
	}


	function fetchAll( $result )
	{
		return $result -> pg_fetch_all(SQLITE_ASSOC);;
	}

	/**
	* Preparing our data
	**/

	/**
	* @return Returns escaped data to prevent mysqli injection
	**/
	public function clean( $data )
	{
		return mysqli_real_escape_string( $this -> conn, $data );
	}



	public function setCols( $cols )
	{
		if ( is_array( $cols ) ) {

			array_walk( $cols, array($this, 'clean' ) );

			$sql = implode(", ", $cols);
		} else {
			$sql = $this -> clean( $cols );
		}

		return $sql;
	}

	public function setVals( $vals )
	{
		$sql = " VALUES ( ";
		if ( is_array( $vals ) ) {

			array_walk( $vals, array( $this, 'clean' ) );
			
			foreach ( $vals as $val ) {
				$values[] = "'" . $val . "'";
			}

			if ( count( $values ) > 0 ) {
				$sql .= implode(", ", $values );
			}

		} else {
			$sql .= "'" .$this -> clean( $vals ) . "'";
		}

		$sql .= " ) ";

		return $sql;
	}

	public function setVal( $cols, $vals )
	{
		$sql = "SET ";
		if ( is_array( $cols ) && is_array( $vals ) ) {
			array_walk( $cols, array( $this, 'clean' ) );
			array_walk( $vals, array( $this, 'clean' ) );
			$colvals = array_combine( $cols, $vals );
			foreach ( $colvals as $col => $val ) {
				$values[] = $col." = '" . $val . "'";
			}

			if ( count( $values ) > 0 ) {
				$sql .= implode(", ", $values );
			}

		} else {
			$sql .= $this -> clean( $cols ) . " = '" . $this -> clean( $vals ) . "'";
		}

		return $sql;
	}

	public function setCond( $conds )
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

	public function setLike( $conds )
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
	public function insert( $table, $cols, $vals, $conds = null )
	{
		$sql = "INSERT INTO " . _DBPREFIX.$table . " ( ";
		$sql .= $this -> setCols( $cols );
		$sql .= " )";
		$sql .= $this -> setVals( $vals );

		if ( !is_null( $conds ) ) {
		 	$sql .= $this -> setCond( $conds );
		}

		return $this -> query( $sql ); 
	}

	public function insertId()
	{
		return $this -> conn -> insert_id;
	}

	public function update( $table, $cols, $vals, $conds = null )
	{
		$sql = "UPDATE " . _DBPREFIX . $table . " ";
		$sql .= $this -> setVal( $cols, $vals );

		if ( !is_null( $conds ) ) {
		 	$sql .= $this -> setCond( $conds );
		}

		return $this -> query( $sql ); 
	}

	/**
	* Creating Data
	**/
	public function sweep( $table )
	{
		$sql = "SELECT * FROM " . _DBPREFIX . $table;

		return $this -> query( $sql ); 
	}

	public function select( $table, $cols, $conds = null, $order = null, $limit = null, $offset = null )
	{
		$sql = "SELECT ";
		$sql .= $this -> setCols( $cols );
		$sql .= " FROM ". _DBPREFIX . $table . " ";

		if ( !is_null( $conds ) ) {
			$sql .= $this -> setCond( $conds );
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

	function selectUnique( $table, $cols, $conds = null, $order = null, $limit = null, $offset = null )
	{
		$sql = "SELECT DISTINCT ";
		$sql .= $this -> setCols( $cols );
		$sql .= " FROM ". _DBPREFIX . $table . " ";

		if ( !is_null( $conds ) ) {
			$sql .= $this -> setLike( $conds );
		}

		if ( !is_null( $order ) ) {
			$sql .= "ORDER BY ";
			if ( is_array( $order ) ) {
				$sql .= $order[0] ." ". $order[1];
			} else {
				$sql .= $order . " DESC ";
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

	public function selectLike( $table, $cols, $like = null, $order = null, $limit = null, $offset = null )
	{
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

	public function search( $table, $cols, $conds, $val = null )
	{
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
	public function delete( $table, $conds )
	{
		$sql = "DELETE FROM " . _DBPREFIX . $table . " ";
		
		if ( !is_null( $conds ) ) {
		 	$sql .= $this -> setCond( $conds );
		}

		return $this -> query( $sql );
	}

	/**
	* Query Reports
	**/
	public function rowsCount( $table, $cols )
	{
		$sql = "SELECT ";
		$sql .= $this -> setCols( $cols );
		$sql .= "FROM " . _DBPREFIX . $table . " ";

		$result = $this -> query( $sql );

		return $result -> num_rows;
	}

	/**
	* Query Reports
	**/
	public function numRows( $result )
	{
		return $result -> num_rows;
	}

	public function rowExists ( $sql )
	{
		if ( $this -> query( $sql -> num_rows > 0 ) ) {
			return true;
		} else {
			return false;
		}
	}

	public function affectedRows()
	{
		return $this -> conn -> affected_rows;
	}

	public function reset( $result, $row = 0 )
	{
    	return mysqli_data_seek( $result, $row );
  	}
}