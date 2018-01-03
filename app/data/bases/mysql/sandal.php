<?php
namespace Data\Bases\MySQL;

/**
 * @package SANDALs - Simple And Nifty Data Abstraction Layers
 * @subpackage MySQLI Data Access Layer
 * @version 18.01
 * @author Mauko < hi@mauko.co.ke >
 * @link https://phpsandals.co.ke/dals/mysqli
 */
class SANDAL
{
	// Database tables prefix, if any
	private $prefix;

	// Temporary database connection object
	private $tconn;

	// Database connection object
	private $conn;

	// Database table name
	private $table;

	// Array of database table collumn names
	public $collumns;

	// Array of blacklisted database collumns
	public $blacklist;

	/**
	 * Constuctor method sets basic server connection parameters, as well as database table name prefixes
	 * As an added bonus, we can create a database if it does not exist.
	 */
	public function __construct( $table, $blacklist = null )
	{
		if ( !defined( 'appconfig' ) ){
			die( 'Please define appconfig( Server Variables )');
		}

		$this -> prefix = appconfig['dbprefix'] ?? '';

		$dbname = appconfig['dbname'];
		$dbuser = appconfig['dbuser'] ?? 'root'; 
		$dbpassword = appconfig['dbpassword'] ?? '';
		$dbhost = appconfig['dbhost'] ?? 'localhost';
		$dbport = appconfig['dbport'] ?? $_SERVER['SERVER_PORT'];

		$this -> tconn =  new \mysqli( $dbhost, $dbuser, $dbpassword );
		$this -> tconn -> query( 'CREATE DATABASE IF NOT EXISTS '. appconfig['dbname'] );

		$this -> conn = new \mysqli( $dbhost, $dbuser, $dbpassword, $dbname );

		if ( $this -> conn -> connect_errno ){
		    die( "Connection failed: \n".$this -> conn -> connect_error );
		}

		$table = $this -> prefix.$table;

		$collumns = [];
		$query = $this -> query(
			"SELECT COLUMN_NAME
			FROM information_schema.COLUMNS
			WHERE TABLE_SCHEMA = DATABASE()
			AND TABLE_NAME = '".$table."'
			ORDER BY ORDINAL_POSITION"
		);

		while( $collumn = mysqli_fetch_assoc( $query ) ){
			$collumns[] =  $collumn['COLUMN_NAME'];
		}

		$this -> table = $table;
		$this -> collumns = $collumns;
		$this -> blacklist = is_null( $blacklist ) ? $collumns : $blacklist;
	}

	/**
	 * Destructor method - Closes database connection when there are no more instances of this class
	 * @return bool
	 */
	function __destruct()
	{
		$this -> conn -> close();
	}

	/**
	 * Method for running generic queries
	 * @param string $sql SQL query to execute
	 * @return bool/mixed
	 */
	public function query( $sql )
	{
		return $this -> conn -> query( $sql );
	}

	/**
	 * Method for running resultless generic queries
	 * @param string $sql SQL query to execute
	 * @return bool/mixed
	 */
	public function execute( $sql )
	{
		return $this -> conn -> query( $sql );
	}

	/**
	 * Method to return last error
	 * @return string
	 */
	public function error()
	{
		return $this -> conn -> error;
	}

	/**
	 * Method to escape user input to prevent SQL injection
	 * @param string $data String to escape
	 * @return string
	 */
	public function clean( $data )
	{
		return $this -> conn -> real_escape_string( htmlspecialchars( $data ) );
	}

	/**
	 * Method to convert database query result as an associative array
	 * @param array $result Database query result
	 * @return array
	 */
	public function fetch( $result )
	{
		return $this -> conn -> fetch_assoc( $result );
	}

	/**
	 * Method to check if database query has any result items(rows)
	 * @param object $query Database query
	 * @return bool
	 */
	public function rows( $query )
	{
		return ( $query -> num_rows > 0 ) ? true : false;
	}

