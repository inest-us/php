<?php
include "./common_db.inc";
$link_id = db_connect();
$result = mysql_list_fields("sample_db", "user", $link_id);

for($i=0; $i < mysql_num_fields($result); $i++ ) {
   $field_info_object = mysql_fetch_field($result, $i);
   
echo $field_info_object->name . "(" .
        mysql_field_len($result, $i) . ")";

      
   echo " - " . $field_info_object->type;
   
if($field_info_object->def) echo "<br><b>Default Value: 
  $field_info_object->def</b> ";
   
if($field_info_object->not_null) echo " not_null ";
   else " null ";
   
   if($field_info_object->primary_key) echo " primary_key ";
   else if($field_info_object->multiple_key) echo " key ";
   else if($field_info_object->unique_key) echo " unique ";
   
   if($field_info_object->unsigned) echo " unsigned ";
   
   if($field_info_object->zerofill) echo " zero-filled ";
   
   echo "<BR>";
}
?>
