<?php
  require_once('class.PropertyObject.php');

  $obj = new PropertyObject();
  $obj->name = 'Bob'; //"Bob" is assigned to $_properties['name'] by __set
  $obj->dateofbirth = 'March 5, 1977'; //setDateOfBirth is invoked by __set
  $obj->sayHello();
 
  $obj->dateofbirth = 'blue'; //throws an exception

?>
