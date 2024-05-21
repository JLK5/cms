<?php
session_start();
require("./class/user.class.php");
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <?php if(isset($_REQUEST['submit'])) : ?>
        <?php
        $result = User::Login($_REQUEST['email'], $_REQUEST['password']);
        ?>
        <div class="result">
            <h1>
                <?php 
                    if($result)
                        header("Location:index.php");
                     else
                         echo "Failed to log in";
                ?>
            </h1>
            <div class="return">
            <a href="login.php">Try again</a>
            </div>
            <div class="MainMenu">
            <a href="index.php">Main Page</a>
            </div>
        </div>
    <?php else : ?>
        <div class="Signin">
            <h1>Sign in</h1>
            <form action="login.php" method="post">
                <label for="emailInput">E-mail:</label>
                <input type="email" id="emailInput" name="email" required> <br>
                <label for="passwordInput">Password:</label>
                <input type="password" id="passwordInput" name="password" required><br>
                <button type="submit" name="submit">Sign in</button><br>
            </form>
            <a href="register.php">
                <button name="submit">Sign up</button>
            </a>
        </div>
    <?php endif; ?>    
    </div>
</body>
</html>