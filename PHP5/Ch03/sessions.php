<?php

session_register('view1count');
session_register('view2count');
session_register('view3count');
session_register('view4count');
?>
<?php

//The rest of the script illustrates how to make hyperlinks that hand PHP what it needs to access your session data - namely, SID.
echo "<html><head><title>Web Page Hit Counter</title></head><body>";
if (isset($_GET['whichpage'])) {
   echo "<b>You are currently on page $_GET[whichpage].</b><br><br>\n";
  $_SESSION["view".$_GET['whichpage']."count"]++;
}

for ($i = 1; $i <= 4; $i++) {
   if (isset($_GET['whichpage']) == $i) {
      echo "<b><a href=\"sessions.php?".session_id()."&whichpage=$i\">Page $i</a></b>";
   } else {
      echo "<a href=\"sessions.php?".session_id()."&whichpage=$i\">Page $i</a>";
   }
if (!isset($_SESSION["view".$i."count"])) $_SESSION["view".$i."count"] = 0;
   echo ", which you have chosen ".$_SESSION["view".$i."count"]." times.<BR>\n";
}
echo "\n\n<br><br>\n\n";
echo "</body></html>";

?>
