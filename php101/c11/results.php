<html>
<head>
    <title>Book Store Search Results</title>
</head>
<body>
    <h1>Book Store Search Results</h1>
    <?php
        require_once 'config.php';

        // create short variable names
        $searchtype=$_POST['searchtype'];
        $searchterm=trim($_POST['searchterm']); 
        if (!$searchtype || !$searchterm) {
            echo 'You have not entered search details. Please go back and try again.';
            exit;
        }
        if (!get_magic_quotes_gpc()){
            $searchtype = addslashes($searchtype);
            $searchterm = addslashes($searchterm);
        }

        $db = new mysqli($host, $username, $password, $dbname);
        if ($db->connect_errno) {
            echo 'Error: Could not connect to database. Please try again later.';
            exit;
        }
        
        $query = "select * from books where ".$searchtype." like '%".$searchterm."%'";
        $result = $db->query($query);
        $num_results = $result->num_rows;
        echo "<p>Number of books found: ".$num_results."</p>";
        for ($i=0; $i <$num_results; $i++) {
            $row = $result->fetch_assoc();
            echo "<p><strong>".($i+1).". Title: ";
            echo htmlspecialchars(stripslashes($row['Title']));
            echo "</strong><br />Author: ";
            echo stripslashes($row['Author']);
            echo "<br />ISBN: ";
            echo stripslashes($row['ISBN']);
            echo "<br />Price: ";
            echo stripslashes($row['Price']);
            echo "</p>";
        }
        $result->free();
        $db->close();
    ?>
</body>
</html>