<?php
include "openconn.php";
mysqli_query($conn, "set names 'utf8'");

if($conn->connect_error) {
  exit('Could not connect');
}

$table = "<table class='table table-striped table-hover table-sm' id='myTable'>
            <tr class='header'>
              <th scope='col'>Função</th>
              <th scope='col'>in. Disp.</th>
              <th scope='col'>Fim Disp.</th>
              <th scope='col'>Pop. Alvo</th>
              <th scope='col'>Área</th>
              <th scope='col'>User</th>
              <th scope='col'>CC</th>
              <th scope='col'>Nome</th>
              <th scope='col'>Género</th>
              <th scope='col'>Idade</th>
              <th scope='col'>E-mail</th>
              <th scope='col'>Telemóvel</th>
              <th scope='col'>Distrito</th>
              <th scope='col'>Concelho</th>
              <th scope='col'>Freguesia</th>
              <th scope='col'>Carta</th>
              <th scope='col'>Vagas Disponíveis</th>
              <th scope='col'>Aceitar Voluntário</th>
            </tr>";

$select = "V_projeto.funcao, V_projeto.inicio, V_projeto.fim, V_projeto.alvo, V_projeto.area,
V_voluntario.username, V_voluntario.cc, V_voluntario.nome, V_voluntario.genero, 
V_voluntario.nascimento, V_voluntario.email, V_voluntario.telemovel,
V_voluntario.distrito, V_voluntario.concelho, V_voluntario.freguesia, V_voluntario.carta, 
V_projeto.vagas";
  
$from = "V_projeto, V_voluntario, V_candidatura ";
$where = "V_projeto.nif = ? ";
$type = "s";
$params = array();
$params[] = $_GET['inif'];

if ($_GET['funcao']) {
  $type = $type . "s";
  $params[] = $_GET['funcao'];
  $where = $where . " AND funcao = ?";
}

if ($_GET['alvo']) {
  $type = $type . "s";
  $params[] = $_GET['alvo'];
  $where = $where . " AND alvo = ?";
}

if ($_GET['area']) {
  $type = $type . "s";
  $params[] = $_GET['area'];
  $where = $where . " AND area = ?";
}

if ($_GET['dist']) {
  $type = $type . "s";
  $params[] = $_GET['dist'];
  $where = $where . " AND V_voluntario.distrito = ?";
}

if ($_GET['conc']) {
  $type = $type . "s";
  $params[] = $_GET['conc'];
  $where = $where . " AND V_voluntario.concelho = ?";
}

if ($_GET['freg']) {
  $type = $type . "s";
  $params[] = $_GET['freg'];
  $where = $where . " AND V_voluntario.freguesia = ?";
}

if ($_GET['carta'] == 0 && $_GET['carta'] != "") {
  $type = $type . "s";
  $params[] = "0";
  $where = $where . " AND V_voluntario.carta = ?";
} elseif ($_GET['carta'] == 1) {
  $type = $type . "s";
  $params[] = "1";
  $where = $where . " AND V_voluntario.carta = ?";
}

$where = $where . " AND V_projeto.id = V_candidatura.projeto AND V_voluntario.cc = V_candidatura.voluntario";

$sql = "SELECT $select FROM $from WHERE $where";

$stmt = $conn->prepare($sql);
$stmt->bind_param($type, ...$params);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($funcao, $ini, $fim, $alvo, $area, $user, $cc, $nome, $gen,
$nasc, $email, $tele, $d, $c, $f, $crt, $vgs);

while ($stmt->fetch()) {

  $idade = intval(date("Y-m-d") - $nasc - date("1-0-0"));

  $table = $table . "<tr>
                        <td>$funcao</td>
                        <td>$ini</td>
                        <td>$fim</td>
                        <td>$alvo</td>
                        <td>$area</td>
                        <td>$user</td>
                        <td>$cc</td>
                        <td>$nome</td>
                        <td>$gen</td>
                        <td>$idade</td>
                        <td>$email</td>
                        <td>$tele</td>
                        <td>$d</td>
                        <td>$c</td>
                        <td>$f</td>
                        <td>$crt</td>
                        <td>$vgs</td>
                      </tr>";
}
$table = $table . "</tbody></table>";
$stmt->close();
echo $table;
?>
