<?php
//dir_list.php
$default_dir = “/Inetpub/wwwroot/beginning_php5/ch07";
if(!($dp = opendir($default_dir))) die("Cannot open $default_dir.");
while($file = readdir($dp)) 
   if($file != '.' && $file != '..') echo "$file<br>";
closedir($dp);
?>
