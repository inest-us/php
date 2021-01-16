<?php
   $_SESSION['view1count'] = "0";
   $_SESSION['view2count'] = "0";
   $_SESSION['view3count'] = "0";
   $_SESSION['view4count'] = "0";
?>
<?php
   // The rest of the script illustrates how to make hyperlinks that hand PHP what it needs to access your session data - namely, SID.
   echo "<html><head><title>Web Page Hit Counter</title></head><body>";
   if (isset($_GET['whichpage'])) {
      echo "<b>You are currently on page $_GET[whichpage].</b><br><br>\n";
      $_SESSION["view" . $_GET['whichpage'] . "count"]++;
   }

   for ($i = 1; $i <= 4; $i++) {
      if (isset($_GET['whichpage']) == $i) {
         echo "<b><a href=\"sessions.php?".session_id()."&whichpage=$i\">Page $i</a></b>";
      } else {
         echo "<a href=\"sessions.php?".session_id()."&whichpage=$i\">Page $i</a>";
      }
      if (!isset($_SESSION["view".$i."count"])) {
         $_SESSION["view".$i."count"] = 0;
      }
      echo ", which you have chosen ".$_SESSION["view".$i."count"]." times.<BR>\n";
   }
   echo "\n\n<br><br>\n\n";
   echo "</body></html>";
?>
