<!DOCTYPE html>
<?php

include "openconn.php";

session_start();
if ($_SESSION['volunteerLoggedIn'] == false or isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
    header('location: index.php');
}

mysqli_query($conn, "set names 'utf8'");

$varray = $_SESSION["fetch"];

// Variáveis para obter a População Alvo selecionada pelo Voluntário
$alvo = "   SELECT *
                FROM V_voluntario, V_vol_alvo
                WHERE V_voluntario.cc = V_vol_alvo.voluntario
                AND V_voluntario.cc = " . $varray["cc"] . ";";

$result_alvo = mysqli_query($conn, $alvo);

$checkalvo = array();
while ($v_alvo = mysqli_fetch_array($result_alvo, MYSQLI_NUM)) {
    array_push($checkalvo, $v_alvo[17]);
}

// Variáveis para obter as Areas de Interesse selecionadas pelo Voluntário
$area = "   SELECT *
                FROM V_voluntario, V_vol_area
                WHERE V_voluntario.cc = V_vol_area.voluntario
                AND V_voluntario.cc = " . $varray["cc"] . ";";

$result_area = mysqli_query($conn, $area);

$checkarea = array();
while ($v_area = mysqli_fetch_array($result_area, MYSQLI_NUM)) {
    array_push($checkarea, $v_area[17]);
}

// Variáveis para obter o Horário selecionado pelo Voluntário
$horario = "    SELECT *
                    FROM V_voluntario, V_vol_horario
                    WHERE V_voluntario.cc = V_vol_horario.voluntario
                    AND V_voluntario.cc = V_vol_horario.voluntario
                    AND V_voluntario.cc = " . $varray["cc"] . ";";

$result_horario = mysqli_query($conn, $horario);

$checkperiodo = array('', '', '', '', '', '', '');

while ($v_horario = mysqli_fetch_array($result_horario, MYSQLI_NUM)) {

    if ($v_horario[17] == "2ª Feira") {
        $checkperiodo[0] = $checkperiodo[0] . $v_horario[19] . "; ";
    } else if ($v_horario[17] == "3ª Feira") {
        $checkperiodo[1] = $checkperiodo[1] . $v_horario[19] . "; ";
    } else if ($v_horario[17] == "4ª Feira") {
        $checkperiodo[2] = $checkperiodo[2] . $v_horario[19] . "; ";
    } else if ($v_horario[17] == "5ª Feira") {
        $checkperiodo[3] = $checkperiodo[3] . $v_horario[19] . "; ";
    } else if ($v_horario[17] == "6ª Feira") {
        $checkperiodo[4] = $checkperiodo[4] . $v_horario[19] . "; ";
    } else if ($v_horario[17] == "Sábado") {
        $checkperiodo[5] = $checkperiodo[5] . $v_horario[19] . "; ";
    } else {
        $checkperiodo[6] = $checkperiodo[6] . $v_horario[19] . "; ";
    }
}


// Função para pesquisar de modo recursivo por
// dada chave=>valor
function search($array, $key, $value)
{
    $results = array();

    // if it is array
    if (is_array($array)) {

        // if array has required key and value
        // matched store result
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        // Iterate for each element in array
        foreach ($array as $subarray) {

            // recur through each element and append result
            $results = array_merge(
                $results,
                search($subarray, $key, $value)
            );
        }
    }

    return $results;
}

?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VoluntárioCOVID19 | EDITAR </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/png" href="images/favicon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="fonts/flaticon-covid/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signform.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!--mais conteudo aqui-->

</head>

