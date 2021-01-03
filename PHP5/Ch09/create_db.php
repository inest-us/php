<?php
include "./common_db.inc";

$dbname = "sample_db";
$user_tablename = 'user';
$user_table_def = "usernumber MEDIUMINT(10) DEFAULT '0' NOT NULL AUTO_INCREMENT,";
$user_table_def .= "userid VARCHAR(8) BINARY NOT NULL,";
$user_table_def .= "userpassword VARCHAR(20) BINARY NOT NULL,";
$user_table_def .= "username VARCHAR(30) NOT NULL,";
$user_table_def .= "usercountry VARCHAR(50) NOT NULL,";
$user_table_def .= "useremail VARCHAR(50) NOT NULL,";
$user_table_def .= "userprofile TEXT NOT NULL,";
$user_table_def .= "registerdate DATE DEFAULT '0000-00-00' NOT NULL,";
$user_table_def .= "lastaccesstime TIMESTAMP(14),";
$user_table_def .= "PRIMARY KEY (userid),";
$user_table_def .= "UNIQUE usernumber (usernumber)";

$access_log_tablename = "access_log";
$access_log_table_def = "page VARCHAR(250) NOT NULL,";
$access_log_table_def .= "userid VARCHAR(8) BINARY NOT NULL,";
$access_log_table_def .= "visitcount MEDIUMINT(5) DEFAULT '0' NOT NULL,";
$access_log_table_def .= "accessdate TIMESTAMP(14),KEY page (page),";
$access_log_table_def .= "PRIMARY KEY (userid, page)";

$link_id = db_connect();
if(!$link_id) die(sql_error());

if(!mysql_query("CREATE DATABASE $dbname")) die(sql_error());

echo "Successfully created the $dbname database.<BR>";

if(!mysql_select_db($dbname)) die(sql_error());

if(!mysql_query("CREATE TABLE $user_tablename ($user_table_def);"))
                                                      die(sql_error());

if(!mysql_query("CREATE TABLE $access_log_tablename ($access_log_table_def)")) die(sql_error());

echo "Successfully created the $user_tablename and $access_log_tablename tables.";

?>
