<!DOCTYPE html>
<?php

include "openconn.php";

session_start();
if ($_SESSION['volunteerLoggedIn'] == true or isset($_SESSION['volunteerLoggedIn']) && $_SESSION['institutionLoggedIn'] == false) {
    header('location: index.php');
}

mysqli_query($conn, "set names 'utf8'");

$varray = $_SESSION["fetch"];

?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VoluntárioCOVID19 | Perfil</title>

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

    <style type="text/css">
        
        /**
 * Profile
 */
        /*** Profile: Header  ***/
        .profile__avatar {
            float: left;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 20px;
            overflow: hidden;
        }

        @media (min-width: 768px) {
            .profile__avatar {
                width: 100px;
                height: 100px;
            }
        }

        /*** Profile: Recent activity ***/
        .profile-comments__item {
            position: relative;
            padding: 15px 16px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .profile-comments__item:last-child {
            border-bottom: 0;
        }
        
        .profile-comments__avatar {
            display: block;
            float: left;
            margin-right: 20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
        }

        .profile-comments__avatar>img {
            width: 100%;
            height: auto;
        }

    </style>

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

        <div class="site-section login">
            <div class="container">

                <div class="site-wrap">
                    <div class="site-mobile-menu site-navbar-target">
                        <div class="site-mobile-menu-header">
                            <div class="site-mobile-menu-close mt-3">
                                <span class="icon-close2 js-menu-toggle"></span>
                            </div>
                        </div>

                        <div class="site-mobile-menu-body"></div>
                    </div>

                    <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;">
                        <a href="#" class="site-menu-toggle js-menu-toggle float-right">
                            <span class="icon-menu h3 text-black"></span>
                        </a>
                    </div>
                </div>
            </div>
            </header>

            <div class="site-section">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-9">

                            <!-- User profile -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Perfil</h4>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="panel-body">
                                    <div class="profile__avatar">
                                        <?php
                                        if ($varray["foto"] != "Sem Logotipo") {
                                            echo "<img src = " . $varray["foto"] . " id = 'photo' class='img-fluid'>";
                                        } else {
                                            echo '<img src="images/default_logo.png" id="photo" class="img-fluid">';
                                        }
                                        ?>
                                    </div>
                                    <div class="profile__header">
                                        <h4><?php echo ($varray["nome"]); ?> <small>Instituição</small></h4>
                                        <p class="text-muted">
                                            <?php echo ($varray["descricao"]); ?>
                                        </p>
                                        <p>
                                            <a href="#"></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <br>
                                <br>
                                <br>

                            <!-- User info -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Detalhes</h4>
                                </div>
                                <div class="panel-body">
                                    <table class="table profile__table">
                                        <tbody>
                                            <tr>
                                                <th><strong>Username</strong></th>
                                                <td><?php echo ($varray["username"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th><strong>Nº de Identificação Fiscal</strong></th>
                                                <td><?php echo ($varray["nif"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th><strong>Telefone</strong></th>
                                                <td><?php echo ($varray["telefone"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th><strong>E-mail Instituição</strong></th>
                                                <td><?php echo ($varray["email_inst"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th><strong>Representante</strong></th>
                                                <td><?php echo ($varray["representante"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th><strong>E-mail Representante</strong></th>
                                                <td><?php echo ($varray["email_repres"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th><strong>Distrito</strong></th>
                                                <td><?php echo ($varray["distrito"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th><strong>Concelho</strong></th>
                                                <td><?php echo ($varray["concelho"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th><strong>Freguesia</strong></th>
                                                <td><?php echo ($varray["freguesia"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th><strong>Morada</strong></th>
                                                <td><?php echo ($varray["morada"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th><strong>URL</strong></th>
                                                <td><?php if ($varray["url_web"] == NULL) {
                                                        echo ('Não definido');
                                                    } else {
                                                        echo ($varray["url_web"]);
                                                    }
                                                    ?></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <br>
                                <br>

                            <!-- Community -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Informações</h4>
                                </div>
                                <div class="panel-body">
                                    <table class="table profile__table">
                                        <tbody>
                                            <tr>
                                                <th><strong>Número de Ações Realizadas</strong></th>
                                                <td> 12 </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <br>
                                <br>

                            <!-- Latest posts -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Histórico de Ações de Voluntariado</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="profile__comments">
                                        <div class="profile-comments__item">
                                            <div class="profile-comments__controls">
                                                <a href="#"><i class="fa fa-share-square-o"></i></a>
                                                <a href="#"><i class="fa fa-edit"></i></a>
                                                <a href="#"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                            <div class="profile-comments__avatar">
                                                <img src="https://scontent.flis10-1.fna.fbcdn.net/v/t1.6435-9/46736134_2055155037840016_8301320383210979328_n.png?_nc_cat=110&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeF9n1NeRmbpH8VNt3gP5qwJVJmKrwKxsjxUmYqvArGyPMt307b8TIctPG_OY9RvYvYMphnb9npuPbca-9rgO9c8&_nc_ohc=BNrsyUyACPwAX9EhELf&_nc_ht=scontent.flis10-1.fna&oh=fdd5db85bba47e5270a27a62cd957528&oe=60B5460F" alt="...">
                                            </div>
                                            <div class="profile-comments__body">
                                                <h5 class="profile-comments__sender">
                                                    Banco Alimentar <small>2 meses</small>
                                                </h5>
                                                <div class="profile-comments__content">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, corporis. Voluptatibus odio perspiciatis non quisquam provident, quasi eaque officia.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-comments__item">
                                            <div class="profile-comments__controls">
                                                <a href="#"><i class="fa fa-share-square-o"></i></a>
                                                <a href="#"><i class="fa fa-edit"></i></a>
                                                <a href="#"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                            <div class="profile-comments__avatar">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Logo_CVP.svg/2560px-Logo_CVP.svg.png" alt="...">
                                            </div>
                                            <div class="profile-comments__body">
                                                <h5 class="profile-comments__sender">
                                                    Cruz Vermelha Portuguesa <small> 1 mês </small>
                                                </h5>
                                                <div class="profile-comments__content">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero itaque dolor laboriosam dolores magnam mollitia, voluptatibus inventore accusamus illo.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-comments__item">
                                            <div class="profile-comments__controls">
                                                <a href="#"><i class="fa fa-share-square-o"></i></a>
                                                <a href="#"><i class="fa fa-edit"></i></a>
                                                <a href="#"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                            <div class="profile-comments__avatar">
                                                <img src="https://scontent.flis10-1.fna.fbcdn.net/v/t31.18172-8/12094882_690990051001007_767649862345912552_o.jpg?_nc_cat=111&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeF-_XxIFHYmkdcSuqN9QSU9dXHz2HDz92Z1cfPYcPP3Zj00DwR4tjDxNMsTGXfk-83_Z3dV_lRa7UHd9N0trah-&_nc_ohc=BeUV_fUIZxYAX__3G68&_nc_ht=scontent.flis10-1.fna&oh=f9e0981023e8b88f88d20702943372b5&oe=60B42710" alt="...">
                                            </div>
                                            <div class="profile-comments__body">
                                                <h5 class="profile-comments__sender">
                                                    Canil Aroeira <small> 2 semanas </small>
                                                </h5>
                                                <div class="profile-comments__content">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, esse, magni aliquam quisquam modi delectus veritatis est ut culpa minus repellendus.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-3">

                            <!-- Contact user -->
                            <p>
                                <?php
                                // Botão do Perfil da Instituição - Caso Instituição esteja Logged In
                                if (isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
                                    echo '<a href="inst_profile_edit.php" class="btn btn-primary">Editar Perfil</a> <br>';
                                } else {
                                    echo '<a href="chat.php" class="btn btn-primary">Chat</a> <br>';
                                }

                                if (isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
                                    echo '<br> <a href="proj_form.php" class="btn btn-secondary">Criar Projeto</a>';
                                }
                                ?>
                            </p>


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
            <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
            <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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