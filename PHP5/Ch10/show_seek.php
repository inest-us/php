<?php
include "./common_db.inc";

$link_id = db_connect('sample_db');
$result = mysql_query("SELECT * FROM user;", $link_id);

for($i = mysql_num_rows($result)-1; $i >=0; $i--){

mysql_data_seek($result, $i);
$query_data = mysql_fetch_array($result);

echo "'", $query_data["userid"], "' is also known as ",
          $query_data["username"], "<P>";
}
?>
