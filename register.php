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
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php if(isset($_REQUEST['submit'])) : ?>
            <?php
            $result = User::Register($_REQUEST['email'], $_REQUEST['password']);            
            ?>
        <div class="result">
            <h1>
                <?php 
                    if($result)
                        echo "Account created";
                    else
                        echo "Failed to create account";
                ?>
            </h1>
            <div class="return">
            <a href="login.php">return</a>
            </div>
        </div>
        <?php else : ?>
            <div class="col-6 offset-3">
                <h1>Register a new account</h1>
                <form action="register.php" method="post">
                    <label for="emailInput">E-mail:</label>
                    <input type="email" id="emailInput" name="email" required><br>
                    <label for="passwordInput">Password:</label>
                    <input type="password" id="passwordInput" name="password" required><br>
                    <label for="passwordInputRepeat">Repeat password:</label>
                    <input type="password" id="passwordInputRepeat" name="passwordRepeat" required><br>
                    <button type="submit" name="submit">Sign up</button><br>
                </form>
                <a href="login.php">
                    <button name="submit">Sign in</button>
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>