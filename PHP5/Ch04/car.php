<html>
<head><title></title></head>
<body>
<b>Namllu car hire company</b>
<?php
if (isset($_POST['posted'])) { 

	if ($_POST['age'] > 20 and $_POST['license'] == "on") {
		echo ("Your car hire has been accepted.<hr>");
	}

	if ($_POST['age'] < 21 or $_POST['license'] == "") {
		echo ("Unfortunately we cannot hire a car to you.<hr>");
	}
}
?>
<form method="post" action="car.php">
<input type="hidden" name="posted" value="true">
First name:
<input name="first_name" type="text">
Last name:
<input name="last_name" type="text">
age:
<input name="age" type="text"size="3">
<br>
<br>
Address:
<textarea name="address" rows=4 cols=40>
</textarea>
<br>
<br>
Do you hold a current driving license?
<input name="license" type="checkbox">
<br>
<br> 
<input type="submit" value="Submit application">
</form>
</body>
</html>
