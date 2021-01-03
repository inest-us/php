<?php
   static $strMyMP3Directory = "C:\My Shared Folder";
   static $strMyDJsEmailAddress = "dlmercer@hotmail.com";

   // Require our necessary PEAR objects
			require_once('HTML/TreeMenu.php');
			require_once('xmlhtmltree.phpm');			
			
   // Define XML URL for retrieval and retrieve it - you can modify this if you have the XML generator on another server!
   $strXMLURL = "http://" . $_SERVER["SERVER_NAME"] . str_replace("request", "generatexml", $_SERVER["SCRIPT_NAME"]);
   
   $strXML = implode (false, file($strXMLURL));
   

	    $objXMLTree = new XMLHTMLTree("", $strXML);
	    $objXMLTree->GenerateHandOffs();
	    $objXMLTree->ParseXML();
	    $objTreeMenu = $objXMLTree->GetTreeHandoff();
   
   // Let's see if we've made a request - if we do, we should alter our output slightly
   $requestMade = false;
   $requestSuccessful = false;
 
if (!empty($_GET['requestfile'])) {
      $requestMade = true;
      // Get the filename
          $strRequestFilename = $_GET['requestfile'];
      // Check this file actually exists
      $strFullPath = $strMyMP3Directory . "/" . $strRequestFilename;
    }
      if (@filesize($strFullPath) > 0) {
         $requestSuccessful = true;
         // It's all worked - let's email the DJ
         mail($strMyDJsEmailAddress, "New song request", "A request has been made for: " . $strFullPath);
      } else {
         $requestSuccessful = false;
      }

?>
<HTML>
   <HEAD>
      <SCRIPT LANGUAGE="Javascript" SRC="TreeMenu.js"></SCRIPT>
   </HEAD>
   <BODY>
      <H1>Radio PHP</H1>
      <?php
         if ($requestMade) {
      ?>
      <B>Thanks for your request!</B>
      <BR><BR>
         <?php
            if ($requestSuccessful) {
         ?>
            You'll be pleased to hear your request was successful, and we'll try and play your song as soon as we can.
         <?php
            } else {
         ?>
            Unfortunately we weren't able to play the song you requested. We may have just recently removed it from our collection. Please feel free to try again!         
         <?php
            };
         ?>
      <BR><BR>
      <?php
         };
      ?>
      <?php
         if (!($requestSuccessful)) {
      ?>      
         Request your song from our list below and it will be emailed to our DJ - if we've not played it too recently we'll try and incorporate it for you as soon as we can!
         <HR>
         <?php
            $objTreeMenu->printMenu();
         ?>
      <?php
         };
      ?>      
   </BODY>
</HTML>
