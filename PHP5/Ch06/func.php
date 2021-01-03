<?php
function html_header($page) 
{
print "\n<html>\n<head>\n<title>My Website ::: " . $page . "</title>\n</head>";
print "\n<body>";
return 0;            
}
print "<body>";
echo (html_header(1));
print "</body>";
?>