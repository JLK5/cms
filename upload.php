
<?php
if(!empty($_POST)) {
    $postTitle = $_POST['postTitle'];
    $postDescription = $_POST['postDescription'];
    $targetDirectory = "img/";
    $fileName = $_FILES['file']["name"];
    move_uploaded_file($_FILES['file']["tmp_name"], $targetDirectory.$fileName);
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
        <input type="text" name="postTitle" id="postTitle">
        <label for="postTitleInput">Tytuł posta:</label>
        <br>
        <label for="postDescriptionInput">Opis Posta:</label>
        <input type="text" name="postDescription" id="postDescriptionInput">
        <br>
        <label for="fileInput">Obrazek:</label>
        <input type="file" name="file" id="fileInput">
        <br>
        <input type="submit" value="Wyślij">
    </form>
</body>
</html>