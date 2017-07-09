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

        $stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
        while($row = $stmt->fetch()){
            
            echo '<div>';
                echo '<h1><a href="viewpost.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
                echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                echo '<p>'.$row['postDesc'].'</p>';                
                echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';                
            echo '</div>';
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>