<header class="site-navbar light js-sticky-header site-navbar-target" role="banner">

    <div class="container">
        <div class="row align-items-center">

            <div class="col-6 col-xl-2">
                <div>
                    <a href="index.php"><img src="images/favicon.png" alt="VoluntárioCOVID's logo" id="logo"></a>
                </div>
            </div>

            <div class="col-12 col-md-10 d-none d-xl-block">
                <nav class="site-navigation position-relative text-right" role="navigation">

                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        <li class="active"><a href="index.php" class="nav-link">HOME</a></li>
                        <li><a href="about.php" class="nav-link">Sobre Nós</a></li>
                        <?php
                        // Botão do Perfil do Voluntário - Caso Voluntário esteja Logged In
                        if (isset($_SESSION['volunteerLoggedIn']) && $_SESSION['volunteerLoggedIn'] == true) {
                            echo '<li><a href="vol_profile.php" class="nav-link">Perfil</a></li>';
                        }
                        ?>
                        <?php
                        // Botão para Área Privada do Voluntário - Caso Voluntário esteja Logged In
                        if (isset($_SESSION['volunteerLoggedIn']) && $_SESSION['volunteerLoggedIn'] == true) {
                            echo '<li><a href="vol_private.php" class="nav-link">Área Privada</a></li>';
                        }
                        ?>
                        <?php
                        // Botão do Perfil da Instituição - Caso Instituição esteja Logged In
                        if (isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
                            echo '<li><a href="inst_profile.php" class="nav-link">Perfil</a></li>';
                        }
                        ?>
                        <?php
                        // Botão para Área Privada da Instituição - Caso Instituição esteja Logged In
                        if (isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
                            echo '<li><a href="inst_private.php" class="nav-link">Área Privada</a></li>';
                        }
                        ?>
                        <?php
                        // Botão para novos Projetos da Instituição - Caso Instituição esteja Logged In
                        if (isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
                            echo '<li><a href="proj_form.php" class="nav-link">Criar Projeto</a></li>';
                        }
                        ?>
                        <?php
                        // Botão de Chat - Consoante o Estado da Sessão                                            
                        if (
                            isset($_SESSION['volunteerLoggedIn']) && $_SESSION['volunteerLoggedIn'] == true
                            or isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true
                        ) {
                            echo '<li><a href="chat_users.php" class="btn-primary" id="chat-nav">Chat</a></li>';
                        }

                        // Botão de Login ou Logout - Consoante o Estado da Sessão                                            
                        if (
                            isset($_SESSION['volunteerLoggedIn']) && $_SESSION['volunteerLoggedIn'] == true
                            or isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true
                        ) {
                            echo '<li><a href="logout.php" class="nav-link" id="log-nav">Logout</a></li>';
                        } else {
                            echo '<li><a href="login.php" class="nav-link" id="log-nav">Login</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>


            <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3 text-black"></span></a></div>

        </div>
    </div>

</header>





<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div class="site-wrap">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>

            <div class="site-mobile-menu-body"></div>
        </div>

        <div class="hero-v1 hero-v1-reduced"></div>

        <!-- MAIN -->
        <div class="site-section login">
            <div class="container">
                <div class="row gutters">
                    <div class="col-xl-3 col-lg-3 col-md-8 col-sm-8 col-8">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="account-settings">
                                    <div class="user-profile">
                                        <div class="user-avatar">
                                          <div class="profile-pic-div">
                                            <?php
                                            if ($varray["foto"] != "Sem Logotipo") {
                                              echo "<img src = ". $varray["foto"] ." id = 'photo' class='img-fluid'>";
                                            } else {
                                              echo '<img src="images/default_avatar.png" id="photo" class="img-fluid">';
                                            }
                                            ?>
                                          </div>
                                            <br>
                                          <form action="vol_photo.php" method="post" enctype="multipart/form-data">
                                            <input style="margin-bottom: 1rem;" type="file" id="uploadBtn" name="avatar">
                                            <input type="submit" class="btn btn-secondary" value="Upload">
                                          </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <form action="vol_update.php" method="post" class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="mb-2 text-primary">Detalhes Pessoais</h6>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="vuser">Username</label>
                                                <input type="text" class="form-control" name="vuser" placeholder="Insira Username *" <?php echo ('value ="' .  $varray["username"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="vnome">Nome Completo</label>
                                                <input type="text" class="form-control" name="vnome" placeholder="Insira Nome Completo" <?php echo ('value ="' .  $varray["nome"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="cc">Nº Identificação (CC)</label>
                                                <input type="text" class="form-control" name="cc" placeholder="Insira Nº Identificação (CC) *" <?php echo ('value ="' .  $varray["cc"] . '"'); ?> disabled>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="data">Data de Nascimento</label>
                                                <input type="text" class="form-control" name="data" placeholder="aaaa-mm-dd" <?php echo ('value ="' .  $varray["nascimento"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="vemail">Email</label>
                                                <input type="email" class="form-control" name="vemail" placeholder="Insira Email *" <?php echo ('value ="' .  $varray["email"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="vtele">Telemóvel</label>
                                                <input type="text" class="form-control" name="vtele" placeholder="Insira Telemóvel" <?php echo ('value ="' .  $varray["telemovel"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="vdistrito">Distrito</label>
                                                <input type="name" class="form-control" name="vdistrito" placeholder="Insira Distrito" <?php echo ('value ="' .  $varray["distrito"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="vconcelho">Concelho</label>
                                                <input type="name" class="form-control" name="vconcelho" placeholder="Insira Concelho" <?php echo ('value ="' .  $varray["concelho"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="vfreguesia">Freguesia</label>
                                                <input type="name" class="form-control" name="vfreguesia" placeholder="Insira Freguesia" <?php echo ('value ="' .  $varray["freguesia"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="vpass">Password</label>
                                                <input type="password" class="form-control" name="vpass" placeholder="Alterar Password">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="text-right">
                                                <!-- <button type="button" id="cancel" name="cancel" class="btn ">Cancel</button> -->
                                                <button type="submit" id="submit" name="submit" class="btn btn-primary" value="Update">Atualizar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form action="vol_inserts.php" method="post" class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <br>
                                            <h3>
                                            </h3>

                                            <h6 class="mb-2 text-primary">Preferências</h6>

                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="carta">Carta de Condução</label><br>
                                                <input type="radio" id="carta" name="carta" value="1" <?php if ($varray["carta"] == '1') {
                                                                                                            echo ('checked');
                                                                                                        }
                                                                                                        ?>>
                                                <label for="carta">Tem</label>
                                                <input type="radio" id="ncarta" name="carta" value="0" <?php if ($varray["carta"] == '0') {
                                                                                                            echo ('checked');
                                                                                                        }
                                                                                                        ?>>
                                                <label for="ncarta">Não tem</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="pop_alvo">População Alvo</label><br>
                                            <input type="checkbox" id="CRI" name="pop_criancas" value="Crianças" <?php if (in_array("Crianças", $checkalvo)) {
                                                                                                                        echo ('checked');
                                                                                                                    }
                                                                                                                    ?>>
                                            <label for="Crianças">Crianças</label><br>
                                            <input type="checkbox" id="Jovens" name="pop_jovens" value="Jovens" <?php if (in_array("Jovens", $checkalvo)) {
                                                                                                                    echo ('checked');
                                                                                                                }

                                                                                                                ?>>
                                            <label for="Jovens">Jovens</label><br>
                                            <input type="checkbox" id="Adultos" name="pop_adultos" value="Adultos" <?php if (in_array("Adultos", $checkalvo)) {
                                                                                                                        echo ('checked');
                                                                                                                    }

                                                                                                                    ?>>
                                            <label for="Adultos">Adultos</label><br>
                                            <input type="checkbox" id="Idosos" name="pop_idosos" value="Idosos" <?php if (in_array("Idosos", $checkalvo)) {
                                                                                                                    echo ('checked');
                                                                                                                }

                                                                                                                ?>>
                                            <label for="Idosos">Idosos</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="area_int">Áreas de Interesse</label><br>
                                            <input type="checkbox" id="Saúde" name="area_saude" value="Saúde" <?php if (in_array("Saúde", $checkarea)) {
                                                                                                                    echo ('checked');
                                                                                                                }

                                                                                                                ?>>
                                            <label for="Saúde">Saúde</label><br>
                                            <input type="checkbox" id="Logística" name="area_logistica" value="Logística" <?php if (in_array("Logística", $checkarea)) {
                                                                                                                                echo ('checked');
                                                                                                                            }

                                                                                                                            ?>>
                                            <label for="Logística">Logística</label><br>
                                            <input type="checkbox" id="Educação" name="area_educacao" value="Educação" <?php if (in_array("Educação", $checkarea)) {
                                                                                                                            echo ('checked');
                                                                                                                        }

                                                                                                                        ?>>
                                            <label for="Educação">Educação</label><br>
                                            <input type="checkbox" id="Ação Social" name="area_social" value="Ação Social" <?php if (in_array("Ação Social", $checkarea)) {
                                                                                                                                echo ('checked');
                                                                                                                            }

                                                                                                                            ?>>
                                            <label for="Ação Social">Ação Social</label>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <label for="data">Disponibilidade</label>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="data_in">Data de início</label>
                                                <input type="date" id="data_in" name="data_in" class="form-control" min="2021-01-01" max="2025-12-31">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="data_fim">Data de fim</label>
                                                <input type="date" id="data_fim" name="data_fim" class="form-control" min="2021-01-01" max="2025-12-31">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Horário</label><br>

                                            <label>2ª feira</label>
                                            <input type="checkbox" id="2fm" name="2fm" value="Manhã">
                                            <label for="2m">Manhã</label>
                                            <input type="checkbox" id="2ft" name="2ft" value="Tarde">
                                            <label for="2t">Tarde</label>
                                            <input type="checkbox" id="2fn" name="2fn" value="Noite">
                                            <label for="2n">Noite</label><br>

                                            <label>3ª feira</label>
                                            <input type="checkbox" id="3fm" name="3fm" value="Manhã">
                                            <label for="3m">Manhã</label>
                                            <input type="checkbox" id="3ft" name="3ft" value="Tarde">
                                            <label for="3t">Tarde</label>
                                            <input type="checkbox" id="3fn" name="3fn" value="Noite">
                                            <label for="3n">Noite</label><br>

                                            <label>4ª feira</label>
                                            <input type="checkbox" id="4fm" name="4fm" value="Manhã">
                                            <label for="4m">Manhã</label>
                                            <input type="checkbox" id="4ft" name="4ft" value="Tarde">
                                            <label for="4t">Tarde</label>
                                            <input type="checkbox" id="4fn" name="4fn" value="Noite">
                                            <label for="4n">Noite</label><br>

                                            <label>5ª feira</label>
                                            <input type="checkbox" id="5fm" name="5fm" value="Manhã">
                                            <label for="5m">Manhã</label>
                                            <input type="checkbox" id="5ft" name="5ft" value="Tarde">
                                            <label for="5t">Tarde</label>
                                            <input type="checkbox" id="5fn" name="5fn" value="Noite">
                                            <label for="5n">Noite</label><br>

                                            <label>6ª feira</label>
                                            <input type="checkbox" id="6fm" name="6fm" value="Manhã">
                                            <label for="6m">Manhã</label>
                                            <input type="checkbox" id="6ft" name="6ft" value="Tarde">
                                            <label for="6t">Tarde</label>
                                            <input type="checkbox" id="6fn" name="6fn" value="Noite">
                                            <label for="6n">Noite</label><br>

                                            <label>Sábado</label>
                                            <input type="checkbox" id="sabm" name="sabm" value="Manhã">
                                            <label for="sm">Manhã</label>
                                            <input type="checkbox" id="sabt" name="sabt" value="Tarde">
                                            <label for="st">Tarde</label>
                                            <input type="checkbox" id="sabn" name="sabn" value="Noite">
                                            <label for="sn">Noite</label><br>

                                            <label>Domingo</label>
                                            <input type="checkbox" id="domm" name="domm" value="Manhã">
                                            <label for="dm">Manhã</label>
                                            <input type="checkbox" id="domt" name="domt" value="Tarde">
                                            <label for="dt">Tarde</label>
                                            <input type="checkbox" id="domn" name="domn" value="Noite">
                                            <label for="dn">Noite</label><br>
                                        </div>
                                    </div>

                            </div>

                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <!-- <button type="button" id="cancel" name="cancel" class="btn ">Cancel</button> -->
                                        <button type="submit" id="submit" name="submit" class="btn btn-primary" value="Update">Atualizar</button>
                                    </div>
                                </div>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <h2 class="footer-heading mb-4">SEGUE-NOS POR AQUI!</h2>
                        <div>
                            <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                            <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                            <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                            <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <h2 class="footer-heading mb-4">Links Rápidos</h2>
                                <ul class="list-unstyled">
                                    <li><a href="#">Ações de Voluntariado</a></li>
                                    <li><a href="faqs.html">FAQs</a></li>
                                    <li><a href="about.php">Sobre Nós</a></li>
                                    <li><a href="contact.html">Contactos</a></li>
                                </ul>
                            </div>

                            <div class="col-lg-4">
                                <h2 class="footer-heading mb-4">Recursos</h2>
                                <ul class="list-unstyled">
                                    <li><a href="#">Site da OMS</a></li>
                                    <li><a href="https://covid19.min-saude.pt/">Site COVID-19</a></li>
                                    <li><a href="https://www.dgs.pt/">Site da DGS</a></li>
                                    <li><a href="https://www.sns.gov.pt/?cpp=1">Site do SNS</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="border-top pt-5">
                            <p><small>ASW001</p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    </div> <!-- .site-wrap -->

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>


    <script src="js/main.js"></script>

    <script>
    const imgDiv = document.querySelector('.profile-pic-div');
    const img = document.querySelector('#photo');
    const uploadBtn = document.querySelector('#uploadBtn');

    uploadBtn.addEventListener('change', function(){
      const choosedFile = this.files[0];

      if (choosedFile) {

          const reader = new FileReader();

          reader.addEventListener('load', function(){
              img.setAttribute('src', reader.result);
          });

          reader.readAsDataURL(choosedFile);
      }
    });
    </script>

</body>

</html>
