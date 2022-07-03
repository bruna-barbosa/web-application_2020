<?php
include "openconn.php";
mysqli_query($conn, "set names 'utf8'");

if($conn->connect_error) {
  exit('Could not connect');
}

$table = "<table id='myTable'>
            <tr class='header'>
                <th>User</th>
                <th>CC</th>
                <th>Nome</th>
                <th>Género</th>
                <th>Idade</th>
                <th>Nascimento</th>
                <th>Foto</th>
                <th>E-mail</th>
                <th>Telemóvel</th>
                <th>Distrito</th>
                <th>Concelho</th>
                <th>Freguesia</th>
                <th>Carta</th>
            </tr>";

$select = "username, cc, nome, genero, nascimento, foto, email, telemovel, 
distrito, concelho, freguesia, carta";
  
$from = "V_voluntario";
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
        $where = $where . "email = ?";
    } else {
        $type = $type . "s";
        $params[] = $_GET['eml'];
        $where = $where . " AND email = ?";
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
$stmt->bind_result($usr, $cc, $nom, $gen, $nasc, $foto, $eml, $tele, 
$drt, $conc, $freg, $crt);

while ($stmt->fetch()) {

  $idade = intval(date("Y-m-d") - $nasc - date("1-0-0"));

  $table = $table . "<tr>
                        <td>$usr</td>
                        <td>$cc</td>
                        <td>$nom</td>
                        <td>$gen</td>
                        <td>$idade</td>
                        <td>$nasc</td>
                        <td>$foto</td>
                        <td>$eml</td>
                        <td>$tele</td>
                        <td>$drt</td>
                        <td>$conc</td>
                        <td>$freg</td>
                        <td>$crt</td>
                      </tr>";
}
$table = $table . "</tbody></table>";
$stmt->close();
echo $table;
?>
