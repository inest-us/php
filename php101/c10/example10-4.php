<?php 
    require_once 'login.php'; 

    $mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_database);
    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $query = "SELECT * FROM countries"; 
    $result = $mysqli->query($query);
    if (!$result) die ("Database access failed: ");

    echo "Returned rows are: " . $result->num_rows;
    // Free result set
    $result->free_result();
    
    $mysqli->close();
?>

