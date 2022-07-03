<?php

include "openconn.php";

session_start();

mysqli_query($conn, "set names 'utf8'");

$varray = $_SESSION["fetch"];

$_SESSION["msg"] = false;

//Seleção de voluntario da BD através do CC, user, email

$sqluser = "SELECT username FROM V_voluntario
          WHERE username = '$user';";

$sqlemail = "SELECT email FROM V_voluntario
          WHERE email = '$email';";

$vquser = mysqli_query($conn, $sqluser);
$vqemail = mysqli_query($conn, $sqlemail);

$vquser = mysqli_fetch_array($vquser, MYSQLI_NUM);
$vqemail = mysqli_fetch_array($vqemail, MYSQLI_NUM);

//Verificação de campos unicos existentes na base de dados.
if (
    count($vquser) > 0 or
    count($vqemail) > 0
  ){

      $_SESSION["msg"] = "Perfil não actualizado";

      if (count($vquser) > 0) {
        $_SESSION["usermsg"] = "Username Existente";
      }
      if (count($vqemail) > 0) {
        $_SESSION["emailmsg"] = "Email Existente";
      }

    header('location: vol_profile.php');

}

if ($_SESSION["msg"] == false) {

  $nome           = htmlspecialchars($_POST["vnome"]);
  $data           = htmlspecialchars($_POST["data"]);
  $vtelemovel     = htmlspecialchars($_POST["vtele"]);
  $email          = htmlspecialchars($_POST["vemail"]);
  $distrito       = htmlspecialchars($_POST["vdistrito"]);
  $concelho       = htmlspecialchars($_POST["vconcelho"]);
  $freguesia      = htmlspecialchars($_POST["vfreguesia"]);
  $pass           = htmlspecialchars($_POST["vpass"]);
  $user           = htmlspecialchars($_POST["vuser"]);

  $cartaconducao  = $varray["carta"];
  $genero         = $varray["genero"];
  $cartaocidadao  = $varray["cc"];

  // Encriptação da password
  $hashedpass = password_hash($pass, PASSWORD_DEFAULT);


  $sqlv = "UPDATE V_voluntario
          SET nome        = '$nome',
              genero      = '$genero',
              data_nasc   = '$data',
              telemovel   = '$vtelemovel',
              email       = '$email',
              distrito    = '$distrito',
              concelho    = '$concelho',
              freguesia   = '$freguesia',
              username    = '$user'
              pass        = '$hashedpass'
          WHERE cc = '$cartaocidadao';";

  $vres = mysqli_query($conn, $sqlv);

  $imgdirectory   = "images/users/"; // Diretoria onde é efetuado o upload



  $update = array(
    "nome" => $nome,
    "data_nasc" => $data,
    "telemovel" => $vtelemovel,
    "email" => $email,
    "distrito" => $distrito,
    "concelho" => $concelho,
    "freguesia" => $freguesia,
    "username" => $user,
    // "foto" => $user_img_file
  );

  $varray = array_replace($varray, $update);
  $_SESSION["fetch"] = $varray;

  header('Location: vol_profile.php');
}


//para meter vol_profile dentro dos campos apropiados:
//  username e email.
/*
<?php
  if (isset($_SESSION["usermsg"])) {
    echo "<div class = 'text-danger'> " . $_SESSION["usermsg"] . " </div>";
  }
?>
<?php
  if (isset($_SESSION["emailmsg"])) {
    echo "<div class = 'text-danger'> " . $_SESSION["emailmsg"] . " </div>";
  }
?>
*/

?>
