<?php
include "./common_db.inc";
$link_id = db_connect();
$result = mysql_list_fields("sample_db", "user", $link_id);

for($i=0; $i < mysql_num_fields($result); $i++ ) {
   echo mysql_field_name($result,$i );
   echo "(" .  mysql_field_len($result, $i) . ")";
   echo " - " . mysql_field_type($result, $i);
echo " " . mysql_field_flags($result, $i) . "<BR>";
}
?>

