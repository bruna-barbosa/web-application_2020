<?php
include "openconn.php";
mysqli_query($conn, "set names 'utf8'");

if($conn->connect_error) {
  exit('Could not connect');
}

$table = "<table id='myTable'>
            <tr class='header'>
            <th>ID</th>
            <th>Função</th>
            <th>Descrição</th>
            <th>Área</th>
            <th>Alvo</th>
            <th>Foto</th>
            <th>NIF Instituição</th>
            <th>Distrito</th>
            <th>Concelho</th>
            <th>Freguesia</th>
            <th>Carta</th>
            <th>Vagas</th>
            <th>Início</th>
            <th>Fim</th>
            </tr>";

$select = "id, funcao, descricao, area, alvo, 
foto, nif, distrito, concelho,                            
freguesia, carta, vagas, inicio,                          
fim";

$from = "V_projeto";
$where = "";
$type = "";
$params = array();

if ($_GET['pnif']) {
    if ($where == "") {
        $type = $type . "s";
        $params[] = $_GET['pnif'];
        $where = $where . "nif = ?";
    } else {
        $type = $type . "s";
        $params[] = $_GET['pnif'];
        $where = $where . " AND nif = ?";
        }
}

if ($_GET['pactv']) {
    if ($where == "") {
        $type = $type . "s";
        $where = $where . "atividade = ?";
        if ($_GET['pactv'] == "Ativo") {
            $params[] = 1;
        } else {
            $params[] = 0;
        }
    } else {
        $type = $type . "s";
        $where = $where . " AND atividade = ?";
        if ($_GET['pactv'] == "Ativo") {
            $params[] = 1;
        } else {
            $params[] = 0;
        }
        }
}

if ($_GET['pdistr']) {
    if ($where == "") {
        $type = $type . "s";
        $params[] = $_GET['pdistr'];
        $where = $where . "distrito = ?";
    } else {
        $type = $type . "s";
        $params[] = $_GET['pdistr'];
        $where = $where . " AND distrito = ?";
        }
}

if ($_GET['pconce']) {
    if ($where == "") {
        $type = $type . "s";
        $params[] = $_GET['pconce'];
        $where = $where . "concelho = ?";
    } else {
        $type = $type . "s";
        $params[] = $_GET['pconce'];
        $where = $where . " AND concelho = ?";
        }
}

if ($_GET['pfregu']) {
    if ($where == "") {
        $type = $type . "s";
        $params[] = $_GET['pfregu'];
        $where = $where . "freguesia = ?";
    } else {
        $type = $type . "s";
        $params[] = $_GET['pfregu'];
        $where = $where . " AND freguesia = ?";
        }
}

if ($where != "") {
    $sql = "SELECT $select FROM $from WHERE $where";
} else {
    $sql = "SELECT $select FROM $from";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param($type, ...$params);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($usr, $nif, $nom, $desc, $url, $foto, $eml, $telef, $mrd,
$drt, $conc, $freg, $rpr, $emlrpr);

while ($stmt->fetch()) {

  $table = $table . "<tr>
                        <td>$usr</td>
                        <td>$nif</td>
                        <td>$nom</td>
                        <td>$desc</td>
                        <td>$url</td>
                        <td>$foto</td>
                        <td>$eml</td>
                        <td>$telef</td>
                        <td>$mrd</td>
                        <td>$drt</td>
                        <td>$conc</td>
                        <td>$freg</td>
                        <td>$rpr</td>
                        <td>$emlrpr</td>
                      </tr>";
}
$table = $table . "</tbody></table>";
$stmt->close();
echo $table;
?>
