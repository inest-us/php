<html>
<head>
<title>Beginning PHP5</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF">
<table width="100%" border="1">
  <tr> 
    <td width="49%"><font face="Arial, Helvetica, sans-serif"><b>Working With 
      Strings</b></font></td>
    <td width="51%">&nbsp;</td>
  </tr>
  <tr> 
    <td width="49%"><font face="Arial, Helvetica, sans-serif" size="-1">Using 
      Concatenation - the . operator</font></td>
    <td width="51%"><font face="Arial, Helvetica, sans-serif" size="-1"> <?php
$first_name = "Joe";
$last_name = "Blow";
$whole_name = $first_name . " " . $last_name;
echo "First name plus last name = <b>$whole_name</b>";
?> </font></td>
  </tr>
  <tr> 
    <td width="49%"><font face="Arial, Helvetica, sans-serif" size="-1">Finding 
      String Length - using <b>strlen()</b></font></td>
    <td width="51%"><font face="Arial, Helvetica, sans-serif" size="-1"> <?php
$string_length = strlen($whole_name);
echo "The length of the name is <b>" . $string_length . "</b>";
?> </font></td>
  </tr>
  <tr> 
    <td width="49%"><font face="Arial, Helvetica, sans-serif" size="-1">Getting 
      Part of a String - using <b>strstr()</b></font></td>
    <td width="51%"><font face="Arial, Helvetica, sans-serif" size="-1"> <?php
$part_after_space = strstr($whole_name, " ");
echo "The part of the string after the space is <b>" . $part_after_space . "</b>";
?> </font></td>
  </tr>
  <tr> 
    <td width="49%"><font face="Arial, Helvetica, sans-serif" size="-1">Finding 
      Position of Part of a String - using <b>strpos()</b></font></td>
    <td width="51%"><font face="Arial, Helvetica, sans-serif" size="-1"> <?php
$letter_position = strpos($whole_name, "o");
echo "The position of the letter &quot;a&quot; is <b>" . $letter_position . "</b>";
?> </font></td>
  </tr>
  <tr> 
    <td width="49%"><font face="Arial, Helvetica, sans-serif" size="-1">Return 
      a character based on an ASCII value - using <b>chr()</b></font></td>
    <td width="51%"><font face="Arial, Helvetica, sans-serif" size="-1"> <?php
$ascii_character_returned = chr(97);
echo "The character corresponding to ASCII decimal value 97 is <b>" . $ascii_character_returned . "</b>";
?> </font></td>
  </tr>
</table>
</body>
</html>
