<?php
//Start output buffering, then headers can be used anywhere. 
ob_start();

//Start sessions this will be needed for the admin area.
session_start();

//database credentials
define('DBHOST','127.0.0.1');
define('DBUSER','root');
define('DBPASS','root');
define('DBNAME','sampledb');

$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
// set the PDO error mode to exception
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//set timezone
date_default_timezone_set('Europe/London');

//load classes as needed
function __autoload($class) {
   
   $class = strtolower($class);

   $classpath = 'classes/class.'.$class . '.php';
   if (file_exists($classpath)) {
      require_once $classpath;
    }     

   $classpath = '../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
    }
}

$user = new User($db);