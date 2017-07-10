<?php
    define('DBHOST','127.0.0.1');
    define('DBUSER','root');
    define('DBPASS','root');
    define('DBNAME','sampledb');

    try {
        $db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //set timezone
        date_default_timezone_set('UTC');

        $username = 'user1';
        $stmt = $db->prepare('SELECT password FROM blog_members WHERE username = :username');
        $stmt->execute(array('username' => $username));
        
        $row = $stmt->fetch();
        echo $row['password'];
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>