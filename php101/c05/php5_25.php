<?php
    $obj = new Child;
    $obj->test();
    $obj->test2();

    class Dad {
        function test() {
            echo "[Class Dad] This is parent class <br />";
        }
    }

    class Child extends Dad {
        function test() {
            echo "[Class Child] This is child class <br />";
        }

        function test2() {
            parent::test();
        }
    }
?>