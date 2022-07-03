<?php

include "openconn.php";

session_start();

mysqli_query($conn, "set names 'utf8'");

$varray = $_SESSION["fetch"];
$nif = $varray["nif"];

$imgdirectory   = "images/users/"; // Diretoria onde é efetuado o upload

// Upload da imagem para o servidor
$imageFileType = strtolower(pathinfo(basename($_FILES['logo']["name"]),PATHINFO_EXTENSION));    // Buscar ficheiro + Tipo de imagem (.PNG, .JPEG, ...)
$user_img_file = $imgdirectory . $nif . "." . $imageFileType;    // Diretoria + CC + Tipo de Imagem
if ($_FILES['logo']["name"] != "") {
  unlink($varray["foto"]);
  if (move_uploaded_file($_FILES['logo']["tmp_name"], $user_img_file)) {   // Upload do ficheiro
    $_SESSION["userimg"] = "The file " . htmlspecialchars(basename($_FILES['logo']["name"])) . " has been uploaded.";
  } else {
    $_SESSION["imsg"] = "Submissão de Logotipo sem Sucesso";
    $_SESSION["userimg"] = "There was an error uploading your file.";
  }
} else {
  $user_img_file = "Sem Logotipo";
}

$sqluf = "UPDATE V_instituicao SET foto = '$user_img_file' WHERE nif = '$nif';";

$ires = mysqli_query($conn, $sqluf);
header('Location: inst_profile.php');
?>
