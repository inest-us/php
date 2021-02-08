<html>
<head>
	<title>State Capitals</title>
</head>
<body>
	<?php
		if (isset($_POST['posted'])) {
            $state_capital_2 = array (
                "Alabama" => "Montgomery", 
                "Alaska" => "Juneau", 
                "Arizona" => "Phoenix", 
                "Arkansas" => "Little Rock", 
                "California" => "Sacramento",
				"Colorado" => "Denver",
				"Connecticut" => "Hartford", 
				"Delaware" => "Dover",
				"Florida" => "Tallahasse", 
				"Georgia" => "Atlanta", 
				"Hawaii" => "Honolulu", 
				"Idaho" => "Boise", 
				"Illinois" => "Springfield",
				"Indiana" => "Indianapolis", 
				"Iowa" => "Des Moines", 
				"Kansas" => "Topeka", 
				"Kentucky" => "Frankfort", 
				"Louisiana" => "Baton Rouge",
				"Maine" => "Augusta",
				"Maryland" => "Annapolis",
				"Massachusetts" => "Boston", 
				"Michigan" => "Lansing", 
				"Minnesota" => "Saint Paul",
				"Mississippi" => "Jackson", 
				"Missouri" => "Jefferson City", 
				"Montana" => "Helena",
				"Nebraska" => "Lincoln", 
				"Nevada" => "Carson City",
				"New Hampshire" => "Concord", 
				"New Jersey" => "Trenton",
				"New Mexico" => "Santa Fe", 
				"New York" => "Albany", 
				"North Carolina" => "Raleigh",
				"North Dakota" => "Bismarck",
				"Ohio" => "Columbus",
				"Oklahoma" => "Oklahoma City", 
				"Oregon" => "Salem", 
				"Pennsylvania" => "Harrisburg", 
				"Rhode Island" => "Providence", 
				"South Carolina" => "Columbia",
				"South Dakota" => "Pierre", 
				"Tennessee" => "Nashville", 
				"Texas" => "Austin",
				"Utah" => "Salt Lake City", 
				"Vermont" => "Montpelier",
				"Virginia" => "Richmond",
				"Washington" => "Olympia",
				"West Virginia" => "Charleston", 
				"Wisconsin" => "Madison",
				"Wyoming" => "Cheyenne");
			$state = $_POST[state];
			$capital = $state_capital_2[$state];
			echo "The state capital of $_POST[state] is <b>$capital</b><hr>";
		}
	?>
	<form action="capitalsV2.php" method="POST">
		<input type="hidden" name="posted" value="true">
		What state do you want to know the capital of?
		<select name="state">
		<?php
			$states_of_the_USA = array (0 => "Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming");
			for ($counter = 0; $counter < 50; $counter ++) {
				echo"<option>$states_of_the_USA[$counter]</option>"; 
			}
			echo "</select><br><br>";
		?>
		<input type="submit" value="Find Capital">
	</form>
</body>
</html> 
