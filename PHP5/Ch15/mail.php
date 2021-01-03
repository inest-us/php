<?php
$to = "davidm@contechst.com, dlmercer@hotmail.com";
$subject = "Your email has been sent!";
$body = "This is a test";
if(mail($to,$subject,$body)){
	echo "<b>PHP has sent your email<b>";
}
?>
