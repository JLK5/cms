<?php
require_once("class/user.class.php");
session_start();
$u = $_SESSION['user'];

if(isset($_REQUEST['oldPassword']) && isset($_REQUEST['newPassword']) && isset($_REQUEST['newPasswordRepeat'])) {
    $oldPassword = $_REQUEST['oldPassword'];
    $newPassword = $_REQUEST['newPassword'];
    $newPasswordRepeat = $_REQUEST['newPasswordRepeat'];
    if($newPassword == $newPasswordRepeat) {
        $success = $u->ChangePassword($oldPassword, $newPassword);
        if($success)
            $result = "Password changed";
        else 
            $result = "Failed to change password";
    }
    else {
        $result = "Failed to change password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="profile.php" method="post">
            <label for="emailInput">E-mail:</label>
            <input type="email" id="emailInput" name="email" value="<?php echo $u->getEmail(); ?>" readonly disabled>
                    
            <label for="oldPasswordInput">Stare hasło:</label>
            <input type="password" id="oldPasswordInput" name="oldPassword" required>
                    
            <label for="newPasswordInput">New password:</label>
            <input type="password" id="newPasswordInput" name="newPassword" required>

            <label class="form-label mt-3" for="newPasswordInputRepeat">Repeat new password:</label>
            <input type="password" id="newPasswordInputRepeat" name="newPasswordRepeat" required>
                    
            <button type="submit" name="submit">Change password</button>
            <?php
            if(isset($result)) {
                echo $result;
            }
            ?>
        </form>
        <a href="logout.php">
            <button>Logout</button>
        </a>
    </div>
</body>
</html>