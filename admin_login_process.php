<?php
    include "openconn.php";

    mysqli_query($conn, "set names 'utf8'");

    if ($_POST["auser"] and $_POST["apass"]){
        $auser = $_POST["auser"];
        $apass  = $_POST["apass"];

        if(isset($_SESSION['adminLoggedIn']) && $_SESSION['adminLoggedIn'] == true){
            session_start();
            unset($_SESSION["fetch"]);
            $_SESSION['adminLoggedIn'] = false;
            session_unset();
            session_destroy();
        }

        $select = "SELECT * FROM V_administrador
                WHERE email = '$auser' OR username = '$auser'
                AND pass = '$apass';";

        $result = mysqli_query($conn, $select);
        $fetcha  = mysqli_fetch_assoc($result);

        if (count($fetcha) == 3) {
            session_start();
            $_SESSION["fetch"] = $fetcha;
            $_SESSION['adminLoggedIn'] = true;
            header('location: admin.php');
        } else {
            echo "<br> Email ou password incorretos. Tente novamente. <br>";
            mysqli_close($conn);
        }
    }
?>

