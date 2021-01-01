<?php
	$fh = fopen("testfile.txt", 'r+') or die("Failed to open file");
	$text = fgets($fh);
	fseek($fh, 0, SEEK_END);
	if (flock($fh, LOCK_EX)) //sets an exclusive file lock on the file referred to by $fh using the LOCK_EX
	{
		fwrite($fh, "$text") or die("Could not write to file");
		flock($fh, LOCK_UN); //release the lock
	}
	fclose($fh);
	echo "File 'testfile.txt' successfully updated";
?>
