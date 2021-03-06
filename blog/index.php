<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hieu's Blog</title>
    <link rel="stylesheet" href="style/main.css" />
    <link rel="stylesheet" href="style/normalize.css" />
</head>
<body>
    <div id="wrapper">
        <h1>Blog</h1>
        <hr />

        <?php
            try {
                $stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
                echo '<ol>';
                while($row = $stmt->fetch()){
                    echo '<li>';
                        echo '<div>';
                            echo '<h1><a href="viewpost.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
                            echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                            echo '<p>'.$row['postDesc'].'</p>';                
                            echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';                
                        echo '</div>';
                    echo '</li>';
                }
                echo '</ol>';
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        ?>
    </div>
</body>
</html>