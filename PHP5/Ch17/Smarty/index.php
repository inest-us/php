<?php 
require 'Smarty.class.php'; 
$smarty = new Smarty; 

$hostname = "localhost"; 
$db_user = "phpuser"; 
$db_pass = "phppass"; 
$db_name = "sample_db";

// connect to the database 
$conn = mysql_connect($hostname, $db_user, $db_pass); 
if (!$conn){
   die ("Could not connect to the the database!");
}

mysql_select_db($db_name); 

$sql = "SELECT DISTINCT userposition FROM user"; 

$res = mysql_query($sql); 
$results = array(); 
$i=0; 
while ($pos=mysql_fetch_row($res)) { 
   $results[$i++] = $pos[0]; 
 } 

$smarty->assign('results', $results); 
$smarty->display('index.tpl'); 
?>
