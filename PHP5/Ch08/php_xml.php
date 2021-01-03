<html>
<head>
<title>PHP XML Functions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#FFFFFF">
<form method="POST" action="php_xml.php">
<input type="hidden" name="posted" value="true">
<table width="100%" border="1" cellpadding="10">
  <tr><td><h2>Using PHP XML Capabilities</h2>
<?php
if (isset($_POST['posted'])) {
   $cmdButton = $_POST['cmdButton'];
   $root_element_name = $_POST['root_element_name'];
   $element01_name = $_POST['element01_name'];
   $att0101_name = $_POST['att0101_name'];
   $att0101_value = $_POST['att0101_value'];
   $att0102_name = $_POST['att0102_name'];
   $att0102_value = $_POST['att0102_value'];
   $element0101_name = $_POST['element0101_name'];
   $att010101_name = $_POST['att010101_name'];
   $att010101_value = $_POST['att010101_value'];
   $att010102_name = $_POST['att010102_name'];
   $att010102_value = $_POST['att010102_value'];
   switch ($cmdButton) {
      case "Create XML Document";
         //format an xml document
         $xml_dec = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
         $doc_type_dec = "";
         $root_element_start = "<" . $root_element_name . ">";
         $root_element_end = "</" . $root_element_name . ">";
         $xml_doc = $xml_dec;
         $xml_doc .= $doc_type_dec;
         $xml_doc .= $root_element_start;
         $xml_doc .= "<" . $element01_name . " "
          . $att0101_name . "=" . "'" . $att0101_value . "'" . " "
          . $att0102_name . "=" . "'" . $att0102_value . "'" . ">";
         $xml_doc .= "<" . $element0101_name . " " 
          . $att010101_name . "=" . "'" . $att010101_value . "'"    . " "
          . $att010102_name . "=" . "'". $att010102_value . "'"    . ">";
         $xml_doc .= "</" . $element0101_name . ">";
         $xml_doc .= "</" . $element01_name . ">";
         $xml_doc .= $root_element_end;
         //open a file and copy the xml text into it, then close it
         $default_dir = "C:\\Program Files\\Apache Group\\Apache2\\htdocs\\PHP5\\Ch8\\xml_files";
         $fp = fopen($default_dir . "\\" . $_POST['xml_file_name'] . ".xml", 'w');
         $write = fwrite($fp, $xml_doc);
         $response_message = "XML document created";
         break;   
      default;
         break;
   }
}
?>
        <table width="100%" border="1"><tr> 
            <td><font face="Arial, Helvetica, sans-serif" size="-1"><b>Create 
              a Well-formed XML Document</b></font></td>            
          </tr><tr><td><table width="100%" border="1"><tr> 
                  <td colspan="3"><font size="-1"><b><font face="Arial, Helvetica, sans-serif">Response = 
         <?php echo $response_message; ?></font></b></font></td>
                </tr><tr> 
                  <td><font size="-1"><b><font face="Arial, Helvetica, sans-serif">Element or Attribute</font></b></font></td>
                  <td><font size="-1"><b><font face="Arial, Helvetica, sans-serif">Name</font></b></font></td>
                  <td><font size="-1"><b><font face="Arial, Helvetica, sans-serif">Value</font></b></font></td>
                </tr><tr> 
                  <td><font size="-1"><b><font face="Arial, Helvetica, sans-serif">Root Element:</font></b></font></td>
                  <td><input type="text" name="root_element_name">
                  </td><td>&nbsp;</td></tr><tr> 
                  <td><font size="-1"><b><font face="Arial, Helvetica, sans-serif">Element01:</font></b></font></td>
                  <td><input type="text" name="element01_name">
                  </td><td>&nbsp;</td></tr><tr> 
                  <td><font size="-1"><b><font face="Arial, Helvetica, sans-serif">Attribute0101:</font></b></font></td>
                  <td><input type="text" name="att0101_name">
                  </td><td><input type="text" name="att0101_value">
                  </td></tr><tr> 
                  <td><font size="-1"><b><font face="Arial, Helvetica, sans-serif">Attribute0102:</font></b></font></td>
                  <td><input type="text" name="att0102_name">
                  </td><td><input type="text" name="att0102_value">
                  </td></tr><tr><td>
<font size="-1"><b><font face="Arial, Helvetica, sans-serif">Element0101: 
                    </font></b></font></td>
                  <td><input type="text" name="element0101_name">
                  </td><td>&nbsp;</td></tr><tr> 
                  <td><font size="-1"><b><font face="Arial, Helvetica, sans-serif">Attribute010101:</font></b></font></td>
                  <td><input type="text" name="att010101_name">
                  </td><td><input type="text" name="att010101_value">
                  </td></tr><tr> 
                  <td><font size="-1"><b><font face="Arial, Helvetica, sans-serif">Attribute010102:</font></b></font></td>
                  <td><input type="text" name="att010102_name">
                  </td><td><input type="text" name="att010102_value">
                  </td></tr><tr> 
                  <td><b><font face="Arial, Helvetica, sans-serif">Current XML Files</font></b><hr>
      <?php
      $default_dir = "C:\\Program Files\\Apache Group\\Apache2\\htdocs\\PHP5\\Ch8\\xml_files";
      if (!($dp = opendir($default_dir))) {
         die("Cannot open $default_dir.");
      }
      while ($file = readdir($dp)) {
         if ($file != '.' && $file != '..') {
            echo "$file<hr>";
         }
      }
      closedir($dp);
      ?>
      <font size="-1"><b><font face="Arial, Helvetica, sans-serif">Name 
                    of new XML Document File:</font></b></font>
      </td><td colspan="2" valign="bottom"> 
                    <input type="text" name="xml_file_name" size="30">
                  </td></tr><tr><td>&nbsp;</td>
                  <td colspan="2"> 
              <input type="submit" name="cmdButton" value="Create XML Document">
                  </td></tr></table></td></tr>   </table>
    </td></tr></table>
</form>
</body>
</html>
