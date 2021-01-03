<?php
//cookies.php
if (!empty($_POST['type_sel'])) {
$type = $_POST['type_sel'];

   setcookie("Type", $type, time()+3600);
}

if (!empty($_POST['size_sel'])) {
$size = $_POST['size_sel'];
   setcookie("Size", $size, time()+3600);
}

//We define some options for font size and typeface, and as it's now safe to add an //HTML header, we do so:
$type = array("arial", "helvetica", "sans-serif", "courier");
$size = array("1","2","3","4","5","6","7");
echo "<html><head><title>Cookie Test</title></head><body><div align='center'>";

//The following form contains a pair of listboxes, which can be used to specify the //user's preferences:
echo "<form method='POST'>";
echo "What font type would you like to use? ";
echo "<select name='type_sel'>";
echo "<option selected value=''>default</option>";
foreach ($type as $var) {
   echo "<option>$var</option>";
}
echo "</select><br><br>";
echo "What font size would you like to use? ";
echo "<select name='size_sel'>";
echo "<option selected value=''>default</option>";

foreach ($size as $var) {
   echo "<option>$var</option>";
}
echo "</select><br><br>";
echo "<input type='submit'>";
echo "</form>";

//Finally, we echo out some useful information, and format it using appropriate //settings:
echo "<b>Your cookies say:</b><br>";
echo "<font ";
if (isset($_COOKIE['Type'])) {
echo "face='$_COOKIE[Type]' ";
}

if (isset($_COOKIE['Size'])) {
 echo "size='$_COOKIE[Size]' ";
}
echo ">";
if (isset($_COOKIE['Type']))
echo "Type = $_COOKIE[Type]";
echo"<br>";
if (isset($_COOKIE['Size']))
echo "Size = $_COOKIE[Size]";
echo "</font><br>";

echo "<b>Your form variables say:</b><br>";
echo "<font ";

if (isset($_POST['type_sel'])) {
 echo "face='$_POST[type_sel]' ";
}

if (isset($_POST['size_sel'])) {
 echo "size='$_POST[size_sel]' ";
}
echo ">";
if (isset($_POST['type_sel']))
echo "Type = $_POST[type_sel]<br>";
if (isset($_POST['size_sel']))
echo "Size = $_POST[size_sel]<br>";
echo "</font>";
echo "</div></body></html>";
?>

