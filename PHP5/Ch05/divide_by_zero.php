<html>
<head><title></title></head>
<body>
<b>Divide Any Number (except zero)</b>
<br>
<br>
<?php
if (isset($_POST['posted'])) {

   $first_number = $_POST['first_number'];
   $second_number = $_POST['second_number'];
   $answer = $first_number / $second_number;
   echo "Your answer is " . $answer . "<br>";

}
?>

<form method="POST" action="divide_by_zero.php">
<input type="hidden" name="posted" value="true">
Please enter the first number:
<br>
<br>
<input name="first_number" type="text" value="0"><br>
Please enter the second number:
<br>
<br>
<input name="second_number" type="text" value="0"><br>
Divide when ready!
<br>
<br>
<input type="submit" value="Divide">
</form>
</body>
</html>
