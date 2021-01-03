<html>
<head><title></title></head>
<body>
<b>Namllu credit bank loan form</b>
<?php
if (isset($_POST['posted'])) {

	$age = $_POST['age']; 
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$address = $_POST['address'];
	$loan = $_POST['loan'];
	$month = $_POST['month'];

	//validation
	if ($age < 10 OR $age > 130)
	{
		echo "Incorrect Age entered - Press back button to try again";
		exit;
	}
	if ($first_name == "" or $last_name == "")
	{
		echo "You must enter your name - Press back button to try again";
		exit;
	}
	if ($address == "")
	{
		echo "You must enter your address - Press back button to try again";
		exit;
	}
	if ($loan != 1000 and $loan != 5000 and $loan != 10000)
	{
		echo "You must enter a loan value - Press back button to try again";
		exit;
	}

	$duration = 0; 
	switch ($loan) {
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
	while ($loan > 0) 
	{
	   $duration = $duration + 1;
	   $monthly = $month - ($loan * $interest / 100);
	   if ($monthly <= 0) 
	   { 
	      echo "You need larger repayments to pay off your loan!<hr>";
	      exit;
	   }
	$loan = $loan - $monthly;	
	}
	echo "This would take you $duration months to pay this off
 at the interest rate of $interest percent.<hr>";

}
?>
<form method="POST" action="loan_fv.php">
<input type="hidden" name="posted" value="true">
<br>
First Name:
<input name="first_name" type="text">
Last Name:
<input name="last_name" type="text">
Age:
<input name="age" type="text" size="3">
<br>
<br>
Address:
<textarea name="address" rows="4" cols="40">
</textarea>
<br>
<br>
What is your current salary?
<select name="salary">
<option value=0>Under $10000</option>
<option value=10000>$10,000 to $25,000</option>
<option value=25000>$25,000 to $50,000</option>
<option value=50000>Over $50,000</option>
</select>
<br>
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
