<?php
//userman.php
include_once "./common_db.inc";

$link_id = db_connect();
mysql_select_db("sample_db");
$position_array = enum_options('userposition', $link_id);
mysql_close($link_id);


function user_message($msg, $url ='') {
  html_header();
  
  if(empty($url)) 
       echo "<SCRIPT>alert(\"$msg\");history.go(-1)</SCRIPT>";
  else echo "<SCRIPT>alert(\"$msg\");self.location.href='$url'</SCRIPT>";
  
  html_footer();
  exit;
}

function list_records() {
   global $default_dbname, $user_tablename;
   global $records_per_page;
   $PHP_SELF = $_SERVER['PHP_SELF'];
   
   $link_id = db_connect($default_dbname);
   if(!$link_id) error_message(sql_error());

   $query = "SELECT count(*) FROM $user_tablename";

   $result = mysql_query($query);
   if(!$result) error_message(sql_error());
      
   $query_data = mysql_fetch_row($result);
   $total_num_user = $query_data[0];
   if(!$total_num_user) error_message('No User Found!');





if(empty($_GET['next_page'])) {
  $_GET['next_page'] = 0;
}
   $cur_page = $_GET['next_page'];
   $page_num = $cur_page + 1;
   $total_num_page = $last_page_num  = ceil($total_num_user/$records_per_page);
   
   html_header();
   
   echo "<CENTER><H3>$total_num_user users found. Displaying the page
                     $page_num out of $last_page_num.</H3></CENTER>\n";


if (empty($_GET['order_by'])) $_GET['order_by'] = 'userid';
 
$order_by = $_GET['order_by'];

if (empty($_GET['sort_order'])) {
  $_GET['sort_order'] = 'ASC';
  $sort_order = 'ASC';
}

if ($_GET['sort_order'] == 'ASC')  {
  $sort_order = 'DESC';
  $org_sort_order = 'ASC';
}
  else {
    $sort_order =  'ASC';
    $org_sort_order = 'DESC';
} 



$limit_str = "LIMIT ". " 5". " OFFSET ". ($cur_page * $records_per_page);



   $query = "SELECT usernumber, userid, username FROM $user_tablename ORDER BY 
                                  $_GET[order_by] $_GET[sort_order] $limit_str ";
   
   $result = mysql_query($query);   
   if(!$result) error_message(sql_error());
?>


<DIV ALIGN="CENTER">
<TABLE BORDER="1" WIDTH="90%" CELLPADDING="2">
   <TR>
      <TH WIDTH="25%" NOWRAP>
         <A HREF="<?php echo "$PHP_SELF?action=list_records&
                                  sort_order=$sort_order&
                                  order_by=usernumber"; ?>">
         User Number
         </A>
      </TH>
      <TH WIDTH="25%" NOWRAP>
         <A HREF="<?php echo "$PHP_SELF?action=list_records&
                                     sort_order=$sort_order&
                                     order_by=userid"; ?>">
         User ID
         </A>
      </TH>
      <TH WIDTH="25%" NOWRAP>
         <A HREF="<?php echo "$PHP_SELF?action=list_records&
                                     sort_order=$sort_order&
                                     order_by=username"; ?>">
            User Name
         </A>


      </TH>
      <TH WIDTH="25%" NOWRAP>Action</TH>
   </TR>
<?php



   while($query_data = mysql_fetch_array($result)) {
      $usernumber = $query_data["usernumber"];
      $userid = $query_data["userid"];
      $username = $query_data["username"];
      echo "<TR>\n";
      echo "<TD WIDTH=\"25%\" ALIGN=\"CENTER\">$usernumber</TD>\n";
      echo "<TD WIDTH=\"25%\" ALIGN=\"CENTER\">$userid</TD>\n";
      echo "<TD WIDTH=\"25%\" ALIGN=\"CENTER\">$username</TD>\n";
     echo "<TD WIDTH=\"25%\" ALIGN=\"CENTER\">
            <A HREF=\"javascript:open_window('$PHP_SELF?action=view_record&
                                                        userid=$userid');\">
            View</A>
            <A HREF=\"$PHP_SELF?action=delete_record&userid=$userid\"
               onClick=\"return confirm('Are you sure?');\">
            Delete</A>
            </TD>\n";
      echo "</TR>\n";
   }
?>
</TABLE>
</DIV>
<?php      
   echo "<BR>\n";
   echo "<STRONG><CENTER>";



   if($page_num > 1) {
      $prev_page = $cur_page - 1;

      echo "<A HREF=\"$PHP_SELF?action=list_records&
        sort_order=$org_sort_order&order_by=$order_by&next_page=0\">[Top]</A>";

      echo "<A HREF=\"$PHP_SELF?action=list_records&sort_order=$org_sort_order
        &order_by=$order_by&next_page=$prev_page\">[Prev]</A> ";
	 
   }




   if($page_num <  $total_num_page) {
      $next_page = $cur_page + 1;
      $last_page = $total_num_page - 1;

      echo "<A HREF=\"$PHP_SELF?action=list_records&sort_order=$org_sort_order
        &order_by=$order_by&next_page=$next_page\">[Next]</A> ";

      echo "<A HREF=\"$PHP_SELF?action=list_records&sort_order=$org_sort_order&
        order_by=$order_by&next_page=$last_page\">[Bottom]</A>";
   }

   echo "</STRONG></CENTER>"; 



   html_footer();
   }

