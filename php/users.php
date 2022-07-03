<?php //Vai buscar users menos o proprio
    include "../openconn.php";

    session_start();
    mysqli_query($conn, "set names 'utf8'");

    if (isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
        $sql = mysqli_query($conn, "SELECT * FROM V_voluntario ORDER BY nome;");

        $output = "";

        if (mysqli_num_rows($sql) > 0) {
            include "data.php";
        } else {
            $output .= "Nenhuma instituição disponível para conversar.";
        }

    } elseif ($_SESSION['volunteerLoggedIn'] == true && isset($_SESSION['volunteerLoggedIn'])) {
        $sql = mysqli_query($conn, "SELECT * FROM V_instituicao ORDER BY nome;");

        $output = "";

        if (mysqli_num_rows($sql) > 0) {
            include "data.php";
        } else {
            $output .= "Nenhuma instituição disponível para conversar.";
        }
    }

    echo $output;
?>
