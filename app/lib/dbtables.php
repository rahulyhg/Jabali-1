<?php 
/**
* Database table creation utility class
* @since 0.17.10
* @author Mauko Maunde < hi@mauko.co.ke >
* @see https://jabalicms.org/dbtables/
* @license MIT - https://opensource.org/licenses/MIT
**/

namespace Jabali\Lib;

class DBTables
{
  public $prefix;
  public $tables;

  /**
  * Constructor method for our class
  * @param $type The type of database management system (DBMS) set in config.php
  **/
  public function __construct( $type = 'MySQL' )
  {
    $this -> prefix = _DBPREFIX;
    $this -> tables = call_user_func_array( [ $this, $type ], []);
  }

  /**
  * Table creation for MySQL databases
  * @return array
  **/
  public function MySQL()
  {
    $tables = array();
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}users
    ( id INT AUTO_INCREMENT,
    authkey VARCHAR(100),
    author VARCHAR(12),
    author_name VARCHAR(20), 
    avatar VARCHAR(100),
    categories VARCHAR(20),  
    company VARCHAR(100),
    created DATETIME,
    custom VARCHAR(150),
    details TEXT,
    email  VARCHAR(50) UNIQUE,
    excerpt TEXT,
    gender VARCHAR(8),
    level VARCHAR(12),
    link VARCHAR(100),
    location VARCHAR(50),
    title VARCHAR(100),
    password VARCHAR(50),
    phone VARCHAR(20),
    social TEXT,
    status VARCHAR(20),
    style VARCHAR(100),
    tags VARCHAR(200),
    type VARCHAR(20),
    updated DATETIME,
    username VARCHAR(20) UNIQUE,
    PRIMARY KEY(id, username)
    )
SQL;
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}resources (
    id INT AUTO_INCREMENT,
    title VARCHAR(100),
    author VARCHAR(12),
    avatar VARCHAR(20),
    author_name VARCHAR(20), 
    company VARCHAR(20),
    created DATETIME,
    custom VARCHAR(12),
    details TEXT,
    email  VARCHAR(50),
    authkey VARCHAR(100),
    level VARCHAR(12),
    link VARCHAR(100),
    location VARCHAR(50),
    excerpt TEXT,
    phone VARCHAR(20),
    social VARCHAR(500),
    status VARCHAR(20),
    type VARCHAR(50),
    updated DATETIME,
    PRIMARY KEY(id)
    )
SQL;
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}messages(
    id INT AUTO_INCREMENT,
    authkey VARCHAR(100),
    title VARCHAR(100),
    author VARCHAR(20),
    author_name VARCHAR(20),
    created DATETIME,
    details TEXT,
    email  VARCHAR(50),
    receipient VARCHAR(20),
    level VARCHAR(12),
    phone VARCHAR(20),
    status VARCHAR(20),
    type VARCHAR(50),
    PRIMARY KEY(id)
    )
SQL;

    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}comments(
    id INT AUTO_INCREMENT,
    authkey VARCHAR(100),
    title VARCHAR(100),
    author VARCHAR(20),
    author_name VARCHAR(20),
    created DATETIME,
    details TEXT,
    email  VARCHAR(50),
    parent VARCHAR(20),
    level VARCHAR(12),
    link VARCHAR(100),
    status VARCHAR(20),
    type VARCHAR(50),
    updated DATETIME,
    PRIMARY KEY(id)
    )
SQL;
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}posts(
    title VARCHAR(300),
    author VARCHAR(20),
    author_name VARCHAR(100),
    avatar VARCHAR(100),
    categories VARCHAR(20),
    id INT AUTO_INCREMENT,
    created DATETIME,
    details TEXT,
    gallery VARCHAR(500),
    authkey VARCHAR(100),
    level VARCHAR(12),
    link VARCHAR(100),
    excerpt TEXT,
    readings VARCHAR(500),
    status VARCHAR(20),
    subtitle VARCHAR(100),
    slug VARCHAR(300) UNIQUE,
    tags VARCHAR(50),
    template VARCHAR(50),
    type VARCHAR(50),
    updated DATETIME,
    PRIMARY KEY(id)
    )
SQL;
  $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}options (
    id INT AUTO_INCREMENT,
    title VARCHAR(200),
    code VARCHAR(100) UNIQUE,
    details TEXT,
    updated DATETIME,
    PRIMARY KEY(id, code)
    )
SQL;
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}clients (
    id INT AUTO_INCREMENT,
    title VARCHAR(200),
    appkey VARCHAR(100) UNIQUE,
    appsecret VARCHAR(100) UNIQUE,
    status VARCHAR(20),
    updated DATETIME,
    PRIMARY KEY(id)
    )
