<?php
    $argument_array = array("dog", "dog", "cat", "cat", "hamster");
    $returned_array = array_count_values($argument_array);
    print_r($returned_array);
?>
