<?php
  function isqlQuery($selectElem, $fromElem, $whereElem){

    include "openconn.php";
    mysqli_query($conn, "set names 'utf8'");

    $query = "SELECT $selectElem FROM $fromElem WHERE $whereElem;";
    $result = mysqli_query($conn, $query);

    $pid = array();
    $pcarta = array();
    $pdistrito = array();
    $pconcelho = array();
    $pfreguesia = array();
    $parea = array();
    $palvo = array();

    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
      if ($row[1] == "1") {
        $row[1] = "Sim";
      } else {
        $row[1] = "Não";
      }
      $pid[] = $row[0];
      $pcarta[] = $row[1];
      $pdistrito[] = $row[2];
      $pconcelho[] = $row[3];
      $pfreguesia[] = $row[4];
      $parea[] = $row[5];
      $palvo[] = $row[8];

      $html[] = "<tr><td>" .
      implode("</td><td>", $row) .
      "</td></tr>";
    }

    $pcarta = array_unique($pcarta);
    $pdistrito = array_unique($pdistrito);
    $pconcelho = array_unique($pconcelho);
    $pfreguesia = array_unique($pfreguesia);
    $parea = array_unique($parea);
    $palvo = array_unique($palvo);

    $selection = "<form class='form-group border' action=''>
      <select class = 'form-select' id='projid' name='pid' onchange='setpid(this.value);search();'>
        <option value='*'>ID:</option>";

    for ($i=0; $i < count($pid); $i++) {
      $selection = $selection . "<option value='$pid[$i]'>$pid[$i]</option>";
    }

    $selection = $selection . "</select>
      <select id='carta' class = 'form-select' name='pcarta' onchange='setpcarta(this.value);search();'>
      <option value=''>Carta:</option>";

      $keys = array_keys($pcarta);

    for ($i=0; $i < count($pcarta); $i++) {
      $k = $keys[$i];
      $selection = $selection . "<option value='$pcarta[$k]'>$pcarta[$k]</option>";
    }

    $selection =  $selection . "</select>
      <select id='distrito' class = 'form-select' name='pdistrito' onchange='setpdistrito(this.value);search();'>
      <option value=''>Distrito:</option>";

    $keys = array_keys($pdistrito);

    for ($i=0; $i < count($pdistrito); $i++) {
      $k = $keys[$i];
      $selection = $selection . "<option value='$pdistrito[$k]'>$pdistrito[$k]</option>";
    }

    $selection = $selection . "</select>
      <select id='concelho' class = 'form-select' name='pconcelho' onchange='setpconcelho(this.value);search();'>
      <option value=''>Concelho:</option>";

    $keys = array_keys($pconcelho);

    for ($i=0; $i < count($pconcelho); $i++) {
      $k = $keys[$i];
      $selection = $selection . "<option value='$pconcelho[$k]'>$pconcelho[$k]</option>";
    }

    $selection = $selection . "</select>
      <select id='freguesia' class = 'form-select' name='pfreguesia' onchange='setpfreguesia(this.value);search();'>
      <option value=''>Freguesia:</option>";

    $keys = array_keys($pfreguesia);

    for ($i=0; $i < count($pfreguesia); $i++) {
      $k = $keys[$i];
      $selection = $selection . "<option value='$pfreguesia[$k]'>$pfreguesia[$k]</option>";
    }

    $selection = $selection . "</select>
      <select id='area' class = 'form-select' name='parea' onchange='setparea(this.value);search();'>
      <option value=''>Area:</option>";

    $keys = array_keys($parea);

    for ($i=0; $i < count($parea); $i++) {
      $k = $keys[$i];
      $selection = $selection . "<option value='$parea[$k]'>$parea[$k]</option>";
    }

    $selection = $selection . "</select> <select id='alvo' class = 'form-select' name='palvo' onchange='setpalvo(this.value);search();'>
      <option value=''>Alvo:</option>";

    $keys = array_keys($parea);

    for ($i=0; $i < count($palvo); $i++) {
      $k = $keys[$i];
      $selection = $selection . "<option value='$palvo[$k]'>$palvo[$k]</option>";
    }

    $selection = $selection . "</select> </form> <br>";

    $html = "<table class = 'table table-striped table-hover'>
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
              <tbody>" . implode("\n", $html) . "</tbody></table>";

    $_SESSION["searchbar"] = $selection;
    $_SESSION["allprojtable"] = $html;

  }

?>
