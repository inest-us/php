<?php
interface Throwable {
   public function getMessage();
}

class MyException implements Throwable {
   public function getMessage() {
      echo "hi";
   }
}
$a = new MyException;
$a->getMessage();
?> 
