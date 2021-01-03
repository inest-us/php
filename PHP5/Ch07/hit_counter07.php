<?php
$counter_file = "./count.dat";
if(!($fp = fopen($counter_file, "r"))){
   die ("Cannot open $counter_file.");
}
$counter = (int) fread($fp, 20);
fclose($fp);

$counter++;

if(!($fp = fopen($counter_file, "w"))){
   die ("Cannot open $counter_file.");
}
fwrite($fp, $counter);
fclose($fp);

if(!($fp = fopen($counter_file, "r"))){
   die ("Cannot open $counter_file.");
}
echo "You're visitor No. ";
fpassthru($fp);
?>
