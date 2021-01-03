<?php
$counter_file = "./count.dat";
$lines = file($counter_file);
$counter = (int) $lines[0];

$counter++;

echo "You're visitor No. $counter.";

if(!($fp = fopen($counter_file, "w"))){
   die ("Cannot open $counter_file.");
}
fwrite($fp, $counter);
fclose($fp);
?>
