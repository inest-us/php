<HTML>
  <HEAD>
    <TITLE>Beginning PHP5 - ODBC</TITLE>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  </HEAD>
  <BODY bgcolor="#FFFFFF">
    <FORM action="appd.php" method="POST">
      <TABLE>
        <TR>
          <TD>
<?php
//make a connection

$conn = odbc_connect("bphp5", "", "");
//add a record
if(isset($_POST['add'])) {
	  $query = "INSERT INTO emails (email_address) values('$_POST[email]');";
   odbc_exec($conn, $query);
	  echo "<h3>Email Address Added</h3><br><br>";
}
//edit a record
if(isset($_POST['update'])) {
	  $query = "UPDATE emails SET email_address = '$_POST[up_email]' WHERE email_id=$_POST[up_id];";
	  odbc_exec($conn, $query);
	  echo "<h3>Email Address Updated</h3><br><br>";
}
//select a record from the drop-down list
if(isset($_POST['select'])) {
	  $query = "SELECT * FROM emails WHERE email_id=$_POST[select_id];";
	  $res = odbc_exec($conn,$query);
	  $rec = odbc_fetch_array($res,0);

//insert the id value of the selected record into the hidden field
?>
<INPUT type=hidden name="up_id" value="<? echo $rec['email_id'];?>">
        <TABLE border="0" cellspacing="0" cellpadding="2">
          <TR valign="top"> 
            <TR bgcolor="#003399"> 
              <TABLE width="619" height="11" bgcolor="#FFFFFF" cellpadding="4" 
               cellspacing="0">
                <TR> 
                  <TD colspan="2" class="tablecell"> 
                  </TD>
                </TR>
                <TR> 
                  <TR width="150" class="tablecell">Email Address</td>
                  <TR width="469" class="tablecell"> 
                    <INPUT type="text" name="up_email" value="<? echo $rec['email_address']; 
                     ?>" size="60">
                  </TD>
                </TR>
                <TR> 
                  <TD width="150"></td>
                  <TD width="494"> 
                    <TABLE border="0" cellspacing="0" cellpadding="4">
                      <TR> 
                        <TD> 
                          <INPUT type="submit" value="Update" name="update">
                        </TD>
                        <TD> 
                          <INPUT type="submit" value="Delete" name="delete">
                        </TD>
                      </TR>
                    </TABLE>
                  </TD>
                </TR>
              </TABLE>
            </TD>
          </TR>
        </TABLE>

        <TABLE border="0" cellspacing="0" cellpadding="4" align="center">
          <TR>
            <TD height="10"></td>
          </TR>
          <TR>
            <TD align="center"> 
              <?
	}

//delete a record
if(isset($_POST['delete'])) {
   $query = "DELETE FROM emails WHERE email_id=$_POST[up_id];";
	  odbc_exec($conn,$query);
	  echo "<h3>Email Address Deleted</h3>";
}
//retrieve all records and place in a drop-down list
$query = "SELECT * FROM emails ORDER BY email_id;";
$res = odbc_exec($conn, $query);
?>
<SELECT name="select_id">
<?
while (odbc_fetch_row($res)) {
   $email_id = odbc_result($res,"email_id");
	  $email = odbc_result($res,"email");
?>
	<OPTION value="<? echo $email_id; ?>">
	<? echo "Email ID is " . $email_id . ":" . " and Email Address is " . $email; ?>
	</OPTION>
<?
} 
?>
</SELECT>
              <INPUT type="submit" name="select" value="Select Email Address">
            </TD>
          </TR>
        </TABLE>
          <TABLE border="0" cellspacing="0" cellpadding="2" align="center">
            <TR>
              <TD bgcolor="#003399">
                <TABLE width="619" cellpadding="4" cellspacing="0" align="center" 
                 bgcolor="#FFFFFF">
                  <TR> 
                    <TD colspan="2" class="tablecell">                    
                    </TD>
                  </TR>
                  <TR> 
                    <TD width="150" height="29">Email Address</td>
                    <TD width="494" height="29"> 
                      <INPUT type="text" name="email" size="60">
                    </TD>
                  </TR>                
                  <TR> 
                    <TD width="130"></td>
                    <TD width="477"> 
                      <INPUT type="submit" value="Add New Email Address"
                      name="add">
                    </TD>
                  </TR>
                </TABLE>
               </TD>
             </TR>
           </TABLE>
          </TD>
        </TR>
      </TABLE>
    </FORM>
  </BODY>
</HTML>

