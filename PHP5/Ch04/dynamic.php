<html>
<head><title></title></head>
<body>
	<?php
	if (isset($_POST['posted'])) {
		echo "<form method='POST' action='dynamic.php'>";
		for ($counter = 0; $counter < $_POST['number']; $counter++) {
			$offset = $counter + 1;
			echo "<br>Please enter the name of child number $offset<br>";
			echo "<input name='child[]' type='text'>";
		}
		echo"<br>Press the button to move on<br>";
		echo "<input type='submit' value='Next'>";
		echo "<input type='hidden' name='posted01' value='true'></form>";
	} else {
		if (isset($_POST['posted01'])) {
			$count=0;
			echo "Your children's names are:";
			do {
				$childs_name = $_POST['child'][$count];
				echo"<br><b>$childs_name</b>";
				$checkempty = $childs_name;
				$count = $count + 1;
			} while ($checkempty != "");
			if ($count == 1) {
				echo "Not applicable";
			}
		}
	?>
		<hr>
		<form method="POST" action="dynamic.php">
			<input type="hidden" name="posted" value="true">
			How many children do you have?
			<input name="number" type="text">
			<br>
			<br>
			<input type="submit" value="Send Number">
			<br>
		</form>
	<?php
	}
	?>
</body>
</html>
