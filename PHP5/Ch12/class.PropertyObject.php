<?php

  class PropertyObject {

    private $_properties;
   
    public function __construct() {
       $this->_properties = array();
       $this->_properties['name'] = null;
       $this->_properties['dateofbirth'] = null;
    }


    private $_properties = array(
                  'name' => null,
                  'dateofbirth' => null
                );

    function __get($propertyName) {
      if(!array_key_exists($propertyName, $this->_properties))
        throw new Exception('Invalid property value!');
     
      if(method_exists($this, 'get' . $propertyName)) {
        return call_user_func(array($this, 'get' . $propertyName));
      } else {
        return $this->_properties[$propertyName];
      }
    }

    function __set($propertyName, $value) {
      if(!array_key_exists($propertyName, $this->_properties))
        throw new Exception('Invalid property value!');
     
      if(method_exists($this, 'set' . $propertyName)) {
        return call_user_func(
                  array($this, 'set' . $propertyName),
                  $value
                   );
      } else {
        $this->_properties[$propertyName] = $value;
      }
    }
 
    function setDateOfBirth($dob) {
      if(strtotime($dob) == -1) {
        throw new Exception("The date of birth must be a valid date!");
      }

      $this->_properties['dateofbirth'] = $dob;
    }
   
    function sayHello() {
      //$this->_properties['name'] and $this->_properties['dateofbirth']
      //will be retrieved by __get
      print "Hi! My name is $this->name.  I was born on $this->dateofbirth";
    }

  }
?>
