<?php
    function longdate($timestamp)
    {
        return date("l F jS Y", $timestamp);
    }
    /*
        time function to fetch the current Unix timestamp
    */
    
    echo longdate(time()); //Thursday August 24th 2017
?>
