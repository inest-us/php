<?php
//Start output buffering, then headers can be used anywhere. 
ob_start();

//Start sessions this will be needed for the admin area.
session_start();

//database credentials
define('DBHOST','');
define('DBUSER','');
define('DBPASS','');
define('DBNAME','');

$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
// set the PDO error mode to exception
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//set timezone
date_default_timezone_set('UTC');

//load classes as needed
function __autoload($class) {
   $class = strtolower($class);

   //if call from within /assets adjust the path
  $classpath = 'classes/class.'.$class . '.php';
  if (file_exists($classpath)) {
    require_once $classpath;
  }     

  //if call from within admin adjust the path
  $classpath = '../classes/class.'.$class . '.php';
  if ( file_exists($classpath)) {
    require_once $classpath;
  }

  //if call from within admin adjust the path
  $classpath = '../../classes/class.'.$class . '.php';
  if ( file_exists($classpath)) {
    require_once $classpath;
  }    
}

$user = new User($db);