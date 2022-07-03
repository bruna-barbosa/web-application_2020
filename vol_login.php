<?php

include "openconn.php";

mysqli_query($conn, "set names 'utf8'");

if ($_POST["vuser"] and $_POST["vpass"]) {
    // Valores provenientes do formulário
    $vuser = $_POST["vuser"];
    $vpass  = $_POST["vpass"];

    if (isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
        session_start();
        unset($_SESSION["fetch"]);
        $_SESSION['institutionLoggedIn'] = false;
        session_unset();
        session_destroy();
    }

    // Protege de MySQL injection - o servidor não reconhece estas funções (HTML ERROR 500)
    // $vuser = stripcslashes($vuser);
    // $vpass = stripcslashes($vpass);
    // $vuser = mysql_real_escape_string($vuser);
    // $vpass = mysql_real_escape_string($vpass);

    // Validação do username/email + password
    $select = "SELECT * FROM V_voluntario
                WHERE email = '$vuser' OR username = '$vuser'";

    $result = mysqli_query($conn, $select);
    $fetchv  = mysqli_fetch_assoc($result);

    $area = "   SELECT *
                FROM V_voluntario, V_vol_area
                WHERE V_voluntario.cc = V_vol_area.voluntario
                AND V_voluntario.cc = " . $fetchv['cc'] . ";";

    $result_area = mysqli_query($conn, $area);
    $v_area  = mysqli_fetch_assoc($result_area);

    $alvo = "   SELECT *
                FROM V_voluntario, V_vol_alvo
                AND V_voluntario.cc = V_vol_alvo.voluntario
                AND V_voluntario.cc = " . $fetchv['cc'] . ";";

    $result_alvo = mysqli_query($conn, $alvo);
    $v_alvo  = mysqli_fetch_assoc($result_alvo);



    $horario = "    SELECT *                    
                    FROM V_voluntario, V_vol_horario                  
                    WHERE V_voluntario.cc = V_vol_horario.voluntario                    
                    AND V_voluntario.cc = V_vol_horario.voluntario                    
                    AND V_voluntario.cc = " . $fetchv['cc'] . ";";

    $result_horario = mysqli_query($conn, $horario);
    $v_horario  = mysqli_fetch_assoc($result_horario);

    // echo(count($fetchv));

    // Início de sessão
    if (count($fetchv) == 16) {

        // Leitura da Password Encriptada
        if (password_verify($vpass, $fetchv['pass'])) {
            session_start();
            $_SESSION['volunteerLoggedIn'] = true;
            $_SESSION["fetch"] = $fetchv;
            $sqlv = "UPDATE V_voluntario
                     SET estado = 'Online'                        
                     WHERE   cc = " . $fetchv['cc'] .";";

            $vres = mysqli_query($conn, $sqlv);


            header('location: index.php');
        } else {
            //echo "<br> Password incorreta. <br>";

            //Possibilidade de recuperação de password
            echo '<p>Login inválido! Esqueceu-se da password?</p>';
            echo '<p>Para recuperar sua password indique um email válido</p><br><br>';
            echo '<form action="pswd_requirement.php" method="post">
                         Email: <input type="text" name="email">
                         <input type="submit" name="submit" value="Submit">
                  </form>';
            mysqli_close($conn);
        }
    } else {
        echo "<br> Utilizador inexistente. <br>";
        mysqli_close($conn);
    }
}
