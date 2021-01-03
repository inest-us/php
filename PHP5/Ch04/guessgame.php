<html>
<head><title></title></head>
<body>
<?php 
if (isset($_POST['posted'])) {
	$number = rand(1,10);   
	if ($_POST['guess'] > $number) {
		echo "<h3>Your guess is
		 too high</h3>";
		echo "<br>The number is
		 $number, you don't win, please play again<hr>";
	} else if ($_POST['guess'] < $number) {
		echo "<h3>Your guess is too low</h3>";
		echo "<br>The number is
		 $number, you don't win, please play again<hr>";
	} else {
		echo "<br>The number is
		 $number, you win, please play again<hr>";
	}
}
?>
<form method="POST" action="guessgame.php">
<input type="hidden" name="posted" value="true">
What number between 1 and 10 am I thinking of?
<input name="guess" type="text">
<br>
<br>
<input type="submit" value="Submit">
</form>
</body>
</html>
