<?php
include "common_db.inc";
$link_id = db_connect();
$result = mysql_db_query("sample_db", "SHOW TABLES");
while($query_data = mysql_fetch_row($result)) {
echo $query_data[0],"<P>";
}
?>