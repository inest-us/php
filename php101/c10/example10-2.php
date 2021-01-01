<?php 
    require_once 'login.php'; 

    $mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_database);
    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    echo "connected successfully";
    $mysqli->close();
?>

