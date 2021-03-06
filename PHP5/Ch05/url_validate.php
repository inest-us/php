<html>
<html>
<head>
    <title>Url Validation</title>
</head>
<body>
<?php
   //url_validate.php
   $url = $_POST['url'];
   if(preg_match( '/^(http|https):\\/\\/[a-z0-9]+([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$url)) {
      $isamatch = "Valid";
   } else {
      $isamatch = "Invalid";
   }
   echo "URL validation says $url is " . $isamatch;
?>
</body>
</html>
