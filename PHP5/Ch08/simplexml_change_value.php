<?php
$xmlstr = <<<XML
<php_programs>
   <program name="cart">
      <price>100</price>
   </program>
   <program name="survey">
      <price>500</price>
   </program>
</php_programs>
XML;

$first_xml_string = simplexml_load_string($xmlstr);
$first_xml_string->program[0]->price = '250';

echo "<pre>";
var_dump($first_xml_string);
echo "</pre>";
?>
