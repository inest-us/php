<?php
$filename = "./counter.php";
if(is_dir($filename)) {
echo "$filename is a directory.";
} else if (is_file($filename)) {
echo "$filename is a file.";
} else {
echo "$filename is neither a directory nor a file.";
}
?>
