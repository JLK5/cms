<?php
if(isset($_REQUEST['email']) && isset($_REQUEST['password'])) {
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
    var_dump($userRow);
}

?>
<form action="login.php" method="get">
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput">
    <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput">
    <input type="submit" value="Zaloguj">
</form>