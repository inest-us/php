<?php
  require_once('class.User.php');

  $obj = new User(4);  //User Robert Smith
  $obj->realname = 'Davey';
  $obj->sayHello();

  $obj2 = new User(37); //Jane Doe
  $obj2->sayHello();

?>
