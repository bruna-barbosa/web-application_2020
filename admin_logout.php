<?php
    session_start();
    unset($_SESSION["fetch"]);
    $_SESSION['adminLoggedIn'] = false;
    session_unset();
    session_destroy();
    header("location:admin_login.php");
?>
