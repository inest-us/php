<?php
require_once 'login.php';

try {
    $conn = new PDO("mysql:host=$db_hostname;dbname=$db_database", $db_username, $db_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "SELECT * FROM classics";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
    while ($r = $stmt->fetch()) {
		echo 'Author: '   . $r['Author'] . '<br />';
		echo 'Title: '    . $r['Title'] . '<br />';
		echo 'Category: ' . $r['Category'] . '<br />';
		echo 'Year: '     . $r['Year'] . '<br />';
		echo 'ISBN: '     . $r['ISBN'] . '<br /><br />';
    }

    //close the connection
    $conn = null;
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>