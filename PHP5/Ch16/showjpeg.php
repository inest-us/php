<?php
$myImage = imagecreatefromjpeg('moegie.jpg');
header("Content-type: image/jpeg");
imagejpeg($myImage);
imagedestroy($myImage);
?>
