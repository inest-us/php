<?php
require_once 'example10-1.php';

// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$conn->close();
?>