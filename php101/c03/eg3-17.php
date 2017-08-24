<?php
    function test()
    {
        static $count = 0;
        echo "$count <br />";
        $count++;
    }

    test(); //0
    test(); //1
    test(); //2
?>
