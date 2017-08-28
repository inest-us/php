<?php
    echo "example 6-1 <br />";
    /*
    In this example, each time you assign a value to the array $paper, 
    the first empty location within that array is used to store the value 
    and a pointer internal to PHP is incremented to point to the next free location, 
    ready for future insertions.
    */
    
    $paper[] = "Copier";
    $paper[] = "Inkjet";
    $paper[] = "Laser";
    $paper[] = "Photo";

    print_r($paper);
?>