	/**
	 * Method to create new record
	 * Don't use it directly, use insert() instead
	 * @param string $table Database table in which to insert record, without the prefix, if any
	 * @param array $collumns List of database collumns to fill
	 * @param array $values List of values to insert into table
	 * @return bool
	 */
	public function create( $table, $collumns, $values )
	{
		$collumns = implode(", ", $collumns);
		array_walk( $values, [$this, "clean"] );
		$nuvals = [];
		foreach ($values as $value) {
			$nuvals[] = "'".$value."'";
		}
		$values = implode(", ", $nuvals);

		$sql = "INSERT INTO ".$this -> prefix.$table." ( $collumns ) VALUES ( $values )";

		return $this -> query( $sql );
	}

	/**
	 * Method to select records with given conditions - strict
	 * Don't use it directly, use find() instead and pass 'read' as the third argument(callable)
	 * @param string $table Database table in which to search for records, without the prefix, if any
	 * @param array $conditions Constraints to apply to action, e.g ['title' => 'Sandal']
	 * @return bool
	 */
	public function read( $table, $collumns = null, $conditions = null )
	{
		$table = $this -> prefix.$table;

		$collumns = !is_null( $collumns ) ? $collumns : $this -> collumns;
		$collumns = implode( ", ", $collumns );
		if ( !is_null( $conditions ) ) {
			array_walk( $conditions, [$this, "clean"] );
			$nuconds = [];
			foreach ( $conditions as $key => $value ) {
				$nuconds[] = "$key = '".$value."'";
			}
			$conditions = implode( "AND ", $nuconds );
			$sql = "SELECT $collumns FROM $table WHERE $conditions";
		} else {
			$sql = "SELECT $collumns FROM $table";
		}

		$query = $this -> query( $sql );
		$results = [];
		if ( $query && $this -> rows( $query ) ) {
			while ( $result = $this -> fetch ( $query ) ) {
				$results[] = $result;
			}
		} else {
			$results = ["error" => "Records Not Found"];
		}

		return $results;
	}

	/**
	 * Method to search for records with given conditions - Uses regular expressions, not strict
	 * Don't use it directly, use find() instead and pass 'search' as the third argument(callable)
	 * @param string $table Database table in which to search for records, without the prefix, if any
	 * @param array $conditions Constraints to apply to action, e.g ['title' => 'Sandal']
	 * @return bool
	 */
	public function search( $table, $collumns = null, $conditions = null )
	{
		$table = $this -> prefix.$table;
		$collumns = is_null( $collumns ) ? ['*'] : $collumns;
		$collumns = implode( ", ", $collumns );

		if ( !is_null( $conditions ) ) {
			array_walk( $conditions, [$this, "clean"] );
			$nuconds = [];
			foreach ( $conditions as $key => $value ) {
				$nuconds[] = "$key LIKE '%".$value."%'";
			}
			$conditions = implode( "OR ", $nuconds );
			$sql = "SELECT $collumns FROM $table WHERE $conditions";
		} else {
			$sql = "SELECT $collumns FROM $table";
		}
		$query = $this -> query( $sql );

		if ( $query && $this -> rows( $query ) ) {
			while ( $result = $this -> fetch ( $query ) ) {
				$results[] = $result;
			}
		} else {
			$results = ["error" => "Record Not Found"];
		}

		return $results;
	}

	/**
	 * Method to reset array index
	 * @param array $result The database query to reset
	 * @param int $row Index to reset to
	 * @return bool/mixed
	 */
	public function reset( $result, $row = 0 )
	{
		return mysqli_data_seek( $result, $row );
  	}

