<?php
session_start();
require("./class/user.class.php");
?>
<?php
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "login") {
    $result = User::Login($_REQUEST['email'], $_REQUEST['password']);
    if($result){
        //incorrect login
        echo "Logged in";
    } else {
        //correct login 
        echo "Login or Password Incorrect";
    }
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] == "register") {
    $result = User::Register($_REQUEST['email'], $_REQUEST['password']);
    if($result) {
        echo "Register correct";
    } else {
        echo "Register Failed";
    }
}
?>
<h1>Zaloguj się</h1>
<form action="login.php" method="post">
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput">
    <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput">
    <input type="hidden" name="action" value="login">
    <input type="submit" value="Zaloguj">
</form>

<h1>Zarejestruj się</h1>
<form action="login.php" method="post">
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput">
    <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput">
    <label for="passwordRepeatInput">Potwierdź hasło:</label>
    <input type="password" name="passwordRepeat" id="passwordRepeatInput">
    <input type="hidden" name="action" value="register">
    <input type="submit" value="Zarejestruj">
</form>