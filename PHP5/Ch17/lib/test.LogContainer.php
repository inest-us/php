<?php

require_once ("../settings-test.php"); // this is important!
require_once ("class.UserLog.php");
require_once ("class.LogContainer.php");
require_once ("phpunit/phpunit.php");

class TestLogContainer extends TestCase 
{
    function setUp() 
    {
        include ("../logs/initialize.php"); // re-create db

        $ul0 = new UserLog (
            array ('site'      => "1", 
                   'section'   => "111",
                   'login'     => "aapple",
                   'session'   => "1E23553",
                   'firstname' => "Aurthor",
                   'lastname'  => "Andersen",
                   'address1'  => "123 Main St.",
                   'city'      => "Sandusky",
                   'state'     => "OH",
                   'zip'       => "44870",
                   'demo0'     => "21",
                   'demo1'     => "15",
                   'demo2'     => "22",
                   'demo3'     => "26"));
        $ul0->persist();

        $ul1 = new UserLog (
            array ('site'      => "1", 
                   'section'   => "112",
                   'login'     => "bbarker",
                   'session'   => "3F398",
                   'firstname' => "Blob",
                   'lastname'  => "Barker",
                   'address1'  => "100 Hollywood Blvd.",
                   'city'      => "LA",
                   'state'     => "CA",
                   'zip'       => "90036",
                   'demo0'     => "78",
                   'demo1'     => "21",
                   'demo2'     => "12",
                   'demo3'     => "7"));
        $ul1->persist();

        $ul2 = new UserLog (
            array ('site'      => "2", 
                   'section'   => "200",
                   'login'     => "ccabbage",
                   'session'   => "L33T",
                   'firstname' => "Capitan",
                   'lastname'  => "Cabbage",
                   'address1'  => "55 Broadway",
                   'city'      => "NYC",
                   'state'     => "NY",
                   'zip'       => "10001",
                   'demo0'     => "14",
                   'demo1'     => "15",
                   'demo2'     => "41",
                   'demo3'     => "0"));
        $ul2->persist();

    }

    function testContainerValid0() 
    {
        try {
            $lc = new LogContainer ("", "", "1", "");
            $this->assertEquals(2, $lc->getCount(), "count is wrong");
            $logs = $lc->getUserLogs();
            $this->assert(strpos (" ".$logs[0]->login, "aapple"),"login_id incorrect a");
            $this->assert(strpos (" ".$logs[1]->login, "bbarker"),"login_id incorrect b");
        } catch (MultiLogException $e) {
            $this->assert(false);
            print $e->getErrorMessage();
        }
    }
}

$suite = new TestSuite;
$suite->addTest(new TestLogContainer("testContainerValid0"));

$testRunner = new TestRunner();
$testRunner->run( $suite );
