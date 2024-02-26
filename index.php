
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        Titter
    </header>
    <div id="container">
        <?php 
        $db = new mysqli('localhost', 'root', '', 'titter');
        $q = $db->prepare("SELECT post.ID_P, post.imgURl, post.title, 
        post.timestamp, user.login 
        FROM `post` INNER JOIN user 
        ON post.author = user.ID_U;");
        $q->execute();
        $result = $q->get_result();
        while($row = $result->fetch_assoc()) {
            echo '<div class="post-block">';
            echo '<h2 class="post-title">'.$row['title'].'</h2>';
            echo '<h3 class="post-author">'.$row['login'].'</h3>';
            echo '<img src="'.$row['imgUrl'].'" alt="Post img" class="post-image">';
            echo '<p class="post-description">TODO</p>';
            echo '<div class="post-footer">
            <span class="post-meta">'.$row['timestamp'].'</span>
            <span class="post-score">+ and -</span>
            </div>';
            echo '</div>';
        }
        ?>
</body>
</html>