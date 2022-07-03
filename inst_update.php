<?php

  include "openconn.php";

  session_start();

  mysqli_query($conn, "set names 'utf8'");

  $varray = $_SESSION["fetch"];

  $_SESSION["msg"] = false;

  $nif = $varray["nif"];
  $nome = htmlspecialchars($_POST["inome"]);
  $desc = htmlspecialchars($_POST["desc"]);
  $telef = htmlspecialchars($_POST["itelef"]);
  $morada = htmlspecialchars($_POST["imorada"]);
  $distrito = htmlspecialchars($_POST["idistrito"]);
  $concelho = htmlspecialchars($_POST["iconcelho"]);
  $freguesia = htmlspecialchars($_POST["ifreguesia"]);
  $email = htmlspecialchars($_POST["iemail"]);
  $web = htmlspecialchars($_POST["website"]);
  $repr = htmlspecialchars($_POST["repr"]);
  $emailrepr = htmlspecialchars($_POST["emailrepr"]);
  $pass = htmlspecialchars($_POST["pass"]);
  $user = htmlspecialchars($_POST["user"]);


  //Encriptação da password
  $hashedpass = password_hash($pass, PASSWORD_DEFAULT);

  //Seleção da instituição da BD através do NIF, user, email e email do representante
  $sqluser = "SELECT username FROM V_instituicao
           WHERE username = '$user';";
  $sqlemail = "SELECT email_inst FROM V_instituicao
           WHERE email_inst = '$email';";
  $sqlrpemail = "SELECT email_repres FROM V_instituicao
           WHERE email_repres = '$emailrepr';";

  $iquser = mysqli_query($conn, $sqluser);
  $iqemail = mysqli_query($conn, $sqlemail);
  $iqrpemail = mysqli_query($conn, $sqlrpemail);

  $auser = mysqli_fetch_array($iquser, MYSQLI_NUM);
  $aemail = mysqli_fetch_array($iqemail, MYSQLI_NUM);
  $arpemail = mysqli_fetch_array($iqrpemail, MYSQLI_NUM);

  //Verificação de campos unicos existentes na base de dados.
   if (count($auser) > 0) {
     if ($varray["username"] != $_POST["user"]) {
       $_SESSION["iusermsg"] = "Username Existente";
       $_SESSION["msg"] = "Perfil não actualizado";
     }
   }

   if (count($aemail) > 0) {
     if ($varray["email_inst"] != $_POST["iemail"]) {
       $_SESSION["iemailmsg"] = "Email da Instituição Existente";
       $_SESSION["msg"] = "Perfil não actualizado";
     }
   }
   if (count($aemail) > 0) {
     if ($varray["email_inst"] != $_POST["iemail"]) {
       $_SESSION["iemailrpmsg"] = "Email do Representante Existente";
       $_SESSION["msg"] = "Perfil não actualizado";
     }
   }

  if ($_SESSION["msg"] == false) {

    $sqlv = "UPDATE V_instituicao
            SET nome            = '$nome',
                descricao       = '$desc',
                telefone        = '$telef',
                morada          = '$morada',
                distrito        = '$distrito',
                concelho        = '$concelho',
                freguesia       = '$freguesia',
                email           = '$email',
                url_web         = '$web',
                representante   = '$repr',
                email_repres    = '$emailrepr',
                foto            = '$user_img_file',
                username        = '$user'
                pass            = '$hashedpass'
            WHERE nif = '$nif';";

    $vres = mysqli_query($conn, $sqlv);

    $update = array(
      "nome" => $nome,
      "descricao" => $desc,
      "telefone" => $telef,
      "morada" => $morada,
      "distrito" => $distrito,
      "concelho" => $concelho,
      "freguesia" => $freguesia,
      "email" => $email,
      "url_web" => $web,
      "representante" => $repr,
      "email_repres" => $emailrepr,
      "username" => $user
    );

    $varray = array_replace($varray, $update);
    $_SESSION["fetch"] = $varray;

    $_SESSION["msg"] = "Alteração bem Sucedida";

    header('Location: inst_profile.php');
  } else {
    header('Location: inst_profile.php');
  }
