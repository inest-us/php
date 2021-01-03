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

$dom = new domDocument;
$dom->loadXML($xmlstr);
$s_dom = simplexml_import_dom($dom);
$my_dom_obj = domxml_open_file("xml_files\David.xml");
$the_root_element = $dom->document_element();
echo "$the_root_element";

echo "The price of the first program is <b>$" . $s_dom->program[0]->price . "</b>";
?>
