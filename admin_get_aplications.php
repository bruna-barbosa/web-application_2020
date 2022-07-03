<?php
include "openconn.php";
mysqli_query($conn, "set names 'utf8'");

if($conn->connect_error) {
  exit('Could not connect');
}

$table = "<table id='myTable'>
<tr class='header'>
   <th>ID Projeto</th>
   <th>NIF Instituição</th>
   <th>Instituição</th>
   <th>CC Voluntário</th>
   <th>Voluntário</th>
</tr>";

$select = "V_candidatura.projeto, V_projeto.nif, V_instituicao.nome, 
V_candidatura.voluntario, V_voluntario.nome";
$from = "V_candidatura, V_projeto, V_instituicao, V_voluntario";
$where = "";
$type = "";
$params = array();

if ($_GET['pid'] != "") {
    if ($where == "") {
        $type = $type . "s";
        $params[] = $_GET['pid'];
        $where = $where . " V_candidatura.projeto = ? ";
    } else {
        $type = $type . "s";
        $params[] = $_GET['pid'];
        $where = $where . " AND V_candidatura.projeto = ? ";
        }
}

if ($_GET['inom'] != "") {
    if ($where == "") {
        $type = $type . "s";
        $params[] = $_GET['inom'];
        $where = $where . "V_instituicao.nome = ? ";
    } else {
        $type = $type . "s";
        $params[] = $_GET['inom'];
        $where = $where . " AND V_instituicao.nome = ? ";
    }
}

if ($_GET['vnom'] != "") {
    if ($where == "") {
        $type = $type . "s";
        $params[] = $_GET['vnom'];
        $where = $where . " V_voluntario.nome = ? ";
    } else {
        $type = $type . "s";
        $params[] = $_GET['vnom'];
        $where = $where . " AND V_voluntario.nome = ? ";
    }
}

if ($where == "") {
    $where = $where . " V_candidatura.projeto = V_projeto.id
        and V_projeto.nif = V_instituicao.nif
        and V_voluntario.cc = V_candidatura.voluntario ";
} else {
    $where = $where . " AND V_candidatura.projeto = V_projeto.id
        and V_projeto.nif = V_instituicao.nif
        and V_voluntario.cc = V_candidatura.voluntario ";
}

$sql = "SELECT $select FROM $from WHERE $where";

$stmt = $conn->prepare($sql);
$stmt->bind_param($type, ...$params);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($idp, $nifi, $nomi, $ccv, $nomv);

while ($stmt->fetch()) {

  $table = $table . "<tr>
                        <td>$idp</td>
                        <td>$nifi</td>
                        <td>$nomi</td>
                        <td>$ccv</td>
                        <td>$nomv</td>
                      </tr>";
}
$table = $table . "</tbody></table>";
$stmt->close();
echo $table;
?>
