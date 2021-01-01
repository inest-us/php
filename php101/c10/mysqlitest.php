<?php
require_once 'login.php';

// Create connection
$conn1 = new mysqli($db_hostname, $db_username, $db_password);

// Check connection
if ($conn1->connect_error) {
    die("Connection failed: " . $conn1->connect_error);
}
echo "Connected successfully <br />";
$conn1->close();

// Create connection
$conn2 = new mysqli($db_hostname, $db_username, $db_password, $db_database);

// Check connection
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}
echo "Connected successfully";
$conn2->close();

?>