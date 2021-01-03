<?php
require_once('class.Entity.php');  //this will be needed later
require_once('class.Individual.php');
require_once('class.Organization.php');

class DataManager {
  private static function _getConnection() {
    static $hDB;
   
    if(isset($hDB)) {
      return $hDB;
    }
   
    $hDB = mysql_connect('localhost', 'phpuser', 'phppass')
      or die("Failure connecting to the database!");
$Link = mysql_select_db('sample_db') or die('Failure selecting the database!');
    return $hDB;
  }

 
  public static function getAddressData($addressID) {
    $sql = "SELECT * FROM entityaddress WHERE addressid = $addressID";
    $res = mysql_query($sql, DataManager::_getConnection());
    if(! ($res && mysql_num_rows($res))) {
      die("Failed getting address data for address $addressID");
    }
   
    return mysql_fetch_assoc($res);
  }

  public static function getEmailData($emailID) {
    $sql = "SELECT * FROM entityemail WHERE emailid = $emailID";
    $res = mysql_query($sql, DataManager::_getConnection());
   
    if(! ($res && mysql_num_rows($res))) {
      die("Failed getting email data for email $emailID");
    }
   
    return mysql_fetch_assoc($res);
  }

  public static function getPhoneNumberData($phoneID) {

    $sql = "SELECT * FROM entityphone WHERE phoneid = $phoneID";
    $res = mysql_query($sql, DataManager::_getConnection());
    if(! ($res && mysql_num_rows($res))) {
      die("Failed getting phone number data for phone $phoneID");
    }
   
    return mysql_fetch_assoc($res);
  }

public static function getEntityData($entityID) {
    $sql = "SELECT * FROM entities WHERE entityid = $entityID";
    $res = mysql_query($sql, DataManager::_getConnection());
    if(! ($res && mysql_num_rows($res))) {
      die("Failed getting entity $entityID");
    }
   
    return mysql_fetch_assoc($res);
 }
  public static function getAddressObjectsForEntity($entityID) {
    $sql = "SELECT addressid from entityaddress WHERE entityid = $entityID";
    $res = mysql_query($sql, DataManager::_getConnection());
    if(!$res) {
      die("Failed getting address data for entity $entityID");
    }
   
    if(mysql_num_rows($res)) {
      $objs = array();
      while($rec = mysql_fetch_assoc($res)) {
        $objs[] = new Address($rec['addressid']);
      }
      return $objs;
    } else {
      return array();
    }
  }
 
  public static function getEmailObjectsForEntity($entityID) {

    $sql = "SELECT emailid from entityemail WHERE entityid = $entityID";
    $res = mysql_query($sql, DataManager::_getConnection());
      if(!$res) {
      die("Failed getting email data for entity $entityID");
    }
   
    if(mysql_num_rows($res)) {
      $objs = array();
      while($rec = mysql_fetch_assoc($res)) {
        $objs[] = new EmailAddress($rec['emailid']);
      }
      return $objs;
    } else {
      return array();
    }
  }

  public static function getPhoneNumberObjectsForEntity($entityID) {
    $sql = "SELECT phoneid from entityphone WHERE entityid = $entityID";
    $res = mysql_query($sql, DataManager::_getConnection());
   
    if(!$res) {
      die("Failed getting phone data for entity $entityID");
    }
   
    if(mysql_num_rows($res)) {
      $objs = array();
      while($rec = mysql_fetch_assoc($res)) {
        $objs[] = new PhoneNumber($rec['phoneid']);
      }

      return $objs;
    } else {
      return array();
    }
  }
  public static function getEmployer($individualID) {
    $sql = "SELECT organizationid FROM entityemployee " .
           "WHERE individualid = $individualID";
    $res = mysql_query($sql, DataManager::_getConnection());
    if(! ($res && mysql_num_rows($res))) {
      die("Failed getting employer info for individual $individualID");
    }
   
    $row = mysql_fetch_assoc($res);
   
    if($row) {
      return new Organization($row['organizationid']);
    } else {
      return null;
    }
 }

  public static function getEmployees($orgID) {
    $sql = "SELECT individualid FROM entityemployee " .
           "WHERE organizationid = $orgID";
    $res = mysql_query($sql, DataManager::_getConnection());
    if(! ($res && mysql_num_rows($res))) {
      die("Failed getting employee info for org $orgID");
    }
   
    if(pg_num_rows($res)) {
      $objs = array();
      while($row = mysql_fetch_assoc($res)) {
        $objs[] = new Individual($row['individualid']);
      }
      return $objs;
    } else {
      return array();
    }
 }
public static function getAllEntitiesAsObjects() {
    $sql = "SELECT entityid, type from entities";
    $res = mysql_query($sql, DataManager::_getConnection());
   
    if(!$res) {
      die("Failed getting all entities");
    }
   
    if(mysql_num_rows($res)) {
      $objs = array();
      while($row = mysql_fetch_assoc($res)) {
        if($row['type'] == 'I') {
          $objs[] = new Individual($row['entityid']);
        } elseif ($row['type'] == 'O') {
          $objs[] = new Organization($row['entityid']);
        } else {
          die("Unknown entity type {$row['type']} encountered!");
        }
      }
      return $objs;
    } else {
      return array();
    }
  }

}
?>
