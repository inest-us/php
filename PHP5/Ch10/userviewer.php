<?php
include "./common_db.inc";

function list_records() {
   global $default_dbname, $user_tablename;
   global $records_per_page;
   $PHP_SELF = "userviewer_working_copy.php";
   
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
   $record = $cur_page * $records_per_page + 5;
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



$limit_str = "LIMIT ". $cur_page * $records_per_page . ", $record";



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
            userid=$userid');\">View Record</A></TD>\n";
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



function view_record() {
   global $default_dbname, $user_tablename, $access_log_tablename;
   $PHP_SELF = "userviewer.php";
   $userid = $_GET['userid'];
   
   if(empty($userid)) error_message('Empty User ID!');
   
   $link_id = db_connect($default_dbname);
      if(!$link_id) error_message(sql_error());

   $query = "SELECT * FROM $user_tablename WHERE userid = '$userid'";
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
<DIV ALIGN="CENTER">
<TABLE BORDER="1" WIDTH="90%" CELLPADDING="2">
   <TR>
      <TH WIDTH="40%">position</TH>
      <TD WIDTH="60%"><?php echo $userposition ?></TD>
   </TR>
   <TR>
      <TH WIDTH="40%">Email</TH>
      <TD WIDTH="60%"><?php echo "<A HREF=\"mailto:$useremail\">$useremail</A>"; ?></TD>
   </TR>
   <TR>
      <TH WIDTH="40%">Profile</TH>
      <TD WIDTH="60%"><?php echo $userprofile ?></TD>
   </TR>
   
</TABLE>
</DIV>
<?php
   echo "<HR SIZE=\"2\" WIDTH=\"90%\">\n";


   $query = "SELECT page, visitcount, accessdate FROM $access_log_tablename
             WHERE userid = '$userid'";

   $result = mysql_query($query);
   if(!$result) error_message(sql_error());




   if(!mysql_num_rows($result))
      echo "<CENTER>No access log record for $userid ($username).</CENTER>";
   else {
      echo "<CENTER>Access log record(s) for $userid ($username).</CENTER>";
?>
<DIV ALIGN="CENTER">
<TABLE BORDER="1" WIDTH="90%" CELLPADDING="2">
   <TR>
      <TH WIDTH="40%" NOWRAP>Web Page</TH>
      <TH WIDTH="20%" NOWRAP>Visit Counts</TH>
      <TH WIDTH="40%" NOWRAP>Last Access Time</TH>
   </TR>
<?php 
      while($query_data = mysql_fetch_array($result)) {
         $page = $query_data["page"];
         $visitcount = $query_data["visitcount"];
         $accessdate = substr($query_data["accessdate"], 0, 4) . '-' .
                  substr($query_data["accessdate"], 4, 2) . '-' .
                  substr($query_data["accessdate"], 6, 2) . ' ' . 
                  substr($query_data["accessdate"], 8, 2) . ':' . 
                  substr($query_data["accessdate"], 10, 2) . ':' . 
                  substr($query_data["accessdate"], 12, 2);

         echo "<TR>\n";
         echo "<TD WIDTH=\"40%\">$page</TD>\n";
         echo "<TD WIDTH=\"20%\" ALIGN=\"CENTER\">$visitcount</TD>\n";
         echo "<TD WIDTH=\"40%\" ALIGN=\"CENTER\">$accessdate</TD>\n";
         echo "</TR>\n";
      }
?>
   </TR>
</TABLE>
</DIV>
<?php

   }
   
   html_footer();   
}



if (empty($_GET['action'])) $_GET['action'] = 'list_records';
switch($_GET['action']) {
   case "view_record":
      view_record();
   break;
   default: 
      list_records();
   break;
}
