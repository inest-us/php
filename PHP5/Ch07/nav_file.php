<?php
$name_field_len = 15;
$country_code_field_len = 2;
$country_field_len = 20;
$email_field_len = 30;

if(!($fp = fopen("./address.dat", "r"))){
   die ("Cannot open the address data file.");
}

do{
   $address = '';
   $field = fread($fp, $name_field_len);
   $address .= $field;

   $field = fread($fp, $country_code_field_len);
   $address .= $field;
   $field = fread($fp, $country_field_len);
   $address .= $field;
   $field = fread($fp, $email_field_len);
   $address .= $field;
   echo "$address<BR>";
}while($field);

rewind($fp);

echo "<BR>";

fseek($fp, $name_field_len);

do{
   $country_code = fread($fp, $country_code_field_len);
   fseek($fp, ftell($fp) + $country_field_len + 
                           $email_field_len +
                           $name_field_len + 2);
   //NB: change '+1' to '+2' on Win32 platforms
   echo "$country_code<BR>";
}while($country_code);

fclose($fp);
?>
