<?php>
//include config
require_once('../includes/config.php');
require_once('menu.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){
    $_POST = array_map('stripslashes', $_POST);

    //collect form data
    extract($_POST);

    //very basic validation
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
            $stmt = $db->prepare('INSERT INTO blog_posts (postTitle,postDesc,postContent,postDate) VALUES (:postTitle, :postDesc, :postContent, :postDate)');
            $stmt->execute(array(
                ':postTitle' => $postTitle,
                ':postDesc' => $postDesc,
                ':postContent' => $postContent,
                ':postDate' => date('Y-m-d H:i:s')
            ));
            //redirect to index page
            header('Location: index.php?action=added');
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
    <p><label>Title</label><br />
    <input type='text' name='postTitle' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

    <p><label>Description</label><br />
    <textarea name='postDesc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>

    <p><label>Content</label><br />
    <textarea name='postContent' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postContent'];}?></textarea></p>

    <p><input type='submit' name='submit' value='Submit'></p>
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