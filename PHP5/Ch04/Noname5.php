<?php
   $phone_directory = array ("John Doe" => array("1 Long Firs Drive", "777-000-000"),
                             "Jane Doe" => array("4 8th and East", "777-111-111"));
   while (list($person) = each($phone_directory)) {
      echo("$person<br />");
      while (list(,$personal_details) = each ($phone_directory[$person]))   {
         echo (" $personal_details<br />");
      }
   }
?>