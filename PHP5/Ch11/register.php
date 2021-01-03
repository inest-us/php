<?php
//register.php
include_once "./common_db.inc";

function in_use($userid) {
   global $user_tablename;
   
   $query = "SELECT userid FROM $user_tablename WHERE userid = '$userid'";
   $result = mysql_query($query);
   if(!mysql_num_rows($result)) return 0;
   else return 1;
}

function register_form() {
global $userposition;
global $PHP_SELF;

$link_id = db_connect();
mysql_select_db("sample_db");
$position_array = enum_options('userposition', $link_id);
mysql_close($link_id);

?>


<CENTER><H3>Create your account!</H3></CENTER>
<FORM METHOD="POST" ACTION="<?php echo $PHP_SELF ?>">
<INPUT TYPE="HIDDEN" NAME="action">
  <DIV ALIGN="CENTER"><CENTER><TABLE BORDER="1" WIDTH="90%">
    <TR>
      <TH WIDTH="30%" NOWRAP>Desired ID</TH>
      <TD WIDTH="70%"><INPUT TYPE="TEXT" NAME="userid" 
                             SIZE="8" MAXLENGTH="8"></TD>
    </TR>
    <TR>
      <TH WIDTH="30%" NOWRAP>Desired Password</TH>
      <TD WIDTH="70%"><INPUT TYPE="PASSWORD" 
                             NAME="userpassword" SIZE="15"></TD>
    </TR>
    <TR>
      <TH WIDTH="30%" NOWRAP>Retype Password</TH>
      <TD WIDTH="70%"><INPUT TYPE="PASSWORD" 
                             NAME="userpassword2" SIZE="15"></TD>
    </TR>
    <TR>
      <TH WIDTH="30%" NOWRAP>Full Name</TH>
      <TD WIDTH="70%"><INPUT TYPE="TEXT" NAME="username" SIZE="20"></TD>
    </TR>
    <TR>
      <TH WIDTH="30%" NOWRAP>Position</TH>
      <TD WIDTH="70%"><SELECT NAME="userposition" SIZE="1">
<?php


   for($i=0; $i < count($position_array); $i++) {
    if(!isset($userposition) && $i == 0) {
      echo "<OPTION SELECTED VALUE=\"". $position_array[$i] .
           "\">" . $position_array[$i] . "</OPTION>\n";
    }
    else if($userposition == $cposition_array[$i]) {
      echo "<OPTION SELECTED VALUE=\"". $position_array[$i] . "\">" .
                                        $position_array[$i] . "</OPTION>\n";
    }
    else {
      echo "<OPTION VALUE=\"". $position_array[$i] . "\">" .
                               $position_array[$i] . "</OPTION>\n";
    }
  }
?>


      </SELECT></TD>
    </TR>
    <TR>
      <TH WIDTH="30%" NOWRAP>Email</TH>
      <TD WIDTH="70%"><INPUT TYPE="TEXT" NAME="useremail" SIZE="20"
      </TD>
    </TR>
    <TR>
      <TH WIDTH="30%" NOWRAP>Profile</TH>
      <TD WIDTH="70%"><TEXTAREA ROWS="5" COLS="40" 
                                NAME="userprofile"></TEXTAREA></TD>
    </TR>
    <TR>
      <TH WIDTH="30%" COLSPAN="2" NOWRAP>
        <INPUT TYPE="SUBMIT" VALUE="Submit">
        <INPUT TYPE="RESET" VALUE="Reset"></TH>
    </TR>
  </TABLE>
  </CENTER></DIV>
</FORM>
<?php
}

function create_account() {
   $userid = $_POST['userid'];
   $username = $_POST['username'];
   $userpassword = $_POST['userpassword'];
   $userpassword2 = $_POST['userpassword2'];
   $userposition = $_POST['userposition'];
   $useremail = $_POST['useremail'];
   $userprofile = $_POST['userprofile'];

   global $default_dbname, $user_tablename;


   if(empty($userid)) error_message("Enter your desired ID!");
   if(empty($userpassword)) error_message("Enter your desired password!");
   if(strlen($userpassword) < 4 ) error_message("Password too short!");
   if(empty($userpassword2)) 
                  error_message("Retype your password for verification!");
   if(empty($username)) error_message("Enter your full name!");
   if(empty($useremail)) error_message("Enter your email address!");
   if(empty($userprofile)) $userprofile = "No Comment.";
   
   if($userpassword != $userpassword2)
      error_message("Your desired password and retyped password mismatch!");
   


   $link_id = db_connect($default_dbname);
   
   if(in_use($userid))
         error_message("$userid is in use. Please choose a different ID.");


   $query = "INSERT INTO user VALUES(NULL, '$userid', password('$userpassword'), 
                     '$username', '$userposition', '$useremail', '$userprofile')";
   $result = mysql_query($query);
   if(!$result) error_message(sql_error());


   $usernumber = mysql_insert_id($link_id);
   html_header();
?>   


<CENTER><H3>
<?php echo $username ?>, thank you for registering with us!
</H3></CENTER>

<DIV ALIGN="CENTER"><CENTER><TABLE BORDER="1" WIDTH="90%">
  <TR>
    <TH WIDTH="30%" NOWRAP>User Number</TH>
    <TD WIDTH="70%"><?php echo $usernumber ?></TD>
  </TR>
  <TR>
    <TH WIDTH="30%" NOWRAP>Desired ID</TH>
    <TD WIDTH="70%"><?php echo $userid ?></TD>
  </TR>
  <TR>
    <TH WIDTH="30%" NOWRAP>Desired Password</TH>
    <TD WIDTH="70%"><?php echo $userpassword ?></TD>
  </TR>
  <TR>
    <TH WIDTH="30%" NOWRAP>Full Name</TH>
    <TD WIDTH="70%"><?php echo $username ?></TD>
  </TR>
  <TR>
    <TH WIDTH="30%" NOWRAP>Position</TH>
    <TD WIDTH="70%"><?php echo $userposition ?></TD>
  </TR>
  <TR>
    <TH WIDTH="30%" NOWRAP>Email</TH>
    <TD WIDTH="70%"><?php echo $useremail ?></TD>
  </TR>
  <TR>
    <TH WIDTH="30%" NOWRAP>Profile</TH>
    <TD WIDTH="70%"><?php echo htmlspecialchars($userprofile) ?></TD>
  </TR>
</TABLE>
</CENTER></DIV>
<?php
	html_footer();
}

if (empty($_POST)) $_POST['action'] = "";

switch($_POST['action']) {
   case "register": 
      create_account();
   break;
   default:
      html_header();
      register_form();
      html_footer();
   break;
}
?>
