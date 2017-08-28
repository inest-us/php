<?php
    $fh = fopen("testfile.txt", 'r') or die("File does not exist or you lack permission to open it");
    $text = fread($fh, 3); //read 3 bytes
    fclose($fh);
    echo $text;
?>
