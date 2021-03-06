<html>
<head>
	<title>Loan</title>
</head>
<body>
<b>Namllu credit bank loan form</b>
<?php
	$age = $_POST['age']; 
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$address = $_POST['address'];
	$loan = $_POST['loan'];
	$month = $_POST['month'];

	//validation
	if ($age < 10 OR $age > 130) {
		echo "Incorrect Age entered - Press back button to try again";
		exit;
	}
	if ($first_name == "" or $last_name == "") {
		echo "You must enter your name - Press back button to try again";
		exit;
	}
	if ($address == "") {
		echo "You must enter your address - Press back button to try again";
		exit;
	}
	if ($loan != 1000 and $loan != 5000 and $loan != 10000) {
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
	while ($loan > 0) {
	   $duration = $duration + 1;
	   $monthly = $month - ($loan * $interest / 100);
	   if ($monthly <= 0) { 
	      echo "You need larger repayments to pay off your loan!<hr>";
	      exit;
	   }
		$loan = $loan - $monthly;	
	}
	echo "This would take you $duration months to pay this off at the interest rate of $interest percent.<hr>";
?>
</body>
</html>
