<?php
    $varray = $_SESSION["fetch"];

    while ($row = mysqli_fetch_assoc($sql)) {
        //mostra a ultima msg do chat $remetente
        $sql2 = "SELECT * FROM V_mensagem WHERE (destinatario = {$row['username']}
                    OR remetente = {$row['username']}) AND (remetente = {$varray['username']} 
                    OR destinatario = {$varray['username']}) ORDER BY id DESC LIMIT 1";

        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);

        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result; //trim msg

        $output .= '<a href="chat_box.php?user_id=' . $row['username'] . '">
                        <div class="content">
                        <div class="details">
                            <span>' . $row['nome'] . '</span>
                            <p>' . $you . $msg . '</p>
                        </div>
                        </div>
                        <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                    </a>';
}
