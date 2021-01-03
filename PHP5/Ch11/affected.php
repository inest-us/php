<?php
$dbhost = 'localhost';
$dbusername = 'phpuser';
$dbuserpassword = 'phppass';
$default_dbname = 'sample_db';


$link_id = db_connect();
mysql_query("SELECT * FROM access_log");
$num_rows = mysql_affected_rows($link_id);
echo "$num_rows user(s) have been deleted.";

function db_connect(){
   global $dbhost, $dbusername, $dbuserpassword, $default_dbname;
   global $MYSQL_ERRNO, $MYSQL_ERROR;

   $link_id = mysql_connect($dbhost, $dbusername, $dbuserpassword);
   if(!$link_id) {
      $MYSQL_ERRNO = 0;
      $MYSQL_ERROR = "Connection failed to the host $dbhost.";
      return 0;
   }
   else if(empty($dbname) && !mysql_select_db($default_dbname)) {
      $MYSQL_ERRNO = mysql_errno();
      $MYSQL_ERROR = mysql_error();
      return 0;
   }
   else return $link_id;
}

?>