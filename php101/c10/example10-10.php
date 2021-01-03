<?php
	require_once 'login.php';
	try {
		$conn = new PDO("mysql:host=$db_hostname;dbname=$db_database", $db_username, $db_password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = "DESCRIBE cats";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetchAll();
		
		echo "<table><tr> <th>Column</th> <th>Type</th>
			<th>Null</th> <th>Key</th> </tr>";
		
		foreach($rows as $row) {
			echo "<tr>";
			for ($k = 0 ; $k < 4 ; ++$k) echo "<td>$row[$k]</td>";
			echo "</tr>";
		}

		echo "</table>";
		$conn = null;
	}
	catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	
?>