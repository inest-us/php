<?php
$counter_file = "./count.dat";
if(!($fp = fopen($counter_file, "r"))){
   die ("Cannot open $counter_file.");
}
$counter = (int) fread($fp, 20);
fclose($fp);

$counter++;

echo "You're visitor No. $counter.";

$fp = fopen($counter_file, "w");
fwrite($fp, $counter);
fclose($fp);
?>
