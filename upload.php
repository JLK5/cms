
<?php
if(!empty($_POST)) {
    $postTitle = $_POST['postTitle'];
    $postDescription = $_POST['postDescription'];
    $targetDirectory = "img/";
    //$fileName = $_FILES['file']['name'];

    $fileName = hash('sha256', $_FILES['file']['name'].time());
    //move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory.$fileName);

    $fileString = file_get_contents($_FILES['file']['tmp_name']);
    $gdImage = imagecreatefromstring($fileString);
    $internalUrl = "img/".$fileName.".webp";
    
    $finalUrl = "http://localhost/cms/img/".$fileName.".webp";
    imagewebp($gdImage, $finalUrl);

    $authorID = 1;


    $db = new mysqli('localhost', 'root', '', 'titter');
    $q = $db->prepare("INSERT INTO post (author, imgUrl, title) VALUES (?, ?, ?)");
    $q->bind_param("iss", $authorID, $finalUrl, $postTitle);
    $q->execute();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="postTitle">Title:</label>    
    <input type="text" name="postTitle" id="postTitle">
        <br>
        <label for="postDescriptionInput">Description:</label>
        <input type="text" name="postDescription" id="postDescriptionInput">
        <br>
        <label for="fileInput">image:</label>
        <input type="file" name="file" id="fileInput">
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>