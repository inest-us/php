<?php 
	$cmd = "dir";   

	exec(escapeshellcmd($cmd), $output, $status);

	if ($status) {
		echo "Exec command failed";
	}
	else {
		echo "<pre>";
		foreach($output as $line) echo "$line\n";
	}
?>
