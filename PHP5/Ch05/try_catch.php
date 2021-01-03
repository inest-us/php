<html>
<head><title>Beginning PHP5</title></head>
<body bgcolor="#FFFFFF">
<?php
if (isset($_POST['posted'])) {

   //put the submitted values into regular variables

   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $birth_date = $_POST['birth_date'];
   $phone = $_POST['phone'];
   $age = $_POST['age'];
   $address = $_POST['address'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $postal_code = $_POST['postal_code'];

	//make an array of field names and data types

	$field_names = array("first_name" => "string",
				"last_name" => "string",
				"birth_date" => "date",
				"phone" => "string",
				"age" => "integer",
				"address" => "string",
				"city" => "string",
				"state" => "string",
				"postal_code" => "string");

	//try checking the data type of each submitted value based on the name of the field

	function form_validate($fns) {

		foreach ($fns as $key => $value) {

			$field_value = $key;

			global $$field_value;

			//echo "actual field value is " . $$field_value . "<br>"; 	

			switch ($value) {

				Case "string";

					if ((strlen($$field_value) < 1) or (strlen($$field_value) > 99)) {
						throw new Exception("Please enter a string value between 1 and 100 characters in the <b>$key</b> field");
					}
				
					break;

				Case "date";

					if (!ereg("^[0-9]{4}\-([1-9]|(0[1-9])|(1[0-2]))\-([1-9]|(0[1-9])|([1-2][0-9])|3[0-1])$",$$field_value)) {

						throw new Exception("Please enter a valid date formatted as YYYY-MM-DD in the <b>$key</b> field");
					}

					break;

				Case "integer";

					if (!is_numeric($$field_value)) {

						throw new Exception("Please enter a number without decimal places or alphabetical characters in the <b>$key</b> field.");
					}

					break;

				default;

					break;

			}
		}		
	}

	//catch the exception and produce an error message

	try
	{
		form_validate($field_names); 
	}

	catch (Exception $e)
	{
		echo $e -> getMessage();
		echo "<br>";
	}

}

//if no errors thank the user
 if (!is_object($e) and isset($posted)) {

	echo "Thanks for your entry. We'll be in touch.";
} else {

//return the filled out form to the user and ask them to try again

?> 
<form action="try_catch.php" method=post>
<input type="hidden" name="posted" value="true">
  <table width="50%" border="1">
    <tr> 
      <td colspan="2"><font face="Arial, Helvetica, sans-serif" size="-1">Please 
        enter contact info:</font></td>
    </tr>
    <tr> 
      <td width="26%"><font face="Arial, Helvetica, sans-serif" size="-1">First 
        Name</font></td>
      <td width="74%"> 
        <input type="text" name="first_name" value="<?php echo $first_name; ?>">
      </td>
    </tr>
    <tr> 
      <td width="26%"><font face="Arial, Helvetica, sans-serif" size="-1">Last 
        Name</font></td>
      <td width="74%"> 
        <input type="text" name="last_name" value="<?php echo $last_name; ?>">
      </td>
    </tr>
    <tr> 
      <td width="26%"><font face="Arial, Helvetica, sans-serif" size="-1">BirthDate</font></td>
      <td width="74%"> 
        <input type="text" name="birth_date" value="<?php echo $birth_date; ?>">
      </td>
    </tr>
    <tr> 
      <td width="26%"><font face="Arial, Helvetica, sans-serif" size="-1">Phone 
        Number</font></td>
      <td width="74%"> 
        <input type="text" name="phone" value="<?php echo $phone; ?>">
      </td>
    </tr>
    <tr> 
      <td width="26%"><font face="Arial, Helvetica, sans-serif" size="-1">Age</font></td>
      <td width="74%"> 
        <input type="text" name="age" value="<?php echo $age; ?>">
      </td>
    </tr>
    <tr> 
      <td width="26%"><font face="Arial, Helvetica, sans-serif" size="-1">Address</font></td>
      <td width="74%"> 
        <input type="text" name="address" value="<?php echo $address; ?>">
      </td>
    </tr>
    <tr> 
      <td width="26%"><font face="Arial, Helvetica, sans-serif" size="-1">City</font></td>
      <td width="74%"> 
        <input type="text" name="city" value="<?php echo $city; ?>">
      </td>
    </tr>
    <tr> 
      <td width="26%"><font face="Arial, Helvetica, sans-serif" size="-1">State</font></td>
      <td width="74%"> 
        <input type="text" name="state" value="<?php echo $state; ?>">
      </td>
    </tr>
    <tr> 
      <td width="26%"><font face="Arial, Helvetica, sans-serif" size="-1">Postal 
        Code</font></td>
      <td width="74%"> 
        <input type="text" name="postal_code" value="<?php echo $postal_code; ?>">
        <input type="submit" value="Send Info" name="submit">
      </td>
    </tr>
  </table>
  </form>
<?php
}
?>

</body>
</html>
