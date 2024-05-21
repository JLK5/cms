<?php
class Post {
    private $id;
    private $author;
    private $imgUrl;
    private $title;
    private $timestamp;

    public function __construct(int $id, string $author, string $imgUrl, string $title, string $timestamp) {
        $this->id = $id;
        $this->author = $author;
        $this->imgUrl = $imgUrl;
        $this->title = $title;
        $this->timestamp = $timestamp;
    }

    public function GetTitle() : string {
        return $this->title;
    }
    public function GetAuthor() : string {
        return $this->author;
    }
    public function GetAuthorEmail() : string {
        return $this->author;
    }
    public function GetImageURL() : string {
        return $this->imgUrl;
    }
    public function GetTimestamp() : string {
        return $this->timestamp;
    }

    static function GetPosts() : array {
        $db = new mysqli('localhost', 'root', '', 'titter');
    
        $sql = "SELECT post.id, post.title, post.timestamp, post.imgUrl, user.email AS author 
                FROM post 
                INNER JOIN user ON user.id = post.author 
                ORDER BY timestamp DESC 
                LIMIT 10";
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->get_result();
        $posts = [];

        while ($row = $result->fetch_assoc()) {
            $post = new Post($row['id'], $row['author'], $row['imgUrl'], $row['title'], $row['timestamp']);
            $posts[] = $post;
        }
        $db->close();
        return $posts;
    }
    static function CreatePost(string $title, string $description) : bool {

        $targetDirectory = "img/";
        $fileName = hash('sha256', $_FILES['file']['name'].microtime());
        move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory.$fileName);
        $fileString = file_get_contents($_FILES['file']['tmp_name']);
        $gdImage = imagecreatefromstring($fileString);
        $finalUrl = "http://localhost/cms/img/".$fileName.".webp";
        $internalUrl = "img/".$fileName.".webp";
        imagewebp($gdImage, $internalUrl);
        $author = $_SESSION['user']->getID();

        $db = new mysqli('localhost', 'root', '', 'titter');
        $q = $db->prepare("INSERT INTO post (author, imgUrl, title) VALUES (?, ?, ?)");
        $q->bind_param("iss", $author, $finalUrl, $title);
        if($q->execute())
            return true;
        else
            return false;
    }
}
?>