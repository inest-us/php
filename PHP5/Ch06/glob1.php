<?php
$welcome_message = "Hello World";            
function translate_greeting($french_message)
{ 
    global $welcome_message;
   echo $welcome_message;
   $french_message = "Bonjour Tout Le Monde";  
   return;    
}
translate_greeting();
echo $welcome_message;
?>
