<html>
<head></head>
<body>
<?php
print_r($_POST);
if ($_POST['posted']) { 

   $num = $_POST['num'];
   function recursion($num) {
      if ($num <= 1) {
         return 1;
      } else {
         return $num * recursion($num-1);
      }
   }
   echo "The factorial of " . $num . " is " . (recursion($num));
}
?>
<form method="POST" action="recursion.php">
<input type="hidden" name="posted" value="true">
I would like to know the factorial of 
<input name="num" type="text">
<br>
<br>
<input type="submit" value="Get Factorial">
</form>
</body>
</html>
