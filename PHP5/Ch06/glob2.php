<?php
$global_message = "Global Message";
function addto_message($global_message)
{
   global $global_message;
   $global_message .= " And More";
   return $global_message;    
}
addto_message($global_message);
echo "The global message is " . $global_message;
?> 
