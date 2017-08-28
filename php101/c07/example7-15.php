<?php 
/* 
	Array Element Contents 
	$_FILES['file']['name'] The name of the uploaded file (e.g., smiley.jpg) 
	$_FILES['file']['type'] The content type of the file (e.g., image/jpeg) 
	$_FILES['file']['size'] The file’s size in bytes 
	$_FILES['file']['tmp_name'] The name of the temporary file stored on the server 
	$_FILES['file']['error'] The error code resulting from the file upload
*/

echo <<<_END
	<html>
		<head>
			<title>PHP Form Upload</title>
		</head>
	<body>
		<form method='post' action='example7-15.php' enctype='multipart/form-data'>
			Select File: <input type='file' name='filename' size='10' />
			<input type='submit' value='Upload' />
		</form>
_END;

if ($_FILES)
{
	$name = $_FILES['filename']['name'];
	move_uploaded_file($_FILES['filename']['tmp_name'], $name);
	echo "Uploaded $name <br />";
}

echo "</body></html>";
?>
