<?php

include "openconn.php";

session_start();

mysqli_query($conn, "set names 'utf8'");

$varray = $_SESSION["fetch"];

$cartaocidadao = $varray["cc"];

$cartaconducao = $_POST["carta"];
$data_in = $_POST["data_in"];
$data_fim = $_POST["data_fim"];

//Valores do formulário - disponibilidade p/projeto
//cada if é para avaliar se o dia da semana está selecionado
$seg_m = $_POST["2fm"];
$seg_t = $_POST["2ft"];
$seg_n = $_POST["2fn"];
if (isset($seg_m) || isset($seg_t) || isset($seg_n)) {
    $seg = "2ª Feira";
}
$ter_m = $_POST["3fm"];
$ter_t = $_POST["3ft"];
$ter_n = $_POST["3fn"];
if (isset($ter_m) || isset($ter_t) || isset($ter_n)) {
    $ter = "3ª Feira";
}
$qua_m = $_POST["4fm"];
$qua_t = $_POST["4ft"];
$qua_n = $_POST["4fn"];
if (isset($qua_m) || isset($qua_t) || isset($qua_n)) {
    $qua = "4ª Feira";
}
$qui_m = $_POST["5fm"];
$qui_t = $_POST["5ft"];
$qui_n = $_POST["5fn"];
if (isset($qui_m) || isset($qui_t) || isset($qui_n)) {
    $qui = "5ª Feira";
}
$sex_m = $_POST["6fm"];
$sex_t = $_POST["6ft"];
$sex_n = $_POST["6fn"];
if (isset($sex_m) || isset($sex_t) || isset($sex_n)) {
    $sex = "6ª Feira";
}
$sab_m = $_POST["sabm"];
$sab_t = $_POST["sabt"];
$sab_n = $_POST["sabn"];
if (isset($sab_m) || isset($sab_t) || isset($sab_n)) {
    $sab = "Sábado";
}
$dom_m = $_POST["domm"];
$dom_t = $_POST["domt"];
$dom_n = $_POST["domn"];
if (isset($dom_m) || isset($dom_t) || isset($dom_n)) {
    $dom = "Domingo";
}

//Variáveis para avaliar quais as populações alvo selecionadas
$criancas = $_POST["pop_criancas"];
$jovens = $_POST["pop_jovens"];
$adultos = $_POST["pop_adultos"];
$idosos = $_POST["pop_idosos"];

//Variáveis para avaliar quais as áreas de interesse selecionadas
$saude = $_POST["area_saude"];
$logistica = $_POST["area_logistica"];
$educacao = $_POST["area_educacao"];
$social = $_POST["area_social"];

//Valores a inserir nas tabelas do voluntário

$sql1 = "UPDATE V_voluntario 
         SET   inicio = '$data_in',
               fim = '$data_fim'             
         WHERE cc = '$cartaocidadao';";

// echo "<br>".$sql."<br>";
$result1 = mysqli_query($conn, $sql1);

$sql2 = "UPDATE V_voluntario 
          SET carta = '$cartaconducao'             
          WHERE cc = '$cartaocidadao';";

// echo "<br>".$sql."<br>";

//INSERT das query's na BD
$result2 = mysqli_query($conn, $sql2);



// Inserir População Alvo selecionada
if (isset($criancas)) {
    $sqlcriancas = "INSERT INTO V_vol_alvo (
            voluntario,             
            alvo)
        VALUES " . "('"
        . $cartaocidadao . "','"
        . $criancas . "');";
    $addcriancas = mysqli_query($conn, $sqlcriancas);
}
if (isset($jovens)) {
    $sqljovens = "INSERT INTO V_vol_alvo (
            voluntario,             
            alvo)
        VALUES " . "('"
        . $cartaocidadao . "','"
        . $jovens . "');";
    $addjovens = mysqli_query($conn, $sqljovens);
}
if (isset($adultos)) {
    $sqladultos = "INSERT INTO V_vol_alvo (
            voluntario,             
            alvo)
        VALUES " . "('"
        . $cartaocidadao . "','"
        . $adultos . "');";
    $addadultos = mysqli_query($conn, $sqladultos);
}
if (isset($idosos)) {
    $sqlidosos = "INSERT INTO V_vol_alvo (
            voluntario,             
            alvo)
        VALUES " . "('"
        . $cartaocidadao . "','"
        . $idosos . "');";
    $addidosos = mysqli_query($conn, $sqlidosos);
}

