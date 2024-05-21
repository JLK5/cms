
<?php
require_once('class/post.class.php');
require_once('class/user.class.php');
session_start();
if(!empty($_POST) && isset($_SESSION['user'])) {
    Post::CreatePost($_POST['postTitle'], $_POST['postDescription']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="postTitleInput">Title:</label>    
            <input type="text" name="postTitle" id="postTitleInput">
            <br>
            <label for="postDescriptionInput">Description:</label>
            <input type="text" name="postDescription" id="postDescriptionInput">
            <br>
            <label for="fileInput">image:</label>
            <input type="file" name="file" id="fileInput">
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>