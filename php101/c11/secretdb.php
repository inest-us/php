<?php
    $name = $_POST['name'];
    $pwd = $_POST['password'];
    if ((!isset($name)) || (!isset($pwd))) {
    //Visitor needs to enter a name and password
?>
    <h1>Please Log In</h1>
    <p>This page is secret.</p>
    <form method="post" action="secretdb.php">
        <p>Username: <input type="text" name="name"></p>
        <p>Password: <input type="password" name="password"></p>
        <p><input type="submit" name="submit" value="Log In"></p>
    </form>
<?php
   } else {
    // connect to mysql
    require_once 'config.php';

    $db = new mysqli($host, $username, $password, $dbname);
    if ($db->connect_errno) {
        echo 'Error: Could not connect to database. Please try again later.';
        exit;
    }

    $query = "select count(*) from authorized_users where name=? and password=? ";
    if(!$stmt = $db->prepare($query)) die("Error");
    $stmt->bind_param("ss", $name, $pwd);
    $stmt->execute();
    $result = $stmt->get_result();
    if(!$result) {
        echo "Cannot run query.";
        exit;
    }
    $row = $result->fetch_row();
    $count = $row[0];
    $stmt->close();
    $db->close();
    if ($count > 0) {
        // visitor’s name and password combination are correct
        echo "<h1>Here it is!</h1>
        <p>I bet you are glad you can see this secret page.</p>";
    } else {
        // visitor’s name and password combination are not correct
        echo "<h1>Go Away!</h1>
                <p>You are not authorized to use this resource.</p>";
    }
}
?>