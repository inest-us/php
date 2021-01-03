<?php
//The asXML method formats the parent object's data in XML version 1.0.
//create an XML formatted string
$my_xml_string = <<<XML
<a>
 <b>
  <c>text content</c>
  <c>more text content</c>
 </b>
 <d>
  <c>even more text content</c>
 </d>
</a>
XML;

//load the string into an object
$xml_object = simplexml_load_string($my_xml_string);
//display the contents of the xml object
echo $xml_object->asXML();
?> 
