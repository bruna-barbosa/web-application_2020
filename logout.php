<?php

include "openconn.php";
session_start();

if (isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
    $_SESSION["fetch"] = $fetchi;
    $sqli =     "UPDATE V_instituicao
                 SET  estado = 'Offline'                        
                 WHERE   nif = " . $fetchi['nif'] . ";";
    $ires = mysqli_query($conn, $sqli);
} else if (isset($_SESSION['volunteerLoggedIn']) && $_SESSION['volunteerLoggedIn'] == true) {
    $_SESSION["fetch"] = $fetchv;
    $sqlv =     "UPDATE V_voluntario
                 SET estado = 'Offline'                        
                 WHERE   cc = " . $fetchv['cc'] . ";";

    $vres = mysqli_query($conn, $sqlv);
}
unset($_SESSION["fetch"]);
$_SESSION['volunteerLoggedIn'] = false;
$_SESSION['institutionLoggedIn'] = false;
session_unset();
session_destroy();
header("location:index.php");
