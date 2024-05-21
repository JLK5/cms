<?php
require_once("class/User.class.php");
session_start();
$_SESSION['user']->Logout();
?>
<script>
    function redirect() {
        window.location.href = "http://localhost/cms/index.php";
    }
    redirect();
</script>