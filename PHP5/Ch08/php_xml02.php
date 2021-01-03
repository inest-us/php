<html>
<head>
<title>PHP XML Functions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#FFFFFF">
<form method="POST" action="php_xml02.php">
<input type="hidden" name="posted" value="true">
<table width="100%" border="1" cellpadding="10">
  <tr><td><h2>Using PHP XML Capabilities</h2>
<?php
if (isset($_POST['posted'])) {

   $xml_file_chosen = $_POST['xml_file_chosen'];
   $cmdButton = $_POST['cmdButton'];

   switch ($cmdButton) {
      case "Parse an XML Document";

         //find the file specified
         $default_dir = "C:\\Program Files\\Apache Group\\Apache2\\htdocs\\PHP5\\Ch8\\xml_files";
         $xml_string = file_get_contents 
         ($default_dir . "\\" . $_POST['xml_file_chosen'],"rb");

         // Read our existing data and turn it into arrays
         $xp = xml_parser_create();
         xml_parse_into_struct($xp, $xml_string, $values, $keys);
         xml_parser_free($xp);
         
         break;
   }}
?>
       <table width="100%" border="1">
     <tr><td><font face="Arial, Helvetica, sans-serif" size="-1">
<b>Parse an XML Document</b></font></td></tr><tr><td>
      <table width="100%" border="1"><tr><td>
      <font face="Arial, Helvetica, sans-serif" size="-1">
<b>Choose XML File</b></font></td></td>
            <td><select name="xml_file_chosen">
      <?php
      $default_dir = "C:\\Program Files\\Apache Group\\Apache2\\htdocs\\PHP5\\Ch8\\xml_files";
      if (!($dp = opendir($default_dir))) {
         die("Cannot open $default_dir.");
      }
      while ($file = readdir($dp)) {
         if ($file != '.' && $file != '..') {
            echo "<option value='$file'>$file</option>\n";
         }
      }
      closedir($dp);
      ?>
      </select></td></tr><tr>
      <td><font face="Arial, Helvetica, sans-serif" size="-1"><b>XML File Contents</b></font><hr>
      <?php
      if (isset($_POST['cmdButton'])) {
         echo "Keys array<br><br><pre>";
         print_r($keys);
         echo "</pre><br><br>Values array<br><br><pre>";
         print_r($values);
         echo "</pre>";
      }
      ?>
      </td><td>
<input type="submit" name="cmdButton" value="Parse an XML Document">
</td></tr></table>
   </td></tr></table>

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
      
</form>
</body>
</html>