function delete_record() {
  global $default_dbname, $user_tablename, $access_log_tablename;
  $userid = $_GET['userid'];

  if(empty($userid)) error_message('Empty User ID!');
  
  $link_id = db_connect($default_dbname);
  if(!$link_id) error_message(sql_error());
  
  $query = "DELETE FROM $user_tablename WHERE userid = '$userid'";
  $result = mysql_query($query);
  if(!$result) error_message(sql_error());

  $num_rows = mysql_affected_rows($link_id);
  if($num_rows != 1) error_message("No such user: $userid");

  $query = "DELETE FROM $access_log_tablename WHERE userid = '$userid'";
  $result = mysql_query($query);
  
  user_message("All records regarding $userid have been trashed!");
}

function edit_record() {
  global $default_dbname, $user_tablename, $access_log_tablename;
  $PHP_SELF = $_SERVER['PHP_SELF'];
  $userid = $_GET['userid'];
  $newuserid = $_GET['new_userid'];
  $username = $_GET['username'];
  $userpassword = $_GET['userpassword'];
  $userposition = $_GET['userposition'];
  $useremail = $_GET['useremail'];
  $userprofile = $_GET['userprofile'];

  if(empty($userid)) $userid = $_GET['new_userid'];
  
  $link_id = db_connect($default_dbname);
  if(!$link_id) error_message(sql_error());
  
  $field_str = '';


if($userid != $new_userid) $field_str = " userid = '$newuserid', ";


  if(!empty($userpassword)) {
    $field_str .= " userpassword = password('$userpassword'), ";
  }


  $field_str .= " username = '$username', ";
  $field_str .= " userposition = '$userposition', ";
  $field_str .= " useremail = '$useremail', ";
  $field_str .= " userprofile = '$userprofile'";
   
  $query = "UPDATE IGNORE $user_tablename SET $field_str WHERE 
    userid = '$userid'";
  $result = mysql_query($query);
  if(!$result) error_message(sql_error());

  $num_rows = mysql_affected_rows($link_id);
  if(!$num_rows) error_message("Nothing changed!");


  if($userid != $new_userid) {
    $query = "UPDATE $access_log_tablename SET userid = '$newuserid' 
    WHERE userid = '$userid'";
    $result = mysql_query($query);
    if(!$result) error_message(sql_error());

    user_message("All records regarding $userid have been changed!",   
	  "$PHP_SELF?action=view_record&userid=$newuserid");
  }
  else {
    user_message("All records regarding $userid have been changed!",
    "$PHP_SELF?action=view_record&userid=$userid");
  }
}


