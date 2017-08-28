<?php
    require('includes/config.php'); 
    try {
        $stmt = $db->prepare('SELECT postID, postTitle, postContent, postDate FROM blog_posts WHERE postID = :postID');
        $stmt->execute(array(':postID' => $_GET['id']));
        $row = $stmt->fetch();

        if($row['postID'] == '') {
            //it there is no post, fallback to home page
            header('Location: ./');
            exit;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle'];?></title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

    <div id="wrapper">

        <h1>Blog</h1>
        <hr />
        <p><a href="./index.php">Blog Index</a></p>
        <?php
                echo '<div>';
                    echo '<h1>'.$row['postTitle'].'</h1>';
                    echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
                    echo '<p>'.$row['postContent'].'</p>';                
                echo '</div>';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        ?>
    </div>
</body>
</html>