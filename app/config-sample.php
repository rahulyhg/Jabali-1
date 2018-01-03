<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage App Configuration File
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.04
* @link https://docs.jabalicms.org/functions/
* @license MIT - https://opensource.org/licenses/MIT
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
$server = [];
$server["dbhost"] = "localhost";
$server["dbuser"] = "root";
$server["dbpass"] = "";
$server["dbname"] = "jabali";
$server["dbprefix"] = "db_";
$server["dbtype"] = "MySQL";
$server["dbport"] = "80";
$server["dbip"] = "::1";

define( 'appconfig', $server );

define( "_ROOT", "http://localhost/Jabali" );
define( "_DBPREFIX", "db_" );
define( "JBLSALT", "e2af5d5b4cd06e9e3c85c23401765384" );
define( "JBLAUTH", "00f3908488d6d9a35b0e781b1acb84b91c7693a1" );

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
* These configurations are not necessary, but if you so wish you can override the Jabali
* default configurations by setting them here. Just comment the code.
*/

//define( "APP_SKIN", "" );
//define( "APP_SCHEMA", "" );
//define( "APP_DB_PATH", "" );