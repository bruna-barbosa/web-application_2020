<?php

include "openconn.php";

session_start();

mysqli_query($conn, "set names 'utf8'");

$_SESSION["msg"] = false;       // mensagem de sucesso ou insucesso
$_SESSION["ccmsg"] = false;     // mensagem para certificar que cartao de cidadao existe ou nao na base de dados.
$_SESSION["usermsg"] = false;   // mensagem para certificar que username existe ou nao na base de dados.
$_SESSION["emailmsg"] = false;  // mensagem para certificar que o email existe ou nao na base de dados.
$_SESSION["userimg"] = false;   // mensagem para certificar que imagem foi submetida

//Atribuição dos campos de input da instituiçção à sua variável php respetiva, filtradas por htmlspecialchars
$nome = htmlspecialchars($_POST["vnome"]);
$_SESSION["vnome"] = $nome;
$genero = htmlspecialchars($_POST["genero"]);
$data = htmlspecialchars($_POST["data"]);
$_SESSION["vdata"] = $data;
$pass = htmlspecialchars($_POST["vpass"]);
$_SESSION["vpass"] = $pass;
$email = htmlspecialchars($_POST["vemail"]);
$_SESSION["vemail"] = $email;
$distrito = htmlspecialchars($_POST["vdistrito"]);
$_SESSION["vdistrito"] = $distrito;
$concelho = htmlspecialchars($_POST["vconcelho"]);
$_SESSION["vconcelho"] = $concelho;
$freguesia = htmlspecialchars($_POST["vfreguesia"]);
$_SESSION["vfreguesia"] = $freguesia;
$vtelemovel = htmlspecialchars($_POST["vtele"]);
$_SESSION["vtele"] = $vtelemovel;
$cartaocidadao  = htmlspecialchars($_POST["cartaocidadao"]);
$_SESSION["cc"] = $cartaocidadao;
$cartaconducao  = htmlspecialchars($_POST["carta"]);
$user = htmlspecialchars($_POST["vuser"]);
$_SESSION["vuser"] = $user;

if ($_POST["vnome"] and
    $_POST["data"] and
    $_POST["vemail"] and
    $_POST["vpass"] and
    $_POST["vconcelho"] and
    $_POST["vdistrito"] and
    $_POST["vfreguesia"] and
    $_POST["vtele"] and
    $_POST["cartaocidadao"] and
    $_POST["vuser"]) {

    $imgdirectory   = "images/users/"; // Diretoria onde é efetuado o upload

    // Upload da imagem para o servidor
    $imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]),PATHINFO_EXTENSION));    // Buscar ficheiro + Tipo de imagem (.PNG, .JPEG, ...)
    $user_img_file = $imgdirectory . $cartaocidadao . "." . $imageFileType;    // Diretoria + CC + Tipo de Imagem
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $user_img_file)) {   // Upload do ficheiro
        $_SESSION["userimg"] = "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
    } else {
        $_SESSION["userimg"] = "There was an error uploading your file.";
    }

    //Seleção de voluntario da BD através do CC, user, email
    $sqlcc = "SELECT cc FROM V_voluntario
              WHERE cc = $cartaocidadao;";

    $sqluser = "SELECT username FROM V_voluntario
              WHERE username = '$user';";

    $sqlemail = "SELECT email FROM V_voluntario
              WHERE email = '$email';";

    $vqcc = mysqli_query($conn, $sqlcc);
    $vquser = mysqli_query($conn, $sqluser);
    $vqemail = mysqli_query($conn, $sqlemail);

    $vqcc = mysqli_fetch_array($vqcc, MYSQLI_NUM);
    $vquser = mysqli_fetch_array($vquser, MYSQLI_NUM);
    $vqemail = mysqli_fetch_array($vqemail, MYSQLI_NUM);

    //Verificação de campos unicos existentes na base de dados.
    if (count($vqcc) > 0 or
        count($vquser) > 0 or
        count($vqemail) > 0){

          $_SESSION["msg"] = "campos existentes";

          if (count($vqcc) > 0) {
            $_SESSION["ccmsg"] = "Cartão de Cidadão Existente";
          }
          if (count($vquser) > 0) {
            $_SESSION["usermsg"] = "Username Existente";
          }
          if (count($vqemail) > 0) {
            $_SESSION["emailmsg"] = "Email Existente";
          }

        header('location: registration.php');

    }

    if ($_SESSION["msg"] == false) {

      // Encriptação da password
      $hashedpass = password_hash($pass, PASSWORD_DEFAULT);

      if ($cartaconducao == "sim") {
        $cartaconducao = 1;
      } else {
        $cartaconducao = 0;
      }

      //Criação das strings para insert e value
      $insert = "(cc, nome, genero, nascimento, telemovel, email, distrito, concelho,
       freguesia, pass, carta, username, foto, estado)";

      $values = "($cartaocidadao, '$nome', '$genero', '$data', $vtelemovel, '$email',
       '$distrito', '$concelho','$freguesia', '$hashedpass', '$cartaconducao', '$user', '$user_img_file', 'Offline');";

      //insert completo
      $sqlv = "INSERT INTO V_voluntario " . $insert . " VALUES " . $values;
      $vres = mysqli_query($conn, $sqlv);

      //Condicional de submissão de dados foi bem ou mal sucedida.
      if ($vres) {
        if ($_SESSION["msg"] == false) {
          $_SESSION["msg"] = "Registo bem Sucedido";
        }
        header('location: registration_done.php');
      }
      else {
        if ($_SESSION["msg"] == false) {
          $_SESSION["msg"] = "Registo não Efetuado";
        }
        header('location: registration.php');
      }
     mysqli_close($conn);
    }
}
else {
  if ($_SESSION["msg"] == false) {
    $_SESSION["msg"] = "Campos por Preencher";
    header('location: registration.php');
  }
}
