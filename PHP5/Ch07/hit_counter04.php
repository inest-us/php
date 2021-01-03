<?php
//hit_counter04.php
$counter_file = "./count.dat";
if(!($fp = fopen($counter_file, "r"))) die ("Cannot open $counter_file.");
while(!feof($fp)) $counter .= fgetc($fp);
$counter = (int) $counter;
fclose($fp);

$counter++;

echo "You're visitor No. $counter.";

$fp = fopen($counter_file, "w");
fwrite($fp, $counter);
fclose($fp );
?>
