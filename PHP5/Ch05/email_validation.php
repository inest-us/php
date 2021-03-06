<html>
<head>
   <title>Email validation</title>
</head>
<body>
<?php
   //email_validation.php
   $email = $_POST['email'];
   $theresults = preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i', $email);
   if ($theresults) {
      $isamatch = "Valid";
   } else {
      $isamatch = "Invalid";
   }
   echo "Email address validation says $email is " . $isamatch;
?>
</body>
</html>
