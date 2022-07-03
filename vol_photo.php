<?php

include "openconn.php";

session_start();

mysqli_query($conn, "set names 'utf8'");

$varray = $_SESSION["fetch"];
$cc = $varray["cc"];

$imgdirectory   = "images/users/"; // Diretoria onde é efetuado o upload

// Upload da imagem para o servidor
$imageFileType = strtolower(pathinfo(basename($_FILES['avatar']["name"]),PATHINFO_EXTENSION));    // Buscar ficheiro + Tipo de imagem (.PNG, .JPEG, ...)
$user_img_file = $imgdirectory . $cc . "." . $imageFileType;    // Diretoria + CC + Tipo de Imagem
if ($_FILES['avatar']["name"] != "") {
   unlink($varray["foto"]);
  if (move_uploaded_file($_FILES['avatar']["tmp_name"], $user_img_file)) {   // Upload do ficheiro
    $_SESSION["userimg"] = "The file " . htmlspecialchars(basename($_FILES['avatar']["name"])) . " has been uploaded.";
  } else {
    $_SESSION["imsg"] = "Submissão de Logotipo sem Sucesso";
    $_SESSION["userimg"] = "There was an error uploading your file.";
  }
}
$sqluf = "UPDATE V_voluntario SET foto = '$user_img_file' WHERE cc = '$cc';";
$ires = mysqli_query($conn, $sqluf);

header('Location: vol_profile.php');

?>
