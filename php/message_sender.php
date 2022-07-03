<?php //Insere mensagem na db
    include "../openconn.php";
    
    session_start();
    mysqli_query($conn, "set names 'utf8'");
    
    $remetente = mysqli_real_escape_string($conn, $_POST['remetente']);
    $destinatario = mysqli_real_escape_string($conn, $_POST['destinatario']);
    $msg = mysqli_real_escape_string($conn, $_POST['msg']);
    
        $sql = mysqli_query($conn, "INSERT INTO V_mensagem (remetente, mensagem, destinatario)
                                    VALUES ('$remetente', '$msg', '$destinatario');") or die();
 

?>