<?php
include "openconn.php";
mysqli_query($conn, "set names 'utf8'");

if($conn->connect_error) {
  exit('Could not connect');
}

$table = "<table class = 'table table-striped table-hover'>
        <thead>
          <tr>
            <th>Id</th>
            <th>Carta</th>
            <th>Distrito</th>
            <th>Concelho</th>
            <th>Freguesia</th>
            <th>Area</th>
            <th>Funcao</th>
            <th>Descricao</th>
            <th>Alvo</th>
            <th>Vagas</th>
            <th>Inicio</th>
            <th>Fim</th>
          </tr>
        </thead>
        <tbody>";

$sql = "SELECT id, carta, distrito, concelho, freguesia,
                  area, funcao, descricao, alvo, vagas, inicio, fim
                  FROM V_projeto WHERE nif = ?";

if ($_GET['pid'] and $_GET['pid'] != "*") {

  $sql = $sql . " AND id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $_GET['inif'], $_GET['pid']);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($id, $carta, $distrito, $concelho, $freguesia, $area, $funcao,
                      $descricao, $alvo, $vagas, $inicio, $fim);
  $stmt->fetch();
  $stmt->close();

  if ($carta == "1") {
    $carta = "Sim";
  } else {
    $carta = "Não";
  }

  $table = $table . "<tr>
    <td>$id</td>
    <td>$carta</td>
    <td>$distrito</td>
    <td>$concelho</td>
    <td>$freguesia</td>
    <td>$area</td>
    <td>$funcao</td>
    <td>$descricao</td>
    <td>$alvo</td>
    <td>$vagas</td>
    <td>$inicio</td>
    <td>$fim</td>
  </tr>
</tbody>
</table>";

  echo $table;

} elseif ($_GET['pid'] == "*") {

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_GET['inif']);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($id, $carta, $distrito, $concelho, $freguesia, $area, $funcao,
                      $descricao, $alvo, $vagas, $inicio, $fim);

  while ($stmt->fetch()) {

    if ($carta == "1") {
      $carta = "Sim";
    } else {
      $carta = "Não";
    }

    $table = $table . "<tr>
                        <td>$id</td>
                        <td>$carta</td>
                        <td>$distrito</td>
                        <td>$concelho</td>
                        <td>$freguesia</td>
                        <td>$area</td>
                        <td>$funcao</td>
                        <td>$descricao</td>
                        <td>$alvo</td>
                        <td>$vagas</td>
                        <td>$inicio</td>
                        <td>$fim</td>
                      </tr>";
  }
  $table = $table . "</tbody></table>";
  $stmt->close();
  echo $table;
} else {

  $type = "";
  $params = array();

  if ($_GET['pcarta'] and $_GET['pcarta'] == "Sim") {
    $type = $type . "s";
    $params[] = "1";
    $sql = $sql . " AND carta = ?";
  } elseif ($_GET['pcarta'] and $_GET['pcarta'] == "Não") {
    $type = $type . "s";
    $params[] = "0";
    $sql = $sql . " AND carta = ?";
  }

  if ($_GET['pdistrito']) {
    $type = $type . "s";
    $params[] = $_GET['pdistrito'];
    $sql = $sql . " AND distrito = ?";
  }

  if ($_GET['pconcelho']) {
    $type = $type . "s";
    $params[] = $_GET['pconcelho'];
    $sql = $sql . " AND concelho = ?";
  }

  if ($_GET['pfreguesia']) {
    $type = $type . "s";
    $params[] = $_GET['pfreguesia'];
    $sql = $sql . " AND freguesia = ?";
  }

  if ($_GET['parea']) {
    $type = $type . "s";
    $params[] = $_GET['parea'];
    $sql = $sql . " AND area = ?";
  }

  if ($_GET['palvo']) {
    $type = $type . "s";
    $params[] = $_GET['palvo'];
    $sql = $sql . " AND alvo = ?";
  }

  $stmt = $conn->prepare($sql);
  $stmt->bind_param($type."s", $_GET['inif'], ...$params);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($id, $carta, $distrito, $concelho, $freguesia, $area, $funcao,
                      $descricao, $alvo, $vagas, $inicio, $fim);

  while ($stmt->fetch()) {

    if ($carta == "1") {
      $carta = "Sim";
    } else {
      $carta = "Não";
    }

    $table = $table . "<tr>
                        <td>$id</td>
                        <td>$carta</td>
                        <td>$distrito</td>
                        <td>$concelho</td>
                        <td>$freguesia</td>
                        <td>$area</td>
                        <td>$funcao</td>
                        <td>$descricao</td>
                        <td>$alvo</td>
                        <td>$vagas</td>
                        <td>$inicio</td>
                        <td>$fim</td>
                      </tr>";

  }

  $table = $table . "</tbody></table>";
  $stmt->close();

  echo $table;

}

?>
