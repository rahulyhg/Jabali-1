<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage App Configuration File
* @link https://docs.jabalicms.org/configuration/
* @author Mauko Maunde
* @since 0.17.04
*
* @param $server["dbhost"] The name of your host, usually localhost
* @param $server["dbuser"] Your server username
* @param $server["dbpass"] Your server password
* @param $server["dbname"] The name of the database to use
* @param $server["dbtype"] The type of database management system. Jabali supports
* @param $server["dbport"] Port through which to communicate with server
* @param $server["dbip"] IP address of the server
* 
* @param _ROOT The app's home/root url
* @param _DBPRFIX A prefix to be added before all database tables. 
* Allows multiple Jabali installations on same database.
* @param JBLSALT A unique, app-specific string for authentication.
* @param JBLAUTH Used in conjuction with JBLSALT for authentication and 
* prevention of Cross-site Request Forgery(CSRF). Also unique and app-specific
**/

$server["dbhost"] = "localhost";
$server["dbuser"] = "root";
$server["dbpass"] = "";
$server["dbname"] = "jabali";
$server["dbtype"] = "MySQL";
$server["dbport"] = "80";
$server["dbip"] = "::1";

define( "_ROOT", "http://localhost/jabali" );
define( "_DBPREFIX", "db_" );
define( "JBLSALT", "5ea3a742c24f72d6602646f126d4991e" );
define( "JBLAUTH", "d2b40a378a4eed8032d80ae6e1535993929ebff7" );

/**
* OPTIONAL CONFIGURATIONS
* @param APP_SKIN Sets the default skin to use for non logged-in users. to use this setting, 
* @see https://jabalicms.org/customization/setting-global-skin/
* APP_SKIN defaults to "zahra". A list of available skins can be found here 
* @link https://jabalicms.org/customization/skins/
* @param APP_SCHEMA to use this setting, 
* @see https://jabalicms.org/databases/set-schema/
* @param APP_DB_PATH Sets the path to the directory where your NoSQL database is stored.
* APP_DB_PATH defaults to /app/data/bases/
* @see https://jabalicms.org/data/bases/
*
* These configurations are not necessary, but if you so wish you can override Jabali's
* default configurations by setting them here. Just comment the code.
*/

//define('APP_SKIN', '');
//define('APP_SCHEMA', '');
//define('APP_DB_PATH', '');