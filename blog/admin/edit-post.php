<?php
//include config
require_once('../includes/config.php');
require_once('menu.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

try {
    $stmt = $db->prepare('SELECT postID, postTitle, postDesc, postContent FROM blog_posts WHERE postID = :postID');
    $stmt->execute(array(':postID' => $_GET['id']));
    $row = $stmt->fetch(); 
} catch(PDOException $e) {
    echo $e->getMessage();
}

//if form has been submitted process it
if(isset($_POST['submit'])) {
    $_POST = array_map('stripslashes', $_POST);

    //collect form data
    extract($_POST);

    //very basic validation
    if($postID ==''){
        $error[] = 'This post is missing a valid id!.';
    }

    if($postTitle ==''){
        $error[] = 'Please enter the title.';
    }

    if($postDesc ==''){
        $error[] = 'Please enter the description.';
    }

    if($postContent ==''){
        $error[] = 'Please enter the content.';
    }

    if(!isset($error)) { 
        try {
            //insert into database
            $stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postDesc = :postDesc, postContent = :postContent WHERE postID = :postID') ;
            $stmt->execute(array(
                ':postTitle' => $postTitle,
                ':postDesc' => $postDesc,
                ':postContent' => $postContent,
                ':postID' => $postID
            ));

            //redirect to index page
            header('Location: index.php?action=updated');
            exit;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    if(isset($error)) {
        foreach($error as $error){
            echo '<p class="error">'.$error.'</p>';
        }
    }
}
?>

<form action='' method='post'>
    <input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

    <p><label>Title</label><br />
    <input type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'></p>

    <p><label>Description</label><br />
    <textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc'];?></textarea></p>

    <p><label>Content</label><br />
    <textarea name='postContent' cols='60' rows='10'><?php echo $row['postContent'];?></textarea></p>

    <p><input type='submit' name='submit' value='Update'></p>
</form>

<script src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
</script>