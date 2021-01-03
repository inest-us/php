<html>
<head><title></title></head>
<body>
<b>Namllu holiday booking form</b>
<br>
<br>
<?php
if (isset($_POST['posted'])) {

	$price = 500;
	$starmodifier = 1;
	$citymodifier = 1;
	$destination = $_POST['destination'];
	$destgrade = $_POST['destination'] . $_POST['grade'];
	switch($destgrade) {
		case "Barcelonathree":
			$citymodifier = 2;$price = $price * $citymodifier; 
		echo "The cost for a week in $destination is $price";
			break;
		case "Barcelonafour":
			$citymodifier = 2;$starmodifier = 2;
		$price = $price * $citymodifier * $starmodifier;
			echo "The cost for a week in $destination is $price";
			break;
		case "Viennathree":
			$citymodifier = 3.5;
			$price = $price * $citymodifier;
			echo "The cost for a week in $destination is $price";
			break;
		case "Viennafour":
			$citymodifier = 3.5;
			$starmodifier = 2;
			$price = $price * $citymodifier * $starmodifier;
			echo "The cost for a week in $destination is $price";
			break;
		case "Praguethree": 
			$price = $price * $citymodifier;
			echo "The cost for a week in $destination is $price";
			break;
		case "Praguefour": 
			$starmodifier = 2;
			$price = $price * $citymodifier * $starmodifier;
			echo "The cost for a week in $destination is $price";
			break;
		default:
			echo ("Go back and do it again");
			break; 
	}
}
?>
<form method="POST" action="holiday.php">
<input type="hidden" name="posted" value="true">
Where do you want to go on holiday?
<br>
<br>
<input name="destination" type="radio" value="Prague">
Prague
<br>
<input name="destination" type="radio" value="Barcelona">
Barcelona
<br>
<input name="destination" type="radio" value="Vienna">
Vienna
<br>
<br>
What grade of hotel do you want to stay at?
<br>
<br>
<input name="grade" type="radio" value="three">
Three star
<br>
<input name="grade" type="radio" value="four">
Four star
<br>
<br>
<input type="submit" value="Book Now">
</form>
</body>
</html>
