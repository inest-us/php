<?php
    $user = new User;
    print_r($user);
    echo "<br />";

    $user->name = "John";
    $user->password = "pass";
    print_r($user);
    echo "<br />";

    $user->save_user();
    
    class User {
        public $name, $password;

        function save_user() {
            echo "Save user";
        }
    }
?>