	/**
	 * Method to update existing record
	 * Don't use it directly, use insert() instead
	 * @param string $table Database table in which to update record, without the prefix, if any
	 * @param array $collumns List of database collumns to update
	 * @param arry $values List of values to insert into table row
	 * @param array $conditions Constraints to apply to action, e.g ['title' => 'Sandal']
	 * @return bool
	 */
	public function update( $table, $collumns, $values, $conditions )
	{
		$collumns = implode(", ", $collumns);

		array_walk( $values, [$this, "clean"] );
		$nuvals = [];
		$colvals = array_combine( $collumns, $values);
		foreach ( $colvals as $collumn => $value ) {
			$nuvals[] = "$collumn = '".$value."'";
		}
		$values = implode(", ", $nuvals);

		array_walk( $conditions, [$this, "clean"] );
		$nuconds = [];
		foreach ($conditions as $key => $value) {
			$nuconds[] = "$key = '".$value."'";
		}
		$conditions = implode("AND ", $nuconds);

		$sql = "UPDATE ".$this -> prefix.$table." SET $values WHERE $conditions";
		return $this -> query( $sql );
	}

	/**
	 * Method to delete a record with given conditions
	 * @param $table Database table in which to delete record, without the prefix, if any
	 * @param array $conditions Constraints to apply to action, e.g ['id' => 2] OR ['status' => 'spam']
	 * @return bool
	 */
	public function remove( $table, $conditions = null )
	{
		if ( !is_null( $conditions )) {
			array_walk( $conditions, [$this, "clean"] );

			$nuconds = [];
			foreach ($conditions as $key => $value) {
				$nuconds[] = "$key = '".$value."'";
			}
			$conditions = implode("AND ", $nuconds);

			$sql = "DELETE FROM ".$this -> prefix.$table." WHERE $conditions";
		} else {
			$sql = "DELETE FROM ".$this -> prefix.$table;
		}

		return $this -> query( $sql );
	}

	/**
	 * Method to order/sort $results array by a given key's value
	 * @param array $results Database query results to sort
	 * @param string $key The key whose value to order by
	 * @param string $order Way to order array, either Ascending(ASC) of Descending(DESC)
	 * @return array
	 */
	public function order( $results, $key, $order = "ASC" )
	{
		define( 'key', $key );
		usort( $results, function ( $a, $b )
		{
			return strcmp( $a[key], $b[key] );
		});

		return $results;
	}

	/**
	 * Method to offset array by given number
	 * @param array $results Database query results to offset
	 * @param int $offset Number of records to skip
	 * @return array
	 */
	public function offset( $results, $offset = 0 )
	{
		return array_slice( $results, $offset );
	}

	/**
	 * Method for creating or updating a record
	 * @param array $collums Database collumns for whose values to insert
	 * @param array $conditions Constraints to apply to action
	 * @return bool
	 */
	public function insert( $values, $collumns = null, $conditions = null )
	{
		$collumns = is_null( $collumns ) ? $this -> collumns : $collumns;	

		if ( is_null( $conditions ) ) {
			if ( !$this -> create( $this -> table, $collumns, $values ) ) {
				return;
			}
		} else {
			if ( !$this -> update( $this -> table, $collumns, $values, $conditions ) ) {
				return;
			}
		}
	}

	/**
	 * Method for selecting records with given constraints
	 * @param array $collumns Database collumns to select
	 * @param array $conditions Constraints to apply to selection
	 * @param callable $callable Callback method - either read(strict) or search(flexible)
	 * @return array
	 */
	public function find( $conditions = null, $collumns = null, $callable = "read" )
	{
		$collumns = !is_null( $collumns ) ? $collumns : $this -> collumns;
		return $this -> $callable( $this -> table, $collumns, $conditions );
	}

	/**
	 * Method for selecting a single records with given constraints
	 * Conditions must be on primary keys/unique fields e.g [ 'id' => 1 ]
	 * @param array $collumns Database collumns to select
	 * @param array $conditions Constraints to apply to selection
	 */
	public function single( $conditions, $collumns = null )
	{
		$collumns = !is_null( $collumns ) ? $collumns : $this -> collumns;
		$results = $this -> read( $this -> table, $collumns, $conditions );

		foreach ( $results[0] as $property => $value ) {
			$this -> $property = $value;
		}
	}

	public function delete( $conditions = null )
	{
		return $this -> remove( $this -> table, $conditions );
	}
}