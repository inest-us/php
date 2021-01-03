<html>
<head><title></title></head>
<body>
<?php
if (isset($_POST['posted'])) {
	$count=2; 
	do 
	{
	   $remainder = $_POST['guess'] % $count;
	   $count = $count + 1;
	} while ($remainder != 0 and $count < $_POST['guess']);
	if (($count < $_POST['guess']) || ($_POST['guess'] == 0)) {
	   echo ("Your number is not prime<hr>");
	} else {
	   echo ("Your number is prime<hr>");
	}
}
?>
<form method="POST" action="check.php">
<input type="hidden" name="posted" value="true">
What is your number:
<input name="guess" type="text">
<br>
<br>
<input type="submit" value="Check if number is prime">
<br>
</form>
</body>
</html>
