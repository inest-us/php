<?php
$counter_file = "./count.dat";
if(file_exists($counter_file)){
   $date_str = getdate(fileatime($counter_file));
   $year = $date_str["year"];
   $mon = $date_str["mon"];
   $mday = $date_str["mday"];
   $hours = $date_str["hours"];
   $minutes = $date_str["minutes"];
   $seconds = $date_str["seconds"];
   
   $date_str = "$hours:$minutes:$seconds $mday/$mon/$year";

   if(!($fp = fopen($counter_file, "r+"))){
      die("Cannot open $counter_file");
   }


   $counter = (int) fread($fp, filesize($counter_file));
   $counter++;

   echo "You're visitor No. $counter.";
   echo "The last access was made at $date_str";
   rewind($fp);
}else{
   if(!($fp = fopen($counter_file, "w"))){
      die("Cannot open $counter_file");
   }
   $counter = 1;
   echo "You're visitor No. $counter.";
}   

fwrite($fp, $counter);
fclose($fp);
?>
