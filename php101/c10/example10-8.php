<?php 
require_once 'login.php';

$conn = new PDO("mysql:host=$db_hostname;dbname=$db_database", $db_username, $db_password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['delete']) && isset($_POST['isbn']))
{
	$isbn  = get_post('isbn');
	$sql = "DELETE FROM classics WHERE isbn='$isbn'";

	$stmt = $conn->prepare($sql);
	$stmt->execute();
}

if (isset($_POST['author']) &&
	isset($_POST['title']) &&
	isset($_POST['category']) &&
	isset($_POST['year']) &&
	isset($_POST['isbn']))
{
	$author   = get_post('author');
	$title    = get_post('title');
	$category = get_post('category');
	$year     = get_post('year');
	$isbn     = get_post('isbn');

	echo "author: " . $author . "<br />";
	$sql = "INSERT INTO classics VALUES ('$author', '$title', '$category', '$year', '$isbn')";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
}

echo <<<_END
<form action="example10-8.php" method="post"><pre>
  Author <input type="text" name="author" />
   Title <input type="text" name="title" />
Category <input type="text" name="category" />
    Year <input type="text" name="year" />
    ISBN <input type="text" name="isbn" />
         <input type="submit" value="ADD RECORD" />
</pre></form>
_END;

$sql = "SELECT * FROM classics";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

while ($row = $stmt->fetch()) 
{
	echo "Author: " . $row['author'] . "<br />";
	echo "Title: " .  $row['title'] . "<br />";
	echo "Category: " . $row['type'] . "<br />";
	echo "Year: " . $row['year'] . "<br />";
	echo "ISBN: " . $row['isbn'] . "<br />";
	echo "<form action='example10-8.php' method='post'>";
	echo "<input type='hidden' name='delete' value='yes' />";
	echo "<input type='hidden' name='isbn' value='" . $row['isbn'] . "' />";
	echo "<input type='submit' value='DELETE RECORD' /></form>";
}

$conn = null;

function get_post($var)
{
	return mysql_escape_string($_POST[$var]);
}
?>
