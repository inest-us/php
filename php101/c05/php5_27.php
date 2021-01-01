<?php
    $obj = new User;
    $obj->copyright();

    class User {
        final function copyright() {
            echo "this is the final method, cannot be overriden";
        }
    }
?>
