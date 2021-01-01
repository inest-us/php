<?php
    $obj = new Subscriber;
    $obj->name = "Fred";
    $obj->password = "pass";
    $obj->phone = "111 222-3333";
    $obj->email = "foo@bar.com";
    $obj->display();

    class User {
        public $name, $password;

        function save_user() {
            echo "save user";
        }
    }

    class Subscriber extends User {
        public $phone, $email;

        function display() {
            echo "Name: " , $this->name . "<br />";
            echo "Pass: " , $this->password . "<br />";
            echo "Phone: " , $this->phone . "<br />";
            echo "Email: " , $this->email . "<br />";
        }
    }
?>