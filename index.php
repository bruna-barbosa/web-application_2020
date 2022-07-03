<!doctype html>

<?php
session_start();
?>

<html lang="en">

<head>
    <title>VoluntárioCOVID19 | HOME</title>

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
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


    <div id="overlayer"></div>

    <div class="loader">
        <div class="spinner-border text-primary" role="status"></div>
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

                    <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;">
                        <a href="#" class="site-menu-toggle js-menu-toggle float-right">
                            <span class="icon-menu h3 text-black"></span>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="hero-v1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mr-auto text-center text-lg-left index1">
                        <span class="d-block subheading">ASW 2020/2021</span>

                        <h1 class="heading mb-3">VoluntárioCOVID19</h1>

                        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel a, nulla incidunt eaque sit praesentium porro consectetur optio!</p>
                        <p class="mb-4"><a href="#" class="btn btn-primary">Inscreve-te Já!</a></p>
                    </div>

                    <div class="col-lg-6">
                        <figure class="illustration">
                            <img src="images/Grupo00.png" alt="Image" class="img-fluid">
                        </figure>
                    </div>

                    <div class="col-lg-6"></div>
                </div>
            </div>
        </div>

        <!-- MAIN -->

        <div class="site-section stats">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-lg-7 text-center mx-auto">
                        <h2 class="section-heading">Coronavírus em Portugal</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, voluptate!</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="data">
                            <span class="icon text-primary">
                                <span class="flaticon-virus"></span>
                            </span>

                            <strong class="d-block number">72 037</strong>

                            <span class="label">Casos Ativos</span>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="data">
                            <span class="icon text-primary">
                                <span class="flaticon-virus"></span>
                            </span>

                            <strong class="d-block number">714 493</strong>

                            <span class="label">Casos Recuperados</span>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="data">
                            <span class="icon text-primary">
                                <span class="flaticon-virus"></span>
                            </span>

                            <strong class="d-block number">16 243</strong>

                            <span class="label">Óbitos</span>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="data">
                            <span class="icon text-primary">
                                <span class="flaticon-virus"></span>
                            </span>

                            <strong class="d-block number">797 005</strong>

                            <span class="label">Vacinas Administradas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <figure class="img-play-vid">
                            <img src="images/Pessoas01.png" alt="Image" class="img-fluid">

                            <div class="absolute-block d-flex">
                                <span class="text">Vê o vídeo</span>

                                <a href="https://www.youtube.com/watch?v=W9nVYM1MePQ" data-fancybox class="btn-play">
                                    <span class="icon-play"></span>
                                </a>
                            </div>
                        </figure>
                    </div>

                    <div class="col-lg-5 ml-auto">
                        <h2 class="mb-4 section-heading">Como podes ajudar?</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex officia quas, modi sit eligendi numquam!</p>

                        <ul class="list-check list-unstyled mb-5">
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Consectetur adipisicing elit</li>
                            <li>Unde doloremque</li>
                        </ul>

                        <p><a href="#" class="btn btn-primary">Saber mais</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-3">
                    <div class="feature-v1 d-flex align-items-center">
                        <div class="icon-wrap mr-3">
                            <span class="flaticon-protection"></span>
                        </div>

                        <div>
                            <h3>Proteção</h3>

                            <span class="d-block">Lorem ipsum dolor sit.</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="feature-v1 d-flex align-items-center">
                        <div class="icon-wrap mr-3">
                            <span class="flaticon-patient"></span>
                        </div>

                        <div>
                            <h3>Prevenção</h3>

                            <span class="d-block">Lorem ipsum dolor sit.</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="feature-v1 d-flex align-items-center">
                        <div class="icon-wrap mr-3">
                            <span class="flaticon-hand-sanitizer"></span>
                        </div>

                        <div>
                            <h3>Tratamentos</h3>

                            <span class="d-block">Lorem ipsum dolor sit.</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="feature-v1 d-flex align-items-center">
                        <div class="icon-wrap mr-3">
                            <span class="flaticon-virus"></span>
                        </div>

                        <div>
                            <h3>Sintomas</h3>

                            <span class="d-block">Lorem ipsum dolor sit.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section bg-primary-light">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-7 mx-auto text-center">
                        <h2 class="mb-4 section-heading">Sintomas de Coronavírus</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex officia quas, modi sit eligendi numquam!</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="symptom d-flex">
                            <div class="img">
                                <img src="images/symptom_high-fever.png" alt="Image" class="img-fluid">
                            </div>

                            <div class="text">
                                <h3>Febre</h3>

                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum ipsum repellendus animi modi iure provident, cupiditate perferendis voluptatem!</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="symptom d-flex">
                            <div class="img">
                                <img src="images/symptom_cough.png" alt="Image" class="img-fluid">
                            </div>

                            <div class="text">
                                <h3>Tosse Seca</h3>

                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla ullam illo laborum repellendus vel esse dolor, sunt exercitationem.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="symptom d-flex">
                            <div class="img">
                                <img src="images/symptoms.png" alt="Image" class="img-fluid">
                            </div>

                            <div class="text">
                                <h3>Cansaço</h3>

                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum esse voluptatum, vel inventore at! Ullam, libero reiciendis amet?</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="symptom d-flex">
                            <div class="img">
                                <img src="images/symptom_headache.png" alt="Image" class="img-fluid">
                            </div>

                            <div class="text">
                                <h3>Perda de Paladar ou Olfato</h3>

                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus autem voluptatem ratione veniam rerum qui quibusdam reprehenderit quis.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-md-center">
                    <div class="col-lg-10">
                        <div class="note row">

                            <div class="col-lg-8 mb-4 mb-lg-0"><strong>Lorem ipsum dolor sit amet:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, eaque.</div>
                            <div class="col-lg-4 text-lg-right">
                                <a href="#" class="btn btn-primary"><span class="icon-phone mr-2 mt-3"></span>SNS24</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-7 mx-auto text-center">
                        <h2 class="mb-4 section-heading">Notícias</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex officia quas, modi sit eligendi numquam!</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="post-entry">
                            <a href="#" class="thumb">
                                <span class="date">30 JAN 2021</span>

                                <img src="images/Pessoas02.png" alt="Image" class="img-fluid">
                            </a>

                            <div class="post-meta text-center">
                                <a href="">
                                    <span class="icon-user"></span>
                                    <span>Admin</span>
                                </a>

                                <a href="#">
                                    <span class="icon-comment"></span>
                                    <span>3 Comentários</span>
                                </a>
                            </div>
                            <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="post-entry">
                            <a href="#" class="thumb">
                                <span class="date">30 JAN 2021</span>

                                <img src="images/Pessoa01.png" alt="Image" class="img-fluid">
                            </a>

                            <div class="post-meta text-center">
                                <a href="">
                                    <span class="icon-user"></span>
                                    <span>Admin</span>
                                </a>

                                <a href="#">
                                    <span class="icon-comment"></span>
                                    <span>3 Comentários</span>
                                </a>
                            </div>
                            <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="post-entry">
                            <a href="#" class="thumb">
                                <span class="date">30 JAN 2021</span>

                                <img src="images/Pessoas05.png" alt="Image" class="img-fluid">
                            </a>

                            <div class="post-meta text-center">
                                <a href="">
                                    <span class="icon-user"></span>
                                    <span>Admin</span>
                                </a>

                                <a href="#">
                                    <span class="icon-comment"></span>
                                    <span>3 Comentários</span>
                                </a>
                            </div>
                            <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
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