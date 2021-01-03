<?php
$counter_file = "./count.dat";
if(!($fp = fopen($counter_file, "r+"))){
   die ("Cannot open $counter_file.");
}
$counter = (int) fread($fp, 20);
$counter++;

echo "You're visitor No. $counter.";
rewind($fp);
fwrite($fp, $counter);
fclose($fp);
?>
