<?php 
    if (!unlink('testfile2_new.txt')) {
        echo "Could not delete file";
    }
    else {
        echo "File 'testfile2_new.txt' successfully deleted";
    }
?>
