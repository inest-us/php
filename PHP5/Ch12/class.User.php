<?php

class User {
 
  private $_properties;
  private $_changedProperties; //keeps a list of the properties
                               //that were altered
  private $_hDB;
 
public function __construct($userID) {
    $this->_properties = array();
$this->_changedProperties = array();
   $this->_properties['id'] = null;
    $this->_properties['username'] = null;
    $this->_properties['realname'] = null;
   
    $this ->_hDB = mysql_connect('localhost', 'phpuser', 'phppass');
    if(! is_resource($this->_hDB)) {
      throw new Exception("Unable to connect to the database!");
    }
    
    $connected = mysql_select_db('sample_db', $this ->_hDB);
    if(! $connected) {
      throw new Exception("Unable to use the database 'mydatabase'!");
    }
        
    $sql  = "select * from users where id = $userID";
    $rs = mysql_query($sql, $this->_hDB);
    
    if(! mysql_num_rows($rs)) {
      throw new Exception("No user exists with id $userID!");
    }
    
    $row = mysql_fetch_assoc($rs);
   
    $this->_properties['id'] = $row['id'];
    $this->_properties['username'] = $row['username'];
    $this->_properties['realname'] = $row['realname'];

  }
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
        //If the value of the property really has changed
        //and it's not already in the changedProperties array,
        //add it. 
        if($this->_properties[$propertyName] != $value &&
           !in_array($propertyName, $this->_changedProperties)) {
          $this->_changedProperties[] = $propertyName;
        }
       
        //Now set the new value
        $this->_properties[$propertyName] = $value;     
      }
    }

    //don't allow the user ID value to be altered
    function setID($value) {
      throw new Exception('The user ID value may not be modified!');
    }
   
    function sayHello() {
      print "Hi! My name is {$this->realname}.  My userid is {$this->id}";
    }

    function __destruct() {
   
      //Check to see if anything was changed.  If
      //so, save the changes back to the database.
      if(sizeof($this->_changedProperties)) {

        $sql = "UPDATE users SET ";

      //Build up the SQL statement by creating
      //an array of set statements then join them
      //with commas at the end.       
        $setStatements = array();
        foreach($this->_changedProperties as $prop) {
          $setStatements[] = "$prop = '{$this->_properties[$prop]}'";
        }
       
        //create the string
        $sql .= join(', ', $setStatements);
 
        //append the WHERE clause
      $sql .= " WHERE id = $this->id";
    
      $hRes = mysql_query($sql, $this->_hDB);
           }
     
      //Close the connection to the database -- you're done.
      mysql_close($this->_hDB);
    }
  }
