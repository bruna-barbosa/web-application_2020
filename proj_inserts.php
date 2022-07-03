<!DOCTYPE html>

<html>

<head>


</head>

<body>

    <?php
    session_start();

    //NIF do user logged in
    $varray = $_SESSION["fetch"];
    $nif = $varray["nif"];

    //Valores do formulário - Projeto
    $projid = htmlspecialchars($_POST["projid"]);
    $vagas = htmlspecialchars($_POST["vagas"]);
    $dist = htmlspecialchars($_POST["distP"]);
    $conc = htmlspecialchars($_POST["concP"]);
    $freg = htmlspecialchars($_POST["fregP"]);
    $area_int  = $_POST["area_int"];
    $pop_alvo  = $_POST["pop_alvo"];
    $carta = $_POST["carta"];
    $funcao = htmlspecialchars($_POST["funcao"]);
    $desc = htmlspecialchars($_POST["desc"]);
    $data_inP = $_POST["data_inP"];
    $data_fimP = $_POST["data_fimP"];
    //$horas = $_POST["n_horas"];

    //Valores do formulário - disponibilidade p/projeto
    //cada if é para avaliar se o dia da semana está selecionado
    $seg_m = $_POST["2fm"];
    $seg_t = $_POST["2ft"];
    $seg_n = $_POST["2fn"];
    if (isset($seg_m) || isset($seg_t) || isset($seg_n)){
        $seg = "2ª Feira";
    }
    $ter_m = $_POST["3fm"];
    $ter_t = $_POST["3ft"];
    $ter_n = $_POST["3fn"];
    if (isset($ter_m) || isset($ter_t) || isset($ter_n)){
        $ter = "3ª Feira";
    }
    $qua_m = $_POST["4fm"];
    $qua_t = $_POST["4ft"];
    $qua_n = $_POST["4fn"];
    if (isset($qua_m) || isset($qua_t) || isset($qua_n)){
        $qua = "4ª Feira";
    }
    $qui_m = $_POST["5fm"];
    $qui_t = $_POST["5ft"];
    $qui_n = $_POST["5fn"];
    if (isset($qui_m) || isset($qui_t) || isset($qui_n)){
        $qui = "5ª Feira";
    }
    $sex_m = $_POST["6fm"];
    $sex_t = $_POST["6ft"];
    $sex_n = $_POST["6fn"];
    if (isset($sex_m) || isset($sex_t) || isset($sex_n)){
        $sex = "6ª Feira";
    }
    $sab_m = $_POST["sabm"];
    $sab_t = $_POST["sabt"];
    $sab_n = $_POST["sabn"];
    if (isset($sab_m) || isset($sab_t) || isset($sab_n)){
        $sab = "Sábado";
    }
    $dom_m = $_POST["domm"];
    $dom_t = $_POST["domt"];
    $dom_n = $_POST["domn"];
    if (isset($dom_m) || isset($dom_t) || isset($dom_n)){
        $dom = "Domingo";
    }

    //foto do perfil do projeto
    $imgdirectory   = "images/projetos/"; // Diretoria onde é efetuado o upload
    // Upload da imagem para o servidor
    $imageFileType = strtolower(pathinfo(basename($_FILES["project"]["name"]),PATHINFO_EXTENSION));
    // Buscar ficheiro + Tipo de imagem (.PNG, .JPEG, ...)
    $user_img_file = $imgdirectory . $projid . "." . $imageFileType;    // Diretoria + nif + Tipo de Imagem
    if ($_FILES["project"]["name"] != "") {
      if (move_uploaded_file($_FILES["project"]["tmp_name"], $user_img_file)) {   // Upload do ficheiro
        echo $user_img_file;
          $_SESSION["userimg"] = "The file ". htmlspecialchars( basename( $_FILES["project"]["name"])). " has been uploaded.";
      } else {
          $_SESSION["userimg"] = "There was an error uploading your file.";
      }
    } else {
      $user_img_file = "Sem Imagem";
    }

    //ligação à BD
    include "openconn.php";
    mysqli_query($conn, "set names 'utf8'");

    //valores a inserir na tabela do projeto
    $valuesP="('".$nif."','".$projid."','".$carta."','".$dist."','".$conc."',
            '".$freg."','".$area_int."','".$funcao."','".$desc."','".$pop_alvo."',
            '".$vagas."','".$data_inP."','".$data_fimP."','".$user_img_file."')";
    $queryP="INSERT INTO V_projeto (nif, id, carta, distrito, concelho, freguesia,
            area, funcao, descricao, alvo, vagas, inicio, fim, foto)
            VALUES ".$valuesP;
    //echo "<br>".$queryP."<br>";

    //INSERT das query's na BD
    $result = mysqli_query($conn, $queryP);
    if (!$result) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    } else {
        if (isset($seg)){
            if (isset($seg_m)){
                $values2f="('".$projid."','".$seg."',
                            '".$seg_m."')";
                $query2f="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values2f;
                $result2f = mysqli_query($conn, $query2f);
                //echo "<br>".$query2f."<br>";
            }
            if (isset($seg_t)){
                $values2f="('".$projid."','".$seg."',
                            '".$seg_t."')";
                $query2f="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values2f;
                $result2f = mysqli_query($conn, $query2f);
                //echo "<br>".$query2f."<br>";
            }
            if (isset($seg_n)){
                $values2f="('".$projid."','".$seg."',
                            '".$seg_n."')";
                $query2f="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values2f;
                $result2f = mysqli_query($conn, $query2f);
                //echo "<br>".$query2f."<br>";
            }
        }
        if (isset($ter)){
            if (isset($ter_m)){
                $values="('".$projid."','".$ter."',
                            '".$ter_m."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
            if (isset($ter_t)){
                $values="('".$projid."','".$ter."',
                            '".$ter_t."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
            if (isset($ter_n)){
                $values="('".$projid."','".$ter."',
                            '".$ter_n."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
        }
        if (isset($qua)){
            if (isset($qua_m)){
                $values="('".$projid."','".$qua."',
                            '".$qua_m."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
            if (isset($qua_t)){
                $values="('".$projid."','".$qua."',
                            '".$qua_t."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
            if (isset($qua_n)){
                $values="('".$projid."','".$qua."',
                            '".$qua_n."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
        }
        if (isset($qui)){
            if (isset($qui_m)){
                $values="('".$projid."','".$qui."',
                            '".$qui_m."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
            if (isset($qui_t)){
                $values="('".$projid."','".$qui."',
                            '".$qui_t."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
            if (isset($qui_n)){
                $values="('".$projid."','".$qui."',
                            '".$qui_n."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
        }
        if (isset($sex)){
            if (isset($sex_m)){
                $values="('".$projid."','".$sex."',
                            '".$sex_m."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
            if (isset($sex_t)){
                $values="('".$projid."','".$sex."',
                            '".$sex_t."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
            if (isset($sex_n)){
                $values="('".$projid."','".$sex."',
                            '".$sex_n."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
        }
        if (isset($sab)){
            if (isset($sab_m)){
                $values="('".$projid."','".$sab."',
                            '".$sab_m."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
            if (isset($sab_t)){
                $values="('".$projid."','".$sab."',
                            '".$sab_t."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
            if (isset($sab_n)){
                $values="('".$projid."','".$sab."',
                            '".$sab_n."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
        }
        if (isset($dom)){
            if (isset($dom_m)){
                $values="('".$projid."','".$dom."',
                            '".$dom_m."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
            if (isset($dom_t)){
                $values="('".$projid."','".$dom."',
                            '".$dom_t."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
            if (isset($dom_n)){
                $values="('".$projid."','".$dom."',
                            '".$dom_n."')";
                $query="INSERT INTO V_proj_horario (projeto, dia,
                            periodo) VALUES ".$values;
                $result = mysqli_query($conn, $query);
                //echo "<br>".$query."<br>";
            }
        }
        echo "Ação de voluntariado criada com sucesso!";
    }


    // Termina a ligação com a base de dados
    mysqli_close($conn);
    header('location: index.php');
    ?>

</body>

</html>
