<?php
$dbhost = 'localhost';
$dbusername = 'phpuser';
$dbuserpassword = 'phppass';
$default_dbname = 'sample_db';

$records_per_page = 5;

$user_tablename = 'user';
$access_log_tablename = 'access_log';

$MYSQL_ERRNO = '';
$MYSQL_ERROR = '';

$new_win_width = 600;
$new_win_height = 400;

function html_header(){

   global $new_win_width, $new_win_height;
   ?>
   <HTML>
   <HEAD>
   <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
   <!--
   function open_window(url) {
      var NEW_WIN = null;
      NEW_WIN = window.open ("", "RecordViewer");
      NEW_WIN.location.href = url;
   }
   //-->
   </SCRIPT>
   <TITLE>User Record Viewer</TITLE>
   </HEAD>
   <BODY>
   <?php
}


function html_footer() {
?>
</BODY>
</HTML>
<?php
}

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

function sql_error() {
   global $MYSQL_ERRNO, $MYSQL_ERROR;

   if(empty($MYSQL_ERROR)) {
      $MYSQL_ERRNO = mysql_errno();
      $MYSQL_ERROR = mysql_error();
   }
   return "$MYSQL_ERRNO: $MYSQL_ERROR";
}

function error_message($msg) {
  // html_header();
   echo "<SCRIPT>alert(\"Error: $msg\");history.go(-1)</SCRIPT>";
   html_footer();
   exit;
}
function enum_options($field, $link_id) {
   $query = "SHOW COLUMNS FROM user LIKE '$field'";
   $result = mysql_query($query, $link_id);
   $query_data = mysql_fetch_array($result);
   
   if(eregi("('.*')", $query_data["Type"], $match)) {
      $enum_str = ereg_replace("'", "", $match[1]);
      $enum_options = explode(',', $enum_str);
      return $enum_options;
   } else return 0;
}

?>
