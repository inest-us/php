<?php
include "./common_db.inc";

$link_id = db_connect('sample_db');
 

$result = mysql_query("SELECT * FROM user", $link_id);

while($query_data = mysql_fetch_row($result)) {
echo "'",$query_data[1],"' is a ",$query_data[4],"<br>";
}
?>
