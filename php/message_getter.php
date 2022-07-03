<?php //vai buscar tds as mensagens entre pessoas num chat e ordena e mete no sitio certo do chat (esq/dir)
    include "../openconn.php";

    session_start();
    mysqli_query($conn, "set names 'utf8'");

    $varray = $_SESSION["fetch"];

    $remetente = $varray['username'];
    $destinatario = mysqli_real_escape_string($conn, $_POST['destinatario']);
    $output = "";

    if (isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
        $sql = "SELECT * FROM V_mensagem LEFT JOIN V_instituicao ON V_instituicao.username = V_mensagem.remetente
                WHERE (remetente = '$remetente' AND destinatario = '$destinatario')
                OR (remetente = '$destinatario' AND destinatario = '$remetente') ORDER BY id";

    } else if ($_SESSION['volunteerLoggedIn'] == true or isset($_SESSION['volunteerLoggedIn']) && $_SESSION['institutionLoggedIn'] == false) {
        
        $sql = "SELECT * FROM V_mensagem LEFT JOIN V_voluntario ON V_voluntario.username = V_mensagem.remetente
                WHERE (remetente = '$remetente' AND destinatario = '$destinatario')
                OR (remetente = '$destinatario' AND destinatario = '$remetente') ORDER BY id";
    }
    
    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            if($row['remetente'] === $remetente){
                $output .= '<div class="chat remetente">
                            <div class="details">
                                <p>'. $row['mensagem'] .'</p>
                            </div>
                            </div>';
            }else{
                $output .= '<div class="chat destinatario">
                            <div class="details">
                                <p>'. $row['mensagem'] .'</p>
                            </div>
                            </div>';
            }
        }
    }else{
        $output .= '<div class="text">Ainda não existem mensagens. Diga "Olá!"</div>';
    }
    echo $output;
?>

