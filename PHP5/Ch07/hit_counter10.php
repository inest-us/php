<?php
$counter_file = "./count.dat";
if(file_exists($counter_file)){
   if(!($fp = fopen($counter_file, "r+"))){
      die("Cannot open $counter_file");
   }
   $counter = (int) fread($fp, filesize($counter_file));
   $counter++;
   rewind($fp);
}else{
   if(!($fp = fopen($counter_file, "w"))){
      die("Cannot open $counter_file");
   }
   $counter = 1;
}

echo "You're visitor No. $counter.";

fwrite($fp, $counter);
fclose($fp);
?>