function edit_log_record() {
  global $default_dbname, $access_log_tablename;
  $userid = $_GET['userid'];
  $newpage = $_GET['new_page'];
  $visitcount = $_GET['visitcount'];
  $accessdate = $_GET['accessdate'];
  $orgpage = $_GET['org_page'];
  $PHP_SELF = $_SERVER['PHP_SELF'];
 
  if(empty($userid)) error_message('Empty User ID!');
  
  $link_id = db_connect($default_dbname);
  if(!$link_id) error_message(sql_error());
  
  $field_str = '';
    
  $field_str .= " page = '$newpage', ";
  $field_str .= " visitcount = '$visitcount', ";
  $field_str .= " accessdate = '$accessdate' ";


  $query = "UPDATE $access_log_tablename SET $field_str WHERE userid = '$userid' AND page = '$orgpage'";
 
  $result = mysql_query($query);
  if(!$result) error_message(sql_error());


$num_rows = mysql_affected_rows($link_id);
  if(!$num_rows) error_message("Nothing changed!");

  user_message("All records regarding $userid have been changed!", 
    "$PHP_SELF?action=view_record&userid=$userid");
}

function view_record() {
  global $default_dbname, $user_tablename, $access_log_tablename;
  global $position_array; 
  $userid = $_GET['userid'];
  $PHP_SELF = $_SERVER['PHP_SELF'];
  
  if(empty($userid)) error_message('Empty User ID!');
  
  $link_id = db_connect($default_dbname);
  
  if(!$link_id) error_message(sql_error());
  $query = "SELECT usernumber, userid, username, userposition, useremail,
   userprofile FROM $user_tablename WHERE userid = '$userid'";
   $result = mysql_query($query);
    if(!$result) error_message(sql_error());
  
  $query_data = mysql_fetch_array($result);
  $usernumber = $query_data["usernumber"];
  $userid = $query_data["userid"];
  $username = $query_data["username"];
  $userposition = $query_data["userposition"];
  $useremail = $query_data["useremail"];
  $userprofile = $query_data["userprofile"];


html_header();
  echo "<CENTER><H3>
        Record for User No.$usernumber - $userid($username)
        </H3></CENTER>";
?>


<FORM METHOD="GET" ACTION="<?php echo $PHP_SELF ?>">
<INPUT TYPE="HIDDEN" NAME="action" VALUE="edit_record">
<INPUT TYPE="HIDDEN" NAME="userid" VALUE="<? echo $userid ?>">
<DIV ALIGN="CENTER"><CENTER>
<TABLE BORDER="1" WIDTH="90%" CELLPADDING="2">
    <TR>
      <TH WIDTH="30%" NOWRAP>User ID</TH>


<TD WIDTH="70%">
      <INPUT TYPE="TEXT" NAME="new_userid" 
                         VALUE="<?php echo $userid ?>" 
                         SIZE="8" MAXLENGTH="8"></TD>
    </TR>
    <TR>
      <TH WIDTH="30%" NOWRAP>User Password</TH>


<TD WIDTH="70%"><INPUT TYPE="TEXT" NAME="userpassword" SIZE="15"></TD>
    </TR>
    <TR>
      <TH WIDTH="30%" NOWRAP>Full Name</TH>
      <TD WIDTH="70%"><INPUT TYPE="TEXT" NAME="username" 
                             VALUE="<?php echo $username ?>" SIZE="20"></TD>
    </TR>
    <TR>
      <TH WIDTH="30%" NOWRAP>Position</TH>
      <TD WIDTH="70%"><SELECT NAME="userposition" SIZE="1">
<?php


  for($i=0; $i < count($position_array); $i++) {
    if(!isset($userposition) && $i == 0) {
      echo "<OPTION SELECTED VALUE=\"". $position_array[$i] . "\">" .
                                        $position_array[$i] . "</OPTION>\n";
    }
    else if($userposition == $position_array[$i]) {
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
                             VALUE="<?php echo $useremail ?>"></TD>
    </TR>
    <TR>
      <TH WIDTH="30%" NOWRAP>Profile</TH>


<TD WIDTH="70%">
        <TEXTAREA ROWS="5" COLS="40" NAME="userprofile">
          <?php echo htmlspecialchars($userprofile) ?>
        </TEXTAREA>
      </TD>
    </TR>
    <TR>
      <TH WIDTH="100%" COLSPAN="2" NOWRAP>
        <INPUT TYPE="SUBMIT" VALUE="Change User Record">
        <INPUT TYPE="RESET" VALUE="Reset">
      </TH>
    </TR>
  </TABLE>
  </CENTER></DIV>
</FORM>
<?php  
  echo "<HR SIZE=\"2\" WIDTH=\"90%\">\n";


  $query = "SELECT page, visitcount, accessdate, date_format(accessdate, '%M, %e,
    %Y') as formatted_accessdate FROM $access_log_tablename WHERE 
    userid = '$userid'";
  $result = mysql_query($query);
  
  if(!$result) error_message(sql_error());
  if(!mysql_num_rows($result))
    echo "<CENTER>No access log record for $userid ($username).</CENTER>";
  else {
    echo "<CENTER>Access log record(s) for $userid ($username).</CENTER>";
?>
<DIV ALIGN="CENTER"><CENTER>
<TABLE BORDER="1" WIDTH="90%" CELLPADDING="2">
  <TR>
    <TH WIDTH="20%" NOWRAP>Page</TH>
    <TH WIDTH="20%" NOWRAP>Hits</TH>
    <TH WIDTH="30%" NOWRAP>Last Access</TH>
    <TH WIDTH="30%" NOWRAP>Action</TH>
  </TR>
<?php     


while($query_data = mysql_fetch_array($result)) {
      $page = $query_data["page"];
      $visitcount = $query_data["visitcount"];
      $accessdate = $query_data["accessdate"];
      $formatted_accessdate = $query_data["formatted_accessdate"];
      
      echo "<FORM METHOD=\"GET\" ACTION=\"$PHP_SELF\">";
      echo "<INPUT TYPE=\"HIDDEN\" NAME=\"action\"VALUE=\"edit_log_record\">";
      echo "<INPUT TYPE=\"HIDDEN\" NAME=\"userid\" VALUE=\"$userid\">";
      echo "<INPUT TYPE=\"HIDDEN\" NAME=\"org_page\" VALUE=\"$page\">";
      echo "<TR>\n";
      echo "<TD WIDTH=\"20%\"><INPUT TYPE=\"TEXT\"NAME=\"new_page\" SIZE=\"30\" 
        VALUE=\"$page\"></TD>\n";
      echo "<TD WIDTH=\"20%\" ALIGN=\"CENTER\">
              <INPUT TYPE=\"TEXT\" NAME=\"visitcount\" SIZE=\"3\" 
                                   VALUE=\"$visitcount\"></TD>\n";
      echo "<TD WIDTH=\"30%\" ALIGN=\"CENTER\">
              <INPUT TYPE=\"TEXT\" NAME=\"accessdate\" SIZE=\"14\" 
                     MAXLENGTH=\"14\" VALUE=\"$accessdate\">
            <BR>$formatted_accessdate</TD>\n";
      echo "<TD WIDTH=\"30%\" ALIGN=\"CENTER\">
              <INPUT TYPE=\"SUBMIT\" VALUE=\"Change\">
              <INPUT TYPE=\"RESET\" VALUE=\"Reset\"></TD>\n";
      echo "</TR>\n";
      echo "</FORM>\n";
    }
?>
  </TR>
</TABLE>
</CENTER></DIV>
<?php  
  }
  html_footer();  
}

if (empty($_GET['action'])) $_GET['action'] = "";
switch($_GET['action']) {
  case "edit_record":
    edit_record();
  break;
  case "edit_log_record":
    edit_log_record();
  break;
  case "delete_record":
    delete_record();
  break;
  case "view_record":
    view_record();
  break;
  default: 
    list_records();
  break;
}
?>