SQL;

  $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}menus (
    id INT AUTO_INCREMENT,
    author VARCHAR(20),
    avatar VARCHAR(100),
    code VARCHAR(100) UNIQUE,
    parent VARCHAR(20),
    link VARCHAR(100),
    location VARCHAR(100),
    title VARCHAR(200),
    type VARCHAR(50),
    status VARCHAR(50),
    updated DATETIME,
    PRIMARY KEY(id, code)
    )
SQL;
    return $tables;
  }

  /**
  * Table creation for SQLite databases
  * @return array
  **/
  public function SQLite()
  {
    $tables = array();
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}users
    ( id        INTEGER             PRIMARY KEY       AUTOINCREMENT,
    authkey     VARCHAR(100),
    author      VARCHAR(12),
    author_name VARCHAR(20), 
    avatar      VARCHAR(100),
    categories  VARCHAR(20),  
    company     VARCHAR(100),
    created     REAL,
    custom      VARCHAR(150),
    details     TEXT,
    email       VARCHAR(50)     UNIQUE,
    excerpt     TEXT,
    gender      VARCHAR(8),
    level       VARCHAR(12),
    link        VARCHAR(100),
    location    VARCHAR(50),
    title        VARCHAR(100),
    password    VARCHAR(50),
    phone       VARCHAR(20),
    social      TEXT,
    status      VARCHAR(20),
    style       VARCHAR(100),
    tags        VARCHAR(200),
    type        VARCHAR(20),
    updated     REAL,
    username    VARCHAR(20)     UNIQUE
    )
SQL;
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}resources (
    id          INTEGER           PRIMARY KEY AUTOINCREMENT,
    title        VARCHAR(100),
    author      VARCHAR(12),
    avatar      VARCHAR(20),
    author_name VARCHAR(20),
    company     VARCHAR(20),
    created     REAL,
    custom      VARCHAR(12),
    details     TEXT,
    email       VARCHAR(50),
    authkey     VARCHAR(100),
    level       VARCHAR(12),
    link        VARCHAR(100),
    location    VARCHAR(50),
    excerpt     TEXT,
    phone       VARCHAR(20),
    social      VARCHAR(500),
    status      VARCHAR(20),
    type        VARCHAR(50),
    updated     REAL
    )
SQL;
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}messages(
    id           INTEGER      PRIMARY KEY      AUTOINCREMENT,
    authkey      VARCHAR(100),
    title         VARCHAR(100),
    author       VARCHAR(20),
    author_name  VARCHAR(20),
    created      DATETIME,
    details      TEXT,
    email        VARCHAR(50),
    receipient   VARCHAR(20),
    level        VARCHAR(12),
    phone        VARCHAR(20),
    status       VARCHAR(20),
    type         VARCHAR(50)
    )
SQL;

    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}comments(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    authkey VARCHAR(100),
    title VARCHAR(100),
    author VARCHAR(20),
    author_name VARCHAR(20),
    created DATETIME,
    details TEXT,
    email  VARCHAR(50),
    parent VARCHAR(20),
    level VARCHAR(12),
    link VARCHAR(100),
    status VARCHAR(20),
    type VARCHAR(50),
    updated DATETIME
    )
SQL;
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}posts(
    title VARCHAR(300),
    author VARCHAR(20),
    author_name VARCHAR(100),
    avatar VARCHAR(100),
    categories VARCHAR(20),
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    created REAL,
    details TEXT,
    gallery VARCHAR(500),
    authkey VARCHAR(100),
    level VARCHAR(12),
    link VARCHAR(100),
    excerpt TEXT,
    readings VARCHAR(500),
    status VARCHAR(20),
    subtitle VARCHAR(100),
    slug VARCHAR(300) UNIQUE,
    tags VARCHAR(50),
    template VARCHAR(50),
    type VARCHAR(50),
    updated REAL
    )
SQL;
  $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}options (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(200),
    code VARCHAR(100) UNIQUE,
    details TEXT,
    updated REAL
    )
SQL;
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}clients (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(200),
    appkey VARCHAR(100) UNIQUE,
    appsecret VARCHAR(100) UNIQUE,
    status VARCHAR(20),
    updated DATETIME
    )
SQL;

  $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}menus (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    author VARCHAR(20),
    avatar VARCHAR(100),
    code VARCHAR(100) UNIQUE,
    parent VARCHAR(20),
    link VARCHAR(100),
    location VARCHAR(100),
    title VARCHAR(200),
    type VARCHAR(50),
    status VARCHAR(50),
    updated REAL
    )
