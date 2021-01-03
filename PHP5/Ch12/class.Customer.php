<?php

  class Customer {
    public $id;
    public $customerNumber;
    public $name;
   
    public function __construct($customerID) {
      //fetch customer infomation from the database
      //
      //This obviously doesn't come from a database, but in a
      //real application it would.     
      $data = array();
      $data['customerNumber'] = 1000000;
      $data['name'] = 'Jane Johnson';
     
      //Assign the values from the database to this object
      $this->id = $customerID;
      $this->name = $data['name'];
      $this->customerNumber = $data['customerNumber'];
    }
  }
?>