// Inserir Áreas de Interesse selecionadas
if (isset($saude)) {
    $sqlsaude = "INSERT INTO V_vol_area (
            voluntario,             
            area)
        VALUES " . "('"
        . $cartaocidadao . "','"
        . $saude . "');";
    $addsaude = mysqli_query($conn, $sqlsaude);
}
if (isset($logistica)) {
    $sqllogistica = "INSERT INTO V_vol_area (
            voluntario,             
            area)
        VALUES " . "('"
        . $cartaocidadao . "','"
        . $logistica . "');";
    $addlogistica = mysqli_query($conn, $sqllogistica);
}
if (isset($educacao)) {
    $sqleducacao = "INSERT INTO V_vol_area (
            voluntario,             
            area)
        VALUES " . "('"
        . $cartaocidadao . "','"
        . $educacao . "');";
    $addeducacao = mysqli_query($conn, $sqleducacao);
    echo "<br>" . $sqleducacao . "<br>";
}
if (isset($social)) {
    $sqlsocial = "INSERT INTO V_vol_area (
            voluntario,             
            area)
        VALUES " . "('"
        . $cartaocidadao . "','"
        . $social . "');";
    $addsocial = mysqli_query($conn, $sqlsocial);
    echo "<br>" . $sqlsocial . "<br>";
}

// Inserir disponibilidade semanal
if (isset($seg)) {
    if (isset($seg_m)) {
        $values2f = "('" . $cartaocidadao . "','" . $seg . "',
                            '" . $seg_m . "')";
        $query2f = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values2f;
        $result2f = mysqli_query($conn, $query2f);
        //echo "<br>".$query2f."<br>";
    }
    if (isset($seg_t)) {
        $values2f = "('" . $cartaocidadao . "','" . $seg . "',
                            '" . $seg_t . "')";
        $query2f = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values2f;
        $result2f = mysqli_query($conn, $query2f);
        //echo "<br>".$query2f."<br>";
    }
    if (isset($seg_n)) {
        $values2f = "('" . $cartaocidadao . "','" . $seg . "',
                            '" . $seg_n . "')";
        $query2f = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values2f;
        $result2f = mysqli_query($conn, $query2f);
        //echo "<br>".$query2f."<br>";
    }
}
if (isset($ter)) {
    if (isset($ter_m)) {
        $values = "('" . $cartaocidadao . "','" . $ter . "',
                            '" . $ter_m . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
    if (isset($ter_t)) {
        $values = "('" . $cartaocidadao . "','" . $ter . "',
                            '" . $ter_t . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
    if (isset($ter_n)) {
        $values = "('" . $cartaocidadao . "','" . $ter . "',
                            '" . $ter_n . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
}
if (isset($qua)) {
    if (isset($qua_m)) {
        $values = "('" . $cartaocidadao . "','" . $qua . "',
                            '" . $qua_m . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
    if (isset($qua_t)) {
        $values = "('" . $cartaocidadao . "','" . $qua . "',
                            '" . $qua_t . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
    if (isset($qua_n)) {
        $values = "('" . $cartaocidadao . "','" . $qua . "',
                            '" . $qua_n . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
}
if (isset($qui)) {
    if (isset($qui_m)) {
        $values = "('" . $cartaocidadao . "','" . $qui . "',
                            '" . $qui_m . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
    if (isset($qui_t)) {
        $values = "('" . $cartaocidadao . "','" . $qui . "',
                            '" . $qui_t . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
    if (isset($qui_n)) {
        $values = "('" . $cartaocidadao . "','" . $qui . "',
                            '" . $qui_n . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
}
if (isset($sex)) {
    if (isset($sex_m)) {
        $values = "('" . $cartaocidadao . "','" . $sex . "',
                            '" . $sex_m . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
    if (isset($sex_t)) {
        $values = "('" . $cartaocidadao . "','" . $sex . "',
                            '" . $sex_t . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
    if (isset($sex_n)) {
        $values = "('" . $cartaocidadao . "','" . $sex . "',
                            '" . $sex_n . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
}
if (isset($sab)) {
    if (isset($sab_m)) {
        $values = "('" . $cartaocidadao . "','" . $sab . "',
                            '" . $sab_m . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
    if (isset($sab_t)) {
        $values = "('" . $cartaocidadao . "','" . $sab . "',
                            '" . $sab_t . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
    if (isset($sab_n)) {
        $values = "('" . $cartaocidadao . "','" . $sab . "',
                            '" . $sab_n . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
}
if (isset($dom)) {
    if (isset($dom_m)) {
        $values = "('" . $cartaocidadao . "','" . $dom . "',
                            '" . $dom_m . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
    if (isset($dom_t)) {
        $values = "('" . $cartaocidadao . "','" . $dom . "',
                            '" . $dom_t . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
    if (isset($dom_n)) {
        $values = "('" . $cartaocidadao . "','" . $dom . "',
                            '" . $dom_n . "')";
        $query = "INSERT INTO V_vol_horario (voluntario, dia,
                            periodo) VALUES " . $values;
        $result = mysqli_query($conn, $query);
        //echo "<br>".$query."<br>";
    }
}
echo "Preferências alteradas com sucesso!";


$update = array(
    "carta" => $cartaconducao,
    "inicio" => $data_in,
    "fim" => $data_fim
);

$varray = array_replace($varray, $update);
$_SESSION["fetch"] = $varray;


// Termina a ligação com a base de dados
mysqli_close($conn);
header('location: vol_profile.php');
