<?php

function error_message($msg) {
   echo "<script>alert(\"$msg\"); history.go(-1)</script>";
   exit;
}

function date_str($timestamp) {
   $date_str = getdate($timestamp);
   $year = $date_str["year"];
   $mon = $date_str["mon"];
   $mday = $date_str["mday"];
   $hours = $date_str["hours"];
   $minutes = $date_str["minutes"];
   $seconds = $date_str["seconds"];
   
   return "$hours:$minutes:$seconds $mday/$mon/$year";
}


function file_info($file) {
   global $text_file_array;
   $file_info_array["filesize"] = number_format(filesize($file)) . " bytes.";
   $file_info_array["filectime"] = date_str(filectime($file));
   $file_info_array["filemtime"] = date_str(filemtime($file));
   if(!isset($_ENV['WINDIR'])) {
      $file_info_array["fileatime"] = date_str(fileatime($file));
      $file_info_array["filegroup"] = filegroup($file);
      $file_info_array["fileowner"] = fileowner($file);
   } else {
      $file_info_array["fileatime"] = "not available";
      $file_info_array["filegroup"] = "not available";
      $file_info_array["fileowner"] = "not available";
   }

   $extension = array_pop(explode(".", $file));

   if (in_array($extension, $text_file_array)) {
	$file_info_array["filetype"] = "text";
   } else {
	$file_info_array["filetype"] = "binary";
   }

   return $file_info_array;
}

//specify the file extensions to handle
$text_file_array = array( "txt", "htm", "html", "php", "inc", "dat" );


?>