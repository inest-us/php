<?php
require_once 'login.php';
try {
    $conn = new PDO("mysql:host=$db_hostname;dbname=$db_database", $db_username, $db_password);
    
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully. <br />";

    $stmt = $conn->prepare("SELECT * FROM classics");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
    while ($r = $stmt->fetch()) {
        echo $r['Author'] . "<br />";
    }

    //close the connection
    $conn = null;
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>