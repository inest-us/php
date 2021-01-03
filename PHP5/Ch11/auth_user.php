<?php
include_once "./common_db.inc";
$register_script = "./register.php";



if(!isset($userid)) {
   login_form();
   exit;


} else {
   session_start();
   session_register("userid", "userpassword");
   $username = auth_user($_POST['userid'], $_POST['userpassword']);



   if(!$username) {
	 $PHP_SELF = $_SERVER['PHP_SELF'];
      session_unregister("userid");
      session_unregister("userpassword");
      echo "Authorization failed. " .
           "You must enter a valid userid and password combo. " .
           "Click on the following link to try again.<BR>\n";
      echo "<A HREF=\"$PHP_SELF\">Login</A><BR>";
      echo "If you're not a member yet, click " .
           "on the following link to register.<BR>\n";
      echo "<A HREF=\"$register_script\">Membership</A>";
      exit;
   }
   else echo "Welcome, $username!";
}



function login_form() {
global $PHP_SELF;
?>
<HTML>
<HEAD>
<TITLE>Login</TITLE>
</HEAD>
<BODY>
<FORM METHOD="POST" ACTION="<?php echo "$PHP_SELF"; ?>">
   <DIV ALIGN="CENTER"><CENTER>
      <H3>Please log in to access the page you requested.</H3>
   <TABLE BORDER="1" WIDTH="200" CELLPADDING="2">
      <TR>
         <TH WIDTH="18%" ALIGN="RIGHT" NOWRAP>ID</TH>
         <TD WIDTH="82%" NOWRAP>
            <INPUT TYPE="TEXT" NAME="userid" SIZE="8">
         </TD>
      </TR>
      <TR>
         <TH WIDTH="18%" ALIGN="RIGHT" NOWRAP>Password</TH>
         <TD WIDTH="82%" NOWRAP>
            <INPUT TYPE="PASSWORD" NAME="userpassword" SIZE="8">
         </TD>
      </TR>
      <TR>
         <TD WIDTH="100%" COLSPAN="2" ALIGN="CENTER" NOWRAP>
            <INPUT TYPE="SUBMIT" VALUE="LOGIN" NAME="Submit">
         </TD>
      </TR>
   </TABLE>
   </CENTER></DIV>
</FORM>
</BODY>
</HTML>
<?
}


function auth_user($userid, $userpassword) {
   global $default_dbname, $user_tablename;
  
 $link_id = db_connect($default_dbname);


   $query = "SELECT username FROM $user_tablename 
                             WHERE userid = '$userid' 
                             AND userpassword = password('$userpassword')";
   $result = mysql_query($query);


   if(!mysql_num_rows($result)) return 0;
   else {
      $query_data = mysql_fetch_row($result);
      return $query_data[0];
   }
}
