<?php
   header("Content-Type: text/xml\n\n");

   require_once 'MP3/Id.php';
   
   static $strMyMP3Directory = "C:\My Shared Folder";
   $objDir = dir($strMyMP3Directory);
   $intNumFiles = 0;
   $arMP3Files = Array();
   
   // Loop through all the files we've found and put them into an array
   while (false !== ($strEntry = $objDir->read())) {
      // Check this is actually an MP3 file, and not a directory entry or similar!
      if (eregi("\.mp3$", $strEntry)) {
         $arMP3Files[] = $strMyMP3Directory . "/" . $strEntry;
      };
   };

   // Instantiate our MP3_ID Class
   $objMP3ID = new MP3_Id();
   
   // Set up an array of unique artists
   $arArtists = Array();
   $arTestArtists = Array();
   for ($i=0; $i<=sizeof($arMP3Files)-1; $i++) {
      $strPath = $arMP3Files[$i];
      $intResult = $objMP3ID->read ($strPath);
      $strArtist = $objMP3ID->getTag ("artists", "Unknown Artist");
      $strTestArtist = strtoupper(preg_replace("/[^A-Za-z0-9]/", "", $strArtist));
      // Check to see if this artist (when uncommon characters are made irrelevant and all letters are capitalised) is in our array of artists - if not, add them
      if (in_array($strTestArtist, $arTestArtists) == false) {
         array_push($arArtists, $strArtist);
         // Note we use the original spacing and capitalisation for our addition to $arArtists ...
         array_push($arTestArtists, $strTestArtist);
      };
   };
   
   // For each artist, create an array containing all the song filenames written by that artist, and their titles
   $arTracks = Array();
   // We'll also create an array of all the song indices we've already accounted for, to save reading their details more than once
   $arAlreadyAccountedForSongIndices = Array();
   for ($i=0; $i<=sizeof($arArtists)-1; $i++) {
      $strArtistName = $arArtists[$i];
      $strTestArtistName = $arTestArtists[$i];
      $arTracks[$strArtistName] = Array();
      // See which songs are written by this artist
      for ($j=0; $j<=sizeof($arMP3Files)-1; $j++) {
         if (in_array($j, $arAlreadyAccountedForSongIndices) == false) {
            $strPath = $arMP3Files[$j];
            $intResult = $objMP3ID->read ($strPath);
            $strThisArtist = $objMP3ID->getTag ("artists", "Unknown Artist");
            $strThisTestArtist = strtoupper(preg_replace("/[^A-Za-z0-9]/", "", $strThisArtist));
            if ($strThisTestArtist == $strTestArtistName) {
               // This song is indeed by the artist we're testing, so slap its index into $arAlreadyAccountedForSongIndices so we won't ever test it again
               array_push($arAlreadyAccountedForSongIndices, $j);
               // Get its title and request link and push them into a temporary hash
               $arSongHash["TITLE"] = $objMP3ID->getTag ("name", "Unknown Title");
               $strSongFilename = str_replace("$strMyMP3Directory" . "/", "", $arMP3Files[$j]);
               // Create a link based on the filename by making the filename URL friendly using urlencode
               $arSongHash["LINK"] = "radiorequest.php?requestfile=" . urlencode($strSongFilename);
               // Push this hash as the result of the next available index of $arTracks[name of artist]
               array_push($arTracks[$strArtistName], $arSongHash);   
            };
         };
      };
   };
   
   // Sort this hash by artist name, ascending A-Z - use ksort rather than asort to sort by key
   ksort($arTracks);
   
   // Now output this in the appropriate XML format
?>
<treemenu>
<?php foreach ($arTracks as $artist_name => $arHash) { ?>
   <node text="<?=$artist_name?>" icon="images\folder.gif">
<?php for ($i=0; $i<=sizeof($arHash)-1; $i++) { ?>
     <node text="<?=htmlentities($arHash[$i]["TITLE"])?>" icon="images\document.gif" link="<?=htmlentities($arHash[$i]["LINK"])?>" />
<?php }; ?>
   </node>
<?php }; ?>
</treemenu>
