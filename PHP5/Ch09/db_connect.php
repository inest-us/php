<?php
$link_id = mysql_connect("localhost", "phpuser", "phppass");
$result = mysql_list_dbs($link_id);

while($db_data = mysql_fetch_row($result)) {
        echo $db_data[0]. "<BR>";
        $result2 = mysql_list_tables($db_data[0]);
        $num_rows = mysql_num_rows($result2);
        while($table_data = mysql_fetch_row($result2)) {
           echo "--" . $table_data[0]. "<BR>";
         }
        echo "==> $num_rows table(s) in " . $db_data[0] . "<P>";
}
?>
