<html>
<head>
	<title>State Capitals</title>
</head>
<body>
	<?php
		if (isset($_POST['posted'])) {
			$state_capital = array (0 => "Montgomery", "Juneau", "Phoenix", "Little Rock", "Sacramento","Denver","Hartford", "Dover","Tallahasse", "Atlanta", "Honolulu", "Boise", "Springfield","Indianapolis", "Des Moines", "Topeka", "Frankfort", "Baton Rouge","Augusta","Annapolis","Boston", "Lansing", "Saint Paul","Jackson", "Jefferson City", "Helena","Lincoln", "Carson City","Concord", "Trenton","Santa Fe", "Albany", "Raleigh","Bismarck","Columbus","Oklahoma City", "Salem", "Harrisburg", "Providence", "Columbia","Pierre", "Nashville", "Austin","Salt Lake City", "Montpelier","Richmond","Olympia","Charleston", "Madison","Cheyenne");
			for ($counter=0; $counter<50; $counter++) {
				if($_POST['hiddenstate'][$counter] == $_POST['state']) {
					echo "The state capital of $_POST[state] is <b>$state_capital[$counter]</b><hr>";
				}
			}
		}
	?>
	<form action="capitals.php" method="POST">
		<input type="hidden" name="posted" value="true">
		What state do you want to know the capital of?
		<select name="state">
		<?php
			$states_of_the_USA = array (0 => "Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming");
			for ($counter = 0; $counter < 50; $counter ++) {
				echo"<option>$states_of_the_USA[$counter]</option>"; 
			}
			echo "</select><br><br>";
			for ($counter = 0; $counter < 50; $counter++) {
				echo"<input type='hidden' name='hiddenstate[]' value='$states_of_the_USA[$counter]'>";
			}
		?>
		<input type="submit" value="Find Capital">
	</form>
</body>
</html> 
