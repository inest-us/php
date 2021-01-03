<html>
<head><title></title></head>
<body>
<b>Namllu credit bank loan form</b>

<?php
	if (isset($_POST['posted'])) {
	$duration = 0; 
	switch ($_POST['loan']) {
	case "1000";
	   $interest = 5;
	   break;
	case "5000";
	   $interest = 6.5;
	   break;
	case "10000";
	   $interest = 8;
	   break;
	default:
	   echo "You didn't enter a loan package!<hr>";
	   exit;
	}
	while ($_POST['loan'] > 0) 
	{
	   $duration = $duration + 1;
	   $monthly = $_POST['month'] - ($_POST['loan']*$interest/100);
	   if ($monthly <= 0) 
	   { 
	      echo "You need larger repayments to pay off your loan!<hr>";
	      exit;
	   }
	$_POST['loan'] = $_POST['loan'] - $monthly;	
	}
	echo "This would take you $duration months to pay this off at the interest rate of $interest percent.<hr>";

}
?>
<form method="POST" action="loan.php">
<input type="hidden" name="posted" value="true">
<br>
How much do you want to borrow?<br><br>
<input name="loan" type="radio" value="1000">our $1,000 package at 5.0% interest
<br>
<input name="loan" type="radio" value="5000">our $5,000 package at 6.5% interest
<br>
<input name="loan" type="radio" value="10000">our $10,000 package at 8.0% interest
<br>
<br>
How much do you want to pay a month?
<input name="month" type="text" size="5">
<br>
<br>
<input type="submit" value="Calculate">
</form>
</body>
</html>
