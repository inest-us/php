<?php
$textImage = imagecreate(200,100);
$white = imagecolorallocate($textImage, 255, 255, 255);
$black = imagecolorallocate($textImage, 0, 0, 0);
imagefttext($textImage, 16, -30, 10, 30, $black,"C:\Windows\fonts\arial.ttf", "Arial, 16 pixels");
header("Content-type: image/png");
imagepng($textImage);
imagedestroy($textImage);
?>
