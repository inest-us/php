<?php
	require_once 'login.php';
	try {
		$conn = new PDO("mysql:host=$db_hostname;dbname=$db_database", $db_username, $db_password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = "DROP TABLE cats";
		$stmt = $conn->prepare($query);
		$stmt->execute();

		echo "table was dropped.";
		$conn = null;
	}
	catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
?>