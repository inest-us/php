<html>
<head></head>
<body>
<?php
//url_validate.php
if (isset($_POST['posted'])) {
   $url = $_POST['url'];
   $theresults = ereg("^[a-zA-Z0-9]+://[^ ]+$", $url, $trashed);
   if ($theresults) {
      $isamatch = "Valid";
   } else {
      $isamatch = "Invalid";
   }
   echo "URL validation says $url is " . $isamatch;
}
?>
<form action="url_validate.php" method="POST">
<input type="hidden" name="posted" value="true">
Enter your URL for validation:
<input type="text" name="url" value="http://www.example.com" size="30">
<input type="submit" value="Validate">
</form>
</body>
</html>
