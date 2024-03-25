<?php
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "login") {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $db = new mysqli("localhost", "root", "", "titter");
    $q = $db->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
    $q->bind_param("s", $email);
    $q->execute();
    $result = $q->get_result();
    
    $userRow = $result->fetch_assoc();
    if($userRow == null){
        //incorrect login
        echo "Błędny login lub hasło <br>";
    } else {
        //correct login
        if(password_verify($password, $userRow['password'])){
            //correct password
            echo "Zalogowano! <br>";
        }else {
            //incorrect password
            echo "Błędny login lub hasło <br>";
        }
    }
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] == "register") {
    $db = new mysqli("localhost", "root", "", "titter");
    $email = $_REQUEST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = $_REQUEST['password'];
    $passwordRepeat = $_REQUEST['passwordRepeat'];
    
    if($password == $passwordRepeat) {
        $q = $db->prepare("INSERT INTO user VALUES (NULL, ?, ?)");
        $password = password_hash($password, PASSWORD_ARGON2I);
        $q->bind_param("ss", $email, $password);
        $result = $q->execute();
        if($result) {
            echo "Konto utworzone poprawnie";
        } else {
            echo "coś poszło nie tak";
        } 
    } else {
        echo "hasła nie są takie same, spróbuj ponwnie";
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