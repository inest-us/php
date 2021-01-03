<?php
require_once ('common_db.inc');
$exclude_dirs = array('/info', '/contact');
$exclude_files = array('index.html', 'info.html', 'register.php');
$user_tablename = 'user';
$access_log_tablename = 'access_log';
$PHP_SELF = $_SERVER['PHP_SELF'];


 session_start();
 session_register('userid', 'userpassword');
if (!$_SESSION['userid']){
 $filepath = dirname($_SERVER['SCRIPT_FILENAME']);
 $filename = basename($_SERVER['SCRIPT_FILENAME']);
 if($filepath == '') $filepath = '/';

 $auth_done = 0;

 for($j=0; $j < count($exclude_dirs); $j++) {
   if($exclude_dirs[$j] == $filepath) break;
   else {
     for($i=0; $i< count($exclude_files); $i++) {
        
	  if($exclude_files[$i] == $filename) break;
	
	  if ($i == (count($exclude_files) - 1)){
           
         do_authentication();
         $auth_done = 1;
         break;
	  }
     }
   }
   if($auth_done) break;
  }
}
?>


if ($_SESSION['userid'] && $_SESSION['userpassword']){
$userid = $_SESSION['userid'];
$filename = basename($_SERVER['SCRIPT_FILENAME']);
$link_id = db_connect($default_dbname);
$query = "SELECT userid FROM $access_log_tablename
                            WHERE page = '$filename'
                            AND userid = '$userid'";      
      $result = mysql_query($query);
	   
       if(!mysql_num_rows($result)) 
		  
         $query = "INSERT INTO $access_log_tablename 
                         VALUES ('$filename', '$userid', 1, NULL)";
      else $query = "UPDATE $access_log_tablename 
                     SET visitcount = visitcount + 1, accessdate = NULL 
                     WHERE page = '$filename' AND userid = '$userid'";

      mysql_query($query);

      $num_rows = mysql_affected_rows($link_id);
      if($num_rows != 1) die(sql_error());
 }


function do_authentication() {
   global $default_dbname, $user_tablename, $access_log_tablename;
   global $MYSQL_ERROR, $MYSQL_ERRNO;
   global $filename;
   global $PHP_SELF;

      if(!isset($_POST['userid'])) {
      login_form();
      exit;
   }

 
else {      
   $_SESSION['userpassword'] = $_POST['userpassword'];
   $_SESSION['userid'] = $_POST['userid']; }
   $userid = $_POST['userid'];
   $userpassword = $_POST['userpassword'];
   $link_id = db_connect($default_dbname);
   $query = "SELECT username FROM $user_tablename 
             WHERE userid = '$userid' 
             AND userpassword = password('$userpassword')";
   $result = mysql_query($query);


if(!mysql_num_rows($result)) {
      session_unregister("userid");
       echo "Authorization failed. " .
         "You must enter a valid userid and password combo. " .
         "Click on the following link to try again.<BR>\n";
      echo "<A HREF=\"$PHP_SELF\">Login</A><BR>";    
      echo "If you're not a member yet, click on the " .
           "following link to register.<BR>\n";
      echo "<A HREF= \"register.php\">Membership</A>";    
      exit;
   }


else {
      $query = "SELECT userid FROM $access_log_tablename
                            WHERE page = '$filename'
                            AND userid = '$userid'";      
      $result = mysql_query($query);
	   
       if(!mysql_num_rows($result)) 
		  
         $query = "INSERT INTO $access_log_tablename 
                         VALUES ('$filename', '$userid', 1, NULL)";
      else $query = "UPDATE $access_log_tablename 
                     SET visitcount = visitcount + 1, accessdate = NULL 
                     WHERE page = '$filename' AND userid = '$userid'";

      mysql_query($query);

      $num_rows = mysql_affected_rows($link_id);
      if($num_rows != 1) die(sql_error());
   }
}
