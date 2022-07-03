<!doctype html>
<?php

    include "openconn.php";

    session_start();
    
?>

<html lang="en">
    <head>
        
        <title>VoluntárioCOVID19 | Login</title>
        
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
                                                                                    
                                    if (isset($_SESSION['volunteerLoggedIn']) && $_SESSION['volunteerLoggedIn'] == true 
                                        OR isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
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
                    <div class="row">
                        <div class="col-md-12 login-right">
                            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Voluntário</a>
                                </li>
    
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Instituição</a>
                                </li>
                            </ul>
                        
                            <div class="tab-content" id="myTabContent">
                                <form action="vol_login.php" method="post" class="tab-pane fade show active needs-validation" id="home" role="tabpanel" aria-labelledby="home-tab" novalidate>
                                    <h3 class="login-heading">Login de Voluntários</h3>
                        
                                    <div class="row login-form">
                                        <div class="col-sm-3"></div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group border rounded">
                                                Username ou e-mail:
    
                                                <input type="text" name="vuser" class="form-control" placeholder="Introduza o seu username ou e-mail" required>
                                            </div>
                                            
                                            <div class="form-group border rounded">
                                                Password:
                                    
                                                <input type="password" name="vpass" class="form-control" placeholder="Introduza a sua password" required>
                                            </div>
                            
                                            <div class="col-sm-4"></div>
                                            
                                            <a href="registration.php" class="nav-link" id="reg-nav">Novo registo</a>
                                            <input type="submit" class="btn-login" value="Login">
                                        </div>
                            
                                        <div class="col-sm-3"></div>
                                    </div>
                                </form>
                                    <!--LIV NOTE: LOGIN LEFT MAKES IMG JUMP-->
                                <form action="inst_login.php" method="post" class="tab-pane fade show" class="needs-validation" id="profile" role="tabpanel" aria-labelledby="profile-tab" novalidate>
                                    <h3 class="login-heading">Login de Instituições</h3>
                        
                                    <div class="row login-form">
                                        <div class="col-sm-3"></div>
        
                                        <div class="col-md-6">
                                            <div class="form-group border rounded">
                                                Username ou e-mail:
    
                                                <input type="text" name="iuser" class="form-control" placeholder="Introduza o seu username ou e-mail" required>
                                            </div>
                                            
                                            <div class="form-group border rounded">
                                                Password:
                                    
                                                <input type="password" name="ipass" class="form-control" placeholder="Introduza a sua password" required>
                                            </div>
                                        
                                            <div class="col-sm-4"></div>

                                            <a href="registration.php"  class="nav-link" id="reg-nav">Novo registo</a>
                                            <input type="submit" class="btn-login" value="Login">
                                        </div>

                                        <div class="col-sm-3"></div>
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

