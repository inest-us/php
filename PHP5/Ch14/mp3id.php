<?php
   require_once 'MP3/Id.php';
  
   static $MY_MP3_DIR = "C:\My Shared Folder"; # Change this to your MP3 directory!
   $objDir = dir($MY_MP3_DIR);
   $intNumFiles = 0;
   $arFileTimeHash = Array();
   # Loop through all the files we've found
   while (false !== ($strEntry = $objDir->read())) {
      # Check this is actually an MP3 file, and not a directory entry or similar!
      if (eregi("\.mp3$", $strEntry)) {
         $arFileTimeHash[$strEntry] = fileatime($MY_MP3_DIR . "/" . $strEntry);
         $intNumFiles++;
      };
   };

   # Now sort into order of date accessed and put into a traditional array structure for display later
   arsort($arFileTimeHash);
   $arFileList = Array();
   $intThisArrayIndex = 0;
   foreach ($arFileTimeHash as $strFilename => $intAccessTime){
      $arFileList[$intThisArrayIndex]["FILENAME"] = $strFilename;
      $arFileList[$intThisArrayIndex]["ACCESSED"] = $intAccessTime;
      $intThisArrayIndex ++;
   };

   # If we found more than 5 MP3s, just show the first 5
   if ($intNumFiles > 5) {
      $intNumFiles = 5;
   };
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
   <head>
      <title>My MP3 Collection</title>
   </head>
   <body>
   <H1>My MP3 Collection</H1>
   <HR>
   Here's the top 5 songs I've been listening to lately!
   <BR><BR>
   <table border="1" cellpadding="3" cellspacing="3">
      <tr>
         <td>Position</td>
         <td>Artist</td>
         <td>Name</td>
         <td>Last listened to on:</td>
      </tr>
   <?php
      $objMP3ID = new MP3_Id();
      for ($i = 0; $i<=($intNumFiles)-1; $i++) {
   ?>
      <tr>
   <?php
      $strThisFile = $arFileList[$i]["FILENAME"];
      $strPath = $MY_MP3_DIR . "/" . $strThisFile;
      $intResult = $objMP3ID->read ($strPath);
      $strArtist = $objMP3ID->getTag ("artists", "Unknown Artist");
      $strName = $objMP3ID->getTag ("name", "Unknown Track");
      $intAccessTime = $arFileList[$i]["ACCESSED"];
   ?>
         <td><?=$i+1?></td>
         <td><?=$strArtist?></td>
         <td><?=$strName?></td>
         <td><?=date("m/d/Y H:i", $intAccessTime)?></td>
      </tr>
   <?php
      };
   ?>
   </body>
</html>
