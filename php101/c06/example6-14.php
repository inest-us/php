<?php
    echo "example 6-14 <br />";
    $fname   = "Elizabeth";
    $sname   = "Windsor";
    $address = "Buckingham Palace";
    $city    = "London";
    $country = "United Kingdom";

    $contact = compact('fname', 'sname', 'address', 'city', 'country');
    print_r($contact);
?>