SQL;
    return $tables;
  }

  /**
  * Table creation for PostgreSQL databases
  * @return array
  **/
  public function PostgreSQL()
  {
    $tables = array();
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}users
    ( id INT AUTOINCREMENT,
    authkey VARCHAR(100),
    author VARCHAR(12),
    author_name VARCHAR(20), 
    avatar VARCHAR(100),
    categories VARCHAR(20),  
    company VARCHAR(100),
    created DATETIME,
    custom VARCHAR(150),
    details TEXT,
    email  VARCHAR(50) UNIQUE,
    excerpt TEXT,
    gender VARCHAR(8),
    level VARCHAR(12),
    link VARCHAR(100),
    location VARCHAR(50),
    title VARCHAR(100),
    password VARCHAR(50),
    phone VARCHAR(20),
    social TEXT,
    status VARCHAR(20),
    style VARCHAR(100),
    tags VARCHAR(200),
    type VARCHAR(20),
    updated DATETIME,
    username VARCHAR(20) UNIQUE,
    PRIMARY KEY(id, username)
    )
SQL;
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}resources (
    id INT AUTOINCREMENT,
    title VARCHAR(100),
    author VARCHAR(12),
    avatar VARCHAR(20),
    author_name VARCHAR(20), 
    company VARCHAR(20),
    created DATETIME,
    custom VARCHAR(12),
    details TEXT,
    email  VARCHAR(50),
    authkey VARCHAR(100),
    level VARCHAR(12),
    link VARCHAR(100),
    location VARCHAR(50),
    excerpt TEXT,
    phone VARCHAR(20),
    social VARCHAR(500),
    status VARCHAR(20),
    type VARCHAR(50),
    updated DATETIME,
    PRIMARY KEY(id)
    )
SQL;
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}messages(
    id INT AUTOINCREMENT,
    authkey VARCHAR(100),
    title VARCHAR(100),
    author VARCHAR(20),
    author_name VARCHAR(20),
    created DATETIME,
    details TEXT,
    email  VARCHAR(50),
    receipient VARCHAR(20),
    level VARCHAR(12),
    phone VARCHAR(20),
    status VARCHAR(20),
    type VARCHAR(50),
    PRIMARY KEY(id)
    )
SQL;

    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}comments(
    id INT AUTOINCREMENT,
    authkey VARCHAR(100),
    title VARCHAR(100),
    author VARCHAR(20),
    author_name VARCHAR(20),
    created DATETIME,
    details TEXT,
    email  VARCHAR(50),
    parent VARCHAR(20),
    level VARCHAR(12),
    link VARCHAR(100),
    status VARCHAR(20),
    type VARCHAR(50),
    updated DATETIME,
    PRIMARY KEY(id)
    )
SQL;
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}posts(
    title VARCHAR(300),
    author VARCHAR(20),
    author_name VARCHAR(100),
    avatar VARCHAR(100),
    categories VARCHAR(20),
    id INT AUTOINCREMENT,
    created DATETIME,
    details TEXT,
    gallery VARCHAR(500),
    authkey VARCHAR(100),
    level VARCHAR(12),
    link VARCHAR(100),
    excerpt TEXT,
    readings VARCHAR(500),
    status VARCHAR(20),
    subtitle VARCHAR(100),
    slug VARCHAR(300) UNIQUE,
    tags VARCHAR(50),
    template VARCHAR(50),
    type VARCHAR(50),
    updated DATETIME,
    PRIMARY KEY(id)
    )
SQL;
  $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}options (
    id INT AUTOINCREMENT,
    title VARCHAR(200),
    code VARCHAR(100) UNIQUE,
    details TEXT,
    updated DATETIME,
    PRIMARY KEY(id, code)
    )
SQL;
    $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}clients (
    id INT AUTOINCREMENT,
    title VARCHAR(200),
    appkey VARCHAR(100) UNIQUE,
    appsecret VARCHAR(100) UNIQUE,
    status VARCHAR(20),
    updated DATETIME,
    PRIMARY KEY(id)
    )
SQL;

  $tables[] = <<<SQL
    CREATE TABLE IF NOT EXISTS {$this -> prefix}menus (
    id INT AUTOINCREMENT,
    author VARCHAR(20),
    avatar VARCHAR(100),
    code VARCHAR(100) UNIQUE,
    parent VARCHAR(20),
    link VARCHAR(100),
    location VARCHAR(100),
    title VARCHAR(200),
    type VARCHAR(50),
    status VARCHAR(50),
    updated DATETIME,
    PRIMARY KEY(id, code)
    )
SQL;
    return $tables;
  }  

  /**
  * Collection creation for MongoDB databases
  * @return array
  **/
  public function MongoDB()
  {
    $tables = array( 'users', 'posts', 'resources', 'messages', 'comments', 'options', 'clients' );
    return $tables;
  }

  /**
  * Collection creation for CouchDB databases
  * @return array
  **/
  public function CouchDB()
  {
    $tables = array( 'users', 'posts', 'resources', 'messages', 'comments', 'options', 'clients' );
    return $tables;
  }
}