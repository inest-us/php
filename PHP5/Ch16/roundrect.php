<?php
function roundrect($image, $x1, $y1, $x2, $y2, $curvedepth, $color) {
 imageline($image, ($x1 + $curvedepth), $y1, ($x2 - $curvedepth), $y1, $color);
 imageline($image, ($x1 + $curvedepth), $y2, ($x2 - $curvedepth), $y2, $color);
 imageline($image, $x1, ($y1 + $curvedepth), $x1, ($y2 - $curvedepth), $color);
 imageline($image, $x2, ($y1 + $curvedepth), $x2, ($y2 - $curvedepth), $color);
 imagearc($image, ($x1 + $curvedepth), ($y1 + $curvedepth), (2 * $curvedepth), (2 * $curvedepth), 180, 270, $color);
 imagearc($image, ($x2 - $curvedepth), ($y1 + $curvedepth), (2 * $curvedepth), (2 * $curvedepth), 270, 360, $color);
 imagearc($image, ($x2 - $curvedepth), ($y2 - $curvedepth), (2 * $curvedepth), (2 * $curvedepth), 0, 90, $color);
 imagearc($image, ($x1 + $curvedepth), ($y2 - $curvedepth), (2 * $curvedepth), (2 * $curvedepth), 90, 180, $color);
}
$myImage = imagecreate(200,100);
$myGrey = imagecolorallocate($myImage,204,204,204);
$myBlack = imagecolorallocate($myImage,0,0,0);
roundrect($myImage, 20, 10, 180, 90, 20, $myBlack);
header("Content-type: image/png");
imagepng($myImage);
imagedestroy($myImage);
?>
