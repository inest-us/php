<?php
    if (function_exists("array_combine")) {
        echo "Function exists";
    } else {
        echo "Function does not exist - better write your own";
    }
    echo "<br />";
    echo phpversion();
?>