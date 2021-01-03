<?php
$php_programs = simplexml_load_file('php_programs.xml'); 
foreach ($php_programs->program as $program_key => $program_val) {
echo "The root element <b>php_programs</b> contains an element named <b>$program_key</b><br>";
foreach($program_val->children() as $child_of_program_key => $child_of_program_val) {
      if ($child_of_program_key == "price") {
         foreach($program_val->attributes() as $att => $val) {
            if ($att == "name") {
               foreach($program_val->price as $the_price) {
                  echo "This <b>$program_key</b> 
                  element has an attribute named <b>$att</b> and is named 
                  <b>$val</b>.<br>";
                  echo "This <b>$program_key</b> 
                  element has a child element named <b>$child_of_program_key</b> 
                  and the value of <b>$child_of_program_key</b> is 
                  <b>$the_price</b>.<br>"; 
                  echo "Therefore, we can say that the <b>$child_of_program_key</b>
                  of the <b>$val</b> <b>$program_key</b> is 
                  <b>\$$the_price</b>.<br><br>";
               } 
            }
         }
      }
   }
}
?>
