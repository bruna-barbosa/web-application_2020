<!DOCTYPE html>
<?php
include "openconn.php";
session_start();
$varray = $_SESSION["fetch"];
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VoluntárioCOVID19 | CHAT</title>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">

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
    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Carregando...</span>
        </div>
    </div>
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

        <div class="site-section login">
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <div class="container">


                <!--CONTENT-->


            </div>
        </div>
    </div>
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
</body>

</html>