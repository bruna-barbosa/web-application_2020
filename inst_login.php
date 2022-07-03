<?php

    include "openconn.php";

    mysqli_query($conn, "set names 'utf8'");

    if ($_POST["iuser"] and $_POST["ipass"]){

        if (isset($_SESSION['volunteerLoggedIn']) && $_SESSION['volunteerLoggedIn'] == true){
            session_start();
            unset($_SESSION["fetch"]);
            $_SESSION['volunteerLoggedIn'] = false;
            session_unset();
            session_destroy();
        }

        // Valores provenientes do formulário
        $iuser = $_POST["iuser"];
        $ipass  = $_POST["ipass"];

        // Protege de MySQL injection - o servidor não reconhece estas funções (HTML ERROR 500)
        // $iuser = stripcslashes($iuser);
        // $ipass = stripcslashes($ipass);
        // $iuser = mysql_real_escape_string($iuser);
        // $ipass = mysql_real_escape_string($ipass);        

        // Validação do username/email + password
        $select = "SELECT * FROM V_instituicao
                WHERE email_repres = '$iuser' OR username = '$iuser'";

        $result = mysqli_query($conn, $select);
        $fetchi  = mysqli_fetch_assoc($result);

        // echo(count($fetchi));

        // Início de sessão
        if (count($fetchi) == 16) {

            // Leitura da Password Encriptada
            if(password_verify($ipass, $fetchi['pass'])) {
                session_start();
                $_SESSION['institutionLoggedIn'] = true;
                $_SESSION["fetch"] = $fetchi;
                $sqlv = "UPDATE V_instituicao
                         SET estado = 'Online'                        
                         WHERE   nif = " . $fetchi['nif'] .";";

            $vres = mysqli_query($conn, $sqlv);

                header('location: index.php');
            } else {
                echo "<br> Password incorreta. <br>";
                // echo '<form action="pswd_requirement.php" method="post">
                //         Email: <input type="text" name="email"><br>
                //         <input type="submit" name="submit" value="Submit">
                //       </form>';
                mysqli_close($conn);
            }
        } else {
            echo "<br> Utilizador inexistente. <br>";
            mysqli_close($conn);
        }
    }
?>