<html>
<head>
    <title>Book Store Book Entry Results</title>
</head>
<body>
    <h1>Book Store Book Entry Results</h1>
    <?php
        require_once 'config.php';

        // create short variable names
        $isbn=$_POST['isbn'];
        $author=$_POST['author'];
        $title=$_POST['title'];
        $price=$_POST['price'];

        if (!$isbn || !$author || !$title || !$price) {
            echo "You have not entered all the required details.<br />"
                ."Please go back and try again.";
            exit;
        }
        if (!get_magic_quotes_gpc()) {
            $isbn = addslashes($isbn);
            $author = addslashes($author);
            $title = addslashes($title);
            $price = doubleval($price);
        }
        @ $db = new mysqli($host, $username, $password, $dbname);
        if (mysqli_connect_errno()) {
            echo "Error: Could not connect to database. Please try again later.";
            exit;
        }
        
        $query = "INSERT INTO Books(ISBN, Author, Title, Price) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("sssd", $isbn, $author, $title, $price);
        $stmt->execute();
        echo $stmt->affected_rows.' book inserted into database.';
        $stmt->close();
        $db->close();
    ?>
</body>
</html>