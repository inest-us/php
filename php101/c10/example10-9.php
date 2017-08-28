<?php
require_once 'login.php';

try {
	$conn = new PDO("mysql:host=$db_hostname;dbname=$db_database", $db_username, $db_password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "CREATE TABLE cats (
				id SMALLINT NOT NULL AUTO_INCREMENT,
				family VARCHAR(32) NOT NULL,
				name VARCHAR(32) NOT NULL,
				age TINYINT NOT NULL,
				PRIMARY KEY (id)
			)";
	
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	echo "table was created.";
	$conn = null;
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>