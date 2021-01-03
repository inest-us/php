<html>
<head><title></title></head>
<body>
<form method="POST" action="exam.php">
<input type="hidden" name="posted" value="true">
<table border="1">
<?php
$student = array("Albert Einstein","Ivan the Terrible","Napoleon","Simon Bolivar","Isaac Newton");
while (list(,$name) = each($student))
{
	echo "<tr><td>What grade did <b>$name</b> get in math?</td>";
	echo"<td><select name='math[]'>
		<option>grade A</option>
		<option>grade B</option>
		<option>grade C</option>
		<option>grade D</option>
		<option>grade F</option>
	</select>";
	echo"<input type='hidden' name='student[]' value='$name'></td>";
}
?>
</tr>
<tr><td>&nbsp;</td><td>
<input type="submit" value="Get Grades">
</td></tr>
</form>
</table>

<?php
if (isset($_POST['posted'])) {
?>
<hr>
<table border="1">
<tr><td colspan="2">
In math the grades were in order:
</td></tr>
<?php

	while (list($index,$value)=each($_POST['math']))
	{
	   $gradestudent[]=$_POST['math'][$index].$_POST['student'][$index];
	}
	asort($gradestudent);
	while (list($index,$value)=each($gradestudent))
	{
	   $student_index = $_POST['student'][$index];
	   $math_index = $_POST['math'][$index];
	   echo "<tr><td><b>$student_index</b></td><td>$math_index</td></tr>";
	}
}
?>
</table>
</body>
</html>
