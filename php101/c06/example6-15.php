<?php
    echo "example 6-15 <br />";
    $j       = 23;
    $temp    = "Hello";
    $address = "1 Old Street";
    $age     = 61;

    print_r(compact(explode(' ', 'j temp address age')));
?>
