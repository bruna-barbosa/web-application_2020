<?php
include "openconn.php";
mysqli_query($conn, "set names 'utf8'");

if($conn->connect_error) {
  exit('Could not connect');
}

$table = "<table id='myTable'>
            <tr class='header'>
            <th>Username</th>
            <th>NIF</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>URL</th>
            <th>Foto</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Morada</th>
            <th>Distrito</th>
            <th>Concelho</th>
            <th>Freguesia</th>
            <th>Representante</th>
            <th>E-mail Repr.</th>
            </tr>";

$select = "username, nif, nome, descricao, url_web, foto, email_inst, telefone, morada,
distrito, concelho, freguesia, representante, email_repres ";
  
$from = "V_instituicao";
$where = "";
$type = "";
$params = array();

if ($_GET['nom']) {
    if ($where == "") {
        $type = $type . "s";
        $params[] = $_GET['nom'];
        $where = $where . "nome = ?";
    } else {
        $type = $type . "s";
        $params[] = $_GET['nom'];
        $where = $where . " AND nome = ?";
        }
}

if ($_GET['eml'] != "") {
    if ($where == "") {
        $type = $type . "s";
        $params[] = $_GET['eml'];
        $where = $where . "email_inst = ?";
    } else {
        $type = $type . "s";
        $params[] = $_GET['eml'];
        $where = $where . " AND email_inst = ?";
    }
}

if ($_GET['dtr'] != "") {
    if ($where == "") {
        $type = $type . "s";
        $params[] = $_GET['dtr'];
        $where = $where . "distrito = ?";
    } else {
        $type = $type . "s";
        $params[] = $_GET['dtr'];
        $where = $where . " AND distrito = ?";
    }
}

if ($_GET['conc'] != "") {
    if ($where == "") {
        $type = $type . "s";
        $params[] = $_GET['conc'];
        $where = $where . " AND concelho = ?";
    } else {
        $type = $type . "s";
        $params[] = $_GET['conc'];
        $where = $where . " AND concelho = ?";
    }
}

if ($_GET['freg'] != "") {
    if ($where == "") {
        $type = $type . "s";
        $params[] = $_GET['freg'];
        $where = $where . " AND freguesia = ?";
    } else {
        $type = $type . "s";
        $params[] = $_GET['freg'];
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
