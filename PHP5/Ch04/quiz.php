<html>
<head><title></title></head>
<body>
<?php
if (isset($_POST['posted'])) { 
	if ($_POST['question1'] == "Lisbon") {
		echo "You are correct, $_POST[question1] is the right answer<hr>";
	}

	if ($_POST['question1'] != "Lisbon") {
		echo "You are incorrect, $_POST[question1] is not the right answer<hr>";
	}
}
?>
<form method="POST" action="quiz.php">
<input type="hidden" name="posted" value="true">
What is the capital of Portugal?
<br>
<br>
<input name="question1" type="radio" value="Porto">
Porto
<br>
<input name="question1" type="radio" value="Lisbon">
Lisbon
<br>
<input name="question1" type="radio" value="Madrid">
Madrid
<br>
<br>
<input type="submit">
</form>
</body>
</html>
