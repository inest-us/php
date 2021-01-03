<html>
<head><title></title></head>
<body>

<font size=-1>
<?php
$global_message = "Global Message";
function my_function()
{
   $local_message = "Local Message";
   static $static_number = 0;
   echo "<br>the contents of global message are " . $GLOBALS["global_message"];
   echo "<br>the contents of local message are " . $local_message;
   echo "<br>the contents of static number are " . $static_number;
   return $static_number = $static_number+1;   
} 
echo "<b>Calling the function for the first time:</b>";

my_function();

echo "<br><br><b>Outside the function:</b>";
echo "<br>the contents of global message are " . $global_message;
echo "<br>the contents of local message are " . $local_message;
echo "<br>the contents of static number are " . $static_number;
echo "<br><br><b>Calling the function for the second time:</b>";

my_function();
echo "<br><br><b>Outside the function:</b>";
echo "<br>the contents of global message are " . $global_message;
echo "<br>the contents of local message are " . $local_message;
echo "<br>the contents of static number are " . $static_number;
echo "<br><br><b>Calling the function for the third time:</b>";

my_function();
echo "<br><br><b>Outside the function:</b>";
echo "<br>the contents of global message are " . $global_message;
echo "<br>the contents of local message are " . $local_message;
echo "<br>the contents of static number are " . $static_number;
?>
</font>
</body>
</html>
