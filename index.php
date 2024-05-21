<?php
require_once("class/user.class.php");
require_once("class/post.class.php");
session_start();
error_reporting(E_ERROR | E_PARSE);
?>
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
        <h1>Titter</h1>
        <?php if(User::isLogged()) : ?>
            <a href="profile.php">
                <button>
                    Profile
                </button>
            </a>
            <a href="upload.php">
                <button>
                    Create new post
                </button>
            </a>
        <?php else: ?>
            <a href="login.php">
                <button>
                    Sign in
                </button>
            </a>
        <?php endif; ?>  
    </header>
    <div class="container">
        <?php
        $postList = Post::GetPosts();
        foreach ($postList as $post) {
            echo '<div class="post-block">';
            echo '<h2 class="post-title">'.$post->GetTitle().'</h3>';
            echo '<h3 class="post-author">'.$post->GetAuthor().'</h6>';
            echo '<h3 class="post-author">'.$post->GetAuthorEmail().'</h6>';
            echo '<img src="'.$post->GetImageURL().'" alt="picture" class="post-image">';
            echo '<div class="post-footer">
                <span class="post-meta">'.$post->GetTimestamp().'</span>
                <span class="post-score">likes(todo)</span>
                </div>';
            echo '</div>';
        }

        // $db = new mysqli('localhost', 'root', '', 'titter');
        // $q = $db->prepare("SELECT post.id, post.imgUrl, post.title, 
        // post.timestamp, user.email 
        // FROM `post` INNER JOIN user 
        // ON post.author = user.id ORDER BY post.timestamp DESC;");
        // $q->execute();
        // $result = $q->get_result();
        // while($row = $result->fetch_assoc()) {
        //     echo '<div class="post-block">';
        //     echo '<h2 class="post-title">'.$row['title'].'</h2>';
        //     echo '<h3 class="post-author">'.$row['email'].'</h3>';
        //     echo '<img src="'.$row['imgUrl'].'" alt="Post img" class="post-image">';
        //     echo '<p class="post-description">TODO</p>';
        //     echo '<div class="post-footer">
        //     <span class="post-meta">'.$row['timestamp'].'</span>
        //     <span class="post-score">+ and -</span>
        //     </div>';
        //     echo '</div>';
        // }
        ?>
    </div>
</body>
</html>