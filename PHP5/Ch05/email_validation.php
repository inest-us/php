<html>
<head><title></title></head>
<body>
<?php
//email_validation.php
if (isset($_POST['posted'])) {

   $email = $_POST['email'];
   $theresults = ereg("^[^@ ]+@[^@ ]+\.[^@ \.]+$", $email, $trashed);
   if ($theresults) {
      $isamatch = "Valid";
   } else {
      $isamatch = "Invalid";
   }

   echo "Email address validation says $email is " . $isamatch;
}

?>
<form action="email_validation.php" method="POST">
<input type="hidden" name="posted" value="true">
Enter your email address for validation:
<input type="text" name="email" value="name@example.com">
<input type="submit" value="Validate">
</form>
</body>
</html>
