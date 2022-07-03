<!doctype html>
<?php

include "openconn.php";

session_start();

?>

<html lang="en">

<head>
    <title>VoluntárioCOVID19 | Login Admin</title>

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
</head>

<header class="site-navbar light js-sticky-header site-navbar-target" role="banner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6 col-xl-2">
          <div>
            <a href="admin.php"><img src="images/favicon.png" alt="VoluntárioCOVID's logo" id="logo"></a>
          </div>
        </div>

        <div class="col-12 col-md-10 d-none d-xl-block">
          <nav class="site-navigation position-relative text-right" role="navigation">
            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
              <?php
                if (isset($_SESSION['adminLoggedIn']) && $_SESSION['adminLoggedIn'] == true) {
                  echo '<li><a href="admin.php" class="nav-link">Administração</a></li>';
                  echo '<li><a href="admin_logout.php" class="nav-link" id="log-nav-admin">Logout Admin</a></li>';
                } else {
                  echo '<li><li><a href="admin_login.php" class="nav-link" id="log-nav-admin">Login Admin</a></li>';
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

        <div class="hero-v1 hero-v1-reduced hero-v1-admin"></div>

        <div class="site-section login">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 login-right">
                        <div class="tab-content" id="myTabContent">
                            <form action="admin_login_process.php" method="post" class="tab-pane fade show active" class="needs-validation" id="home" role="tabpanel" aria-labelledby="home-tab" novalidate>
                                <h3 class="login-heading">Login de Administrador</h3>

                                <div class="row login-form">
                                    <div class="col-sm-3"></div>

                                    <div class="col-md-6">
                                        <div class="form-group border rounded">
                                            Username ou Email:
                                            <input type="text" name="auser" class="form-control" placeholder="Introduza o seu Username ou Email" required>
                                        </div>

                                        <div class="form-group border rounded">
                                            Password:
                                            <input type="password" name="apass" class="form-control" placeholder="Introduza a sua Password" required>
                                        </div>

                                        <div class="col-sm-4"></div>

                                        <input type="submit" class="btn-login btn-login-admin" value="Login">
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
                  <li><a href="about.html">Sobre Nós</a></li>
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
                <p><small>ASW001</small>small></p>
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