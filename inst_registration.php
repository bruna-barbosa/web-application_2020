<?php

include "openconn.php";

session_start();

mysqli_query($conn, "set names 'utf8'");

//Mensagens por baixo dos campos de input da instituição
$_SESSION["imsg"] = false; //Não está em uso //Valor inicial
$_SESSION["inifmsg"] = "msg"; //Está em uso
$_SESSION["iusermsg"] = "msg"; //Está em uso
$_SESSION["iemailmsg"] = "msg"; //Está em uso
$_SESSION["iemailrpmsg"] = "msg"; //Está em uso

//Atribuição dos campos de input da instituiçção à sua variável php respetiva, filtradas por htmlspecialchars
$nif = htmlspecialchars($_POST["nif"]);
$_SESSION["inif"] = $nif;
$nome = htmlspecialchars($_POST["inome"]);
$_SESSION["inome"] = $nome;
$desc = htmlspecialchars($_POST["desc"]);
$_SESSION["desc"] = $desc;
$telef = htmlspecialchars($_POST["itelef"]);
$_SESSION["itelef"] = $telef;
$morada = htmlspecialchars($_POST["imorada"]);
$_SESSION["imorada"] = $morada;
$distrito = htmlspecialchars($_POST["idistrito"]);
$_SESSION["idistrito"] = $distrito;
$concelho = htmlspecialchars($_POST["iconcelho"]);
$_SESSION["iconcelho"] = $concelho;
$freguesia = htmlspecialchars($_POST["ifreguesia"]);
$_SESSION["ifreguesia"] = $freguesia;
$email = htmlspecialchars($_POST["iemail"]);
$_SESSION["iemail"] = $email;
$repr = htmlspecialchars($_POST["repr"]);
$_SESSION["repr"] = $repr;
$emailrepr = htmlspecialchars($_POST["emailrepr"]);
$_SESSION["emailrepr"] = $emailrepr;
$pass = htmlspecialchars($_POST["pass"]);
$_SESSION["pass"] = $pass;
$web = htmlspecialchars($_POST["website"]);
$_SESSION["website"] = $web;
$user = htmlspecialchars($_POST["user"]);
$_SESSION["user"] = $user;

//Se todos os campos estiverem preenchidos, entrados na cláusula
if (
  $_POST["nif"] and
  $_POST["inome"] and
  $_POST["iemail"] and
  $_POST["itelef"] and
  $_POST["imorada"] and
  $_POST["idistrito"] and
  $_POST["iconcelho"] and
  $_POST["ifreguesia"] and
  $_POST["repr"] and
  $_POST["emailrepr"] and
  $_POST["pass"] and
  $_POST["desc"] and
  $_POST["user"]
) {

  $imgdirectory   = "images/users/"; // Diretoria onde é efetuado o upload

  // Upload da imagem para o servidor
  $imageFileType = strtolower(pathinfo(basename($_FILES['logo']["name"]),PATHINFO_EXTENSION));    // Buscar ficheiro + Tipo de imagem (.PNG, .JPEG, ...)
  $user_img_file = $imgdirectory . $nif . "." . $imageFileType;    // Diretoria + CC + Tipo de Imagem
  if ($_FILES['logo']["name"] != "") {
    if (move_uploaded_file($_FILES['logo']["tmp_name"], $user_img_file)) {   // Upload do ficheiro
      $_SESSION["userimg"] = "The file " . htmlspecialchars(basename($_FILES['logo']["name"])) . " has been uploaded.";
    } else {
      $_SESSION["imsg"] = "Submissão de Logotipo sem Sucesso";
      $_SESSION["userimg"] = "There was an error uploading your file.";
    }
  } else {
    $user_img_file = "Sem Logotipo";
  }


  //Encriptação da password
  $hashedpass = password_hash($pass, PASSWORD_DEFAULT);

  //Seleção da instituição da BD através do NIF, user, email e email do representante
  $sqlnif = "SELECT nif FROM V_instituicao
            WHERE nif = $nif;";
  $sqluser = "SELECT username FROM V_instituicao
            WHERE username = '$user';";
  $sqlemail = "SELECT email_inst FROM V_instituicao
            WHERE email_inst = '$email';";
  $sqlrpemail = "SELECT email_repres FROM V_instituicao
            WHERE email_repres = '$emailrepr';";

  $iqnif = mysqli_query($conn, $sqlnif);
  $iquser = mysqli_query($conn, $sqluser);
  $iqemail = mysqli_query($conn, $sqlemail);
  $iqrpemail = mysqli_query($conn, $sqlrpemail);

  $anif = mysqli_fetch_array($iqnif, MYSQLI_NUM);
  $auser = mysqli_fetch_array($iquser, MYSQLI_NUM);
  $aemail = mysqli_fetch_array($iqemail, MYSQLI_NUM);
  $arpemail = mysqli_fetch_array($iqrpemail, MYSQLI_NUM);

  //Verificação de campos unicos existentes na base de dados.
  if (
    count($anif) > 0 or
    count($auser) > 0 or
    count($aemail) > 0 or
    count($arpemail) > 0
  ) {

    $_SESSION["imsg"] = "Registo não Efetuado";

    if (count($anif) > 0) {
      $_SESSION["inifmsg"] = "NIF Existente";
    }
    if (count($auser) > 0) {
      $_SESSION["iusermsg"] = "User Existente";
    }

    if (count($aemail) > 0) {
      $_SESSION["iemailmsg"] = "Email da Instituição Existente";
    }
    if (count($arpemail) > 0) {
      $_SESSION["iemailrpmsg"] = "Email do Representante Existente";
    }
    header('location: registration.php');
  }

  //Criação das strings para insert e value com condicional de submissão ou não do campo website
  if ($_SESSION["imsg"] == false) {
    $insert = " (nif, nome, descricao, telefone, morada,
                  distrito, concelho, freguesia, email_inst, ";
    $values = " ('$nif', '$nome', '$desc', '$telef',
                  '$morada', '$distrito', '$concelho', '$freguesia', '$email', ";

    if ($web == "Não Alterar, se Instituição não tem Website.") {
      $insert = $insert . "representante, email_repres, pass, foto, username)";
      $values = $values . "'$repr', '$emailrepr', '$hashedpass', '$user_img_file', '$user');";
    } else {
      $insert = $insert . "url_web, representante, email_repres, pass, foto, username, estado)";
      $values = $values . "'$web', '$repr', '$emailrepr', '$hashedpass', '$user_img_file', '$user', 'Offline');";
    }

    //Insert completo
    $sqli = "INSERT INTO V_instituicao " . $insert . " VALUES " . $values;
    $ires = mysqli_query($conn, $sqli);

    //Condicional de submissão de dados foi bem ou mal sucedida.
    if ($ires) {
      if ($_SESSION["imsg"] == false) {
        $_SESSION["imsg"] = "Registo bem Sucedido";
      }
      header('location: registration_done.php');
    } else {
      if ($_SESSION["imsg"] == false) {
        $_SESSION["imsg"] = "Registo não Efetuado";
      }
      header('location: registration.php');
    }
    mysqli_close($conn);
  }
} else {
  $_SESSION["imsg"] = "Campos por Preencher";
  header('location: registration.php');
}
