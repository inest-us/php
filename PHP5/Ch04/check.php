<html>
<head>
	<title>Prime number</title>
</head>
<body>
	<?php
	if (isset($_POST['posted'])) {
		$count=2;
		$number = $_POST['guess'];
		do {
			$remainder = $number % $count;
			$count = $count + 1;
		} while ($remainder != 0 and $count < $number);
		if (($count < $number) || ($number < 2)) {
			echo ("$number is NOT a prime<hr />");
		} else {
			echo ("$number is a prime<hr />");
		}
	}
	?>
	<form method="POST" action="check.php">
		<input type="hidden" name="posted" value="true">
		What is your number:
		<input name="guess" type="text">
		<br />
		<br />
		<input type="submit" value="Check if number is prime">
		<br />
	</form>
</body>
</html>
