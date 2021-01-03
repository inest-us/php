<?php
include "./common_db.inc";
$link_id = db_connect();
mysql_select_db("sample_db");

$query = "SHOW COLUMNS FROM user LIKE 'userposition'";
$result = mysql_query($query);
$query_data = mysql_fetch_array($result);

if(eregi("('.*')", $query_data["Type"], $match)) {

   $enum_str = ereg_replace("'", "", $match[1]);
   $enum_options = explode(',', $enum_str);
}
echo "ENUM options with the default value:<BR>";
foreach($enum_options as $value) echo "-$value<BR>";
echo "<BR>Default Value: <b>$query_data[Default]</b>";
echo "<P>";

?>
