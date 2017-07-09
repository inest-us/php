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

        $stmt = $db->prepare('SELECT postID, postTitle, postContent, postDate FROM blog_posts WHERE postID = :postID');
        $stmt->execute(array(':postID' => $_GET['id']));
        $row = $stmt->fetch();

        if($row['postID'] == '') {
            header('Location: ./');
            exit;
        }
        echo '<div>';
            echo '<h1>'.$row['postTitle'].'</h1>';
            echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
            echo '<p>'.$row['postContent'].'</p>';                
        echo '</div>';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>