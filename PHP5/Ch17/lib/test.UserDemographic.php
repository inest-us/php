<?php

require_once ("../settings-test.php");
require_once ("class.UserDemographic.php");
require_once ("phpunit/phpunit.php");

class TestUserDemographic extends TestCase 
{
    private $demoGood = null;
    private $demoBad = null;

    function initializeDb () {
        include "../logs/initialize.php";
    }

    function setUp() 
    {
        $this->demoGood = new UserDemographic (
            array ('id'          => 1,             //
                   'site'        => 1,            // ignored
                   'section'     => 2,            // ignored
                   'login'       => "3",          // ignored
                   'session'     => "1E23553",    // ignored
                   'firstname'   => "Alice",      // ignored
                   'lastname'    => "AppleGate",  // ignored
                   'address1'    => "123Main",    // ignored
                   'city'        => "Sandusky",   // ignored
                   'state'       => "OH",         // ignored
                   'zip'         => "44870",      // ignored
                   'demo'        => "21",         
                   'demo1'       => "15",         
                   'demo2'       => "22",         
                   'demo3'       => "26")); 

        $this->demoBad = new UserDemographic (
            array ('site'        => 1,            // ignored
                   'section'     => 2,            // ignored
                   'login'       => "3",          // ignored
                   'session'     => "1E23553",    // ignored
                   'firstname'   => "Alice",      // ignored
                   'lastname'    => "AppleGate",  // ignored
                   'address1'    => "123Main",    // ignored
                   'city'        => "Sandusky",   // ignored
                   'state'       => "OH",         // ignored
                   'zip'         => "44870",      // ignored
                   'demo1'       => "15",         
                   'demo2'       => "22",         
                   'demo3'       => "26")); 
    }

    function testValid0() 
    {
        $this->assertEquals(null, $this->demoGood->city, "invalid city");
        $this->assertEquals("21", $this->demoGood->demo, "invalid demo0");
        $this->assertEquals(null, $this->demoGood->demo1, "invalid demo1");
        $this->assertEquals(null, $this->demoGood->demo2, "invalid demo2");
        $this->assertEquals(null, $this->demoGood->demo3, "invalid demo3");
        $this->assertEquals(null, $this->demoGood->demo4, "invalid demo4");
        $this->assertEquals(true, $this->demoGood->isValid(), "valid log");
        $this->assertEquals(0, count ($this->demoGood->getInvalidData()), 
                            "valid count");
    }

    function testInvalid0() 
    {

        $this->assertEquals(false, $this->demoBad->isValid(), "invalid log");
        $this->assertEquals(1, count ($this->demoBad->getInvalidData()), 
                            "expecting 1 invalid item");
    }

    function testGoodPersist0() 
    {
        $this->initializeDb();
        try {
            $this->demoGood->persist();
            $this->assert(true);
        } catch (MultiLogException $e) {
            $this->assert(false);
            print ($e->getErrorMessage());
        }
    }
}

$suite = new TestSuite;
$suite->addTest(new TestUserDemographic("testValid0"));
$suite->addTest(new TestUserDemographic("testInvalid0"));
$suite->addTest(new TestUserDemographic("testGoodPersist0"));

$testRunner = new TestRunner();
$testRunner->run( $suite );
