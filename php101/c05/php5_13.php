<?php
    $user1 = new User();
    $user1->name = "Alice";

    $user2 = clone $user1;
    $user2->name = "Amy";

    echo "user1 name = " . $user1->name . "<br />";
    echo "user2 name = " . $user2->name . "<br />";
    class User {
        public $name;
    }
?>