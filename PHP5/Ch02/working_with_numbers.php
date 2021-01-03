<html>
<head>
<title>Beginning PHP5</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF">
<table width="100%" border="1">
  <tr> 
    <td width="57%"><font face="Arial, Helvetica, sans-serif"><b>Working With 
      Numbers</b></font></td>
    <td width="43%">&nbsp;</td>
  </tr>
  <tr> 
    <td width="57%"><font face="Arial, Helvetica, sans-serif" size="-1">Using 
      the Addition Operator (+)</font></td>
    <td width="43%"><font face="Arial, Helvetica, sans-serif" size="-1">
<?php
$first_number = 20;
$second_number = 30;
$total = $first_number + $second_number;
echo "Twenty plus thirty is <b>$total</b>";
?>
 </font></td>
  </tr>
  <tr> 
    <td width="57%"><font face="Arial, Helvetica, sans-serif" size="-1">Using 
      the Increment Operator (++)</font></td>
    <td width="43%"><font face="Arial, Helvetica, sans-serif" size="-1">
<?php
$first_number = 20;
$first_number = ++$first_number;
echo "Twenty incremented by one is <b>$first_number</b>";
?>
</font></td>
  </tr>
  <tr> 
    <td width="57%"><font face="Arial, Helvetica, sans-serif" size="-1">Using 
      the Multiplication and Division Operators (* and /)</font></td>
    <td width="43%"><font face="Arial, Helvetica, sans-serif" size="-1">
<?php
$first_number = 20;
$second_number = 30;
$third_number = 3;
$fourth_number = 2;
$total = $first_number * $second_number / $third_number + $fourth_number;
$total2 = $first_number * $second_number / ($third_number + $fourth_number);
echo "Twenty times thirty divided by three plus two is <b>$total</b><br>";
echo "Twenty times thirty divided by (three plus two) is <b>$total2</b>";
?>
</font></td>
  </tr>
  <tr> 
    <td width="57%"><font face="Arial, Helvetica, sans-serif" size="-1">Special 
      Assignment Operators - Using += and *=</font></td>
    <td width="43%"><font face="Arial, Helvetica, sans-serif" size="-1">
<?php
$first_number = 20;
$second_number = 30;
$total = $first_number += $second_number;
$total2 = $first_number *= $second_number;
echo "Twenty plus-equals thirty is <b>$total</b><br>";
echo "Twenty time-equals thirty is <b>$total2</b>";
?>
</font></td>
  </tr>
  <tr> 
    <td width="57%"><font face="Arial, Helvetica, sans-serif" size="-1">Getting 
      the absolute value of a number - Using abs()</font></td>
    <td width="43%"><font face="Arial, Helvetica, sans-serif" size="-1">
<?php
$first_number = -2.7;
echo "The absolute value of -2.7 is <b>" . abs($first_number) . "</b>";
?>
</font></td>
  </tr>
  <tr> 
    <td width="57%"><font face="Arial, Helvetica, sans-serif" size="-1">Converting 
      a binary number to a decimal number - Using bindec()</font></td>
    <td width="43%"><font face="Arial, Helvetica, sans-serif" size="-1">
<?php
$binary_number = 10101111;
$decimal_number = bindec($binary_number);
echo "The decimal equivalent of the binary number 10101111 is <b>$decimal_number</b>";
?>
</font></td>
  </tr>
  <tr> 
    <td width="57%"><font face="Arial, Helvetica, sans-serif" size="-1">Round 
      Numbers up or down - Using ceil() and floor()</font></td>
    <td width="43%"><font face="Arial, Helvetica, sans-serif" size="-1">
<?php
$first_number = 2.4;
echo "2.4 rounded up is <b>" . ceil($first_number) . "</b> and rounded down is <b>" . floor($first_number) . "</b>";
?>
</font></td>
  </tr>
  <tr> 
    <td width="57%"><font face="Arial, Helvetica, sans-serif" size="-1">Finding 
      the maximum or minimum value - Using max() and min()</font></td>
    <td width="43%"><font face="Arial, Helvetica, sans-serif" size="-1">
<?php
$max_value = max(2,3,4);
$min_value = min(2,3,4);
echo "The max value of 2,3,4 is <b>" . $max_value . "</b>, and the min value is <b>" . $min_value . "</b>";
?>
</font></td>
  </tr>
  <tr> 
    <td width="57%"><font face="Arial, Helvetica, sans-serif" size="-1">Get the 
      value of PI - Using pi()</font></td>
    <td width="43%"><font face="Arial, Helvetica, sans-serif" size="-1">
<?php
echo "The value of PI is <b>" . pi() . "</b>";
?>
</font></td>
  </tr>
  <tr> 
    <td width="57%"><font face="Arial, Helvetica, sans-serif" size="-1">Get a 
      random vnumber - Using rand()</font></td>
    <td width="43%"><font face="Arial, Helvetica, sans-serif" size="-1">
<?php
echo "A random number is <b>" . rand() . "</b>";
?>
</font></td>
  </tr>
  <tr> 
    <td width="57%"><font face="Arial, Helvetica, sans-serif" size="-1">Get the 
      square root - Using sqrt()</font></td>
    <td width="43%"><font face="Arial, Helvetica, sans-serif" size="-1">
<?php
$first_number = 20;
echo "The square root of twenty is <b>" . sqrt($first_number) . "</b>";
?>
</font></td>
  </tr>
</table>
</body>
</html>
