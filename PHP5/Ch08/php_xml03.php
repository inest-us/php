<?php

//find the file specified
$default_dir = "C:\Program Files\Apache Group\Apache\htdocs\PHP5\Ch8\xml_files";
$xml_string = file_get_contents($default_dir . "/me.xml.xml","rb");

//display it
echo $xml_string;

?>
