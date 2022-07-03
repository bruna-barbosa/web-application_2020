<!doctype html>

<?php

include "openconn.php";

session_start();
if ($_SESSION['adminLoggedIn'] == false) {
  header('location: admin_logout.php');
}
?>

<html lang="en">

<head>
  <title>VoluntárioCOVID19 | Pesquisa</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="icon" type="image/png" href="images/favicon.png" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700;900&display=swap">
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <style>
    * {
      box-sizing: border-box;
    }

    .myInput {
      background-image: url('/css/searchicon.png');
      background-position: 10px 10px;
      background-repeat: no-repeat;
      margin: 0px 3px 0px 3px;
      font-size: 16px;
      padding: 12px 20px 12px 40px;
      border: 1px solid #ddd;
      margin-bottom: 12px;
    }

    #myTable {
      border-collapse: collapse;
      width: 95%;
      border: 1px solid #ddd;
      font-size: 18px;
    }

    #myTable th,
    #myTable td {
      text-align: left;
      padding: 12px;
    }

    #myTable tr {
      border-bottom: 1px solid #ddd;
    }

    #myTable tr.header,
    #myTable tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>

  <header class="site-navbar light js-sticky-header site-navbar-target" role="banner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6 col-xl-2">
          <div>
            <a href="admin_index.php"><img src="images/favicon.png" alt="VoluntárioCOVID's logo" id="logo"></a>
          </div>
        </div>

        <div class="col-12 col-md-10 d-none d-xl-block">
          <nav class="site-navigation position-relative text-right" role="navigation">
            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
              <?php
                if (isset($_SESSION['adminLoggedIn']) && $_SESSION['adminLoggedIn'] == true) {
                  echo '<li><a href="admin_index.php" class="nav-link">Administração</a></li>';
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

    <!-- MAIN -->

    <div class="site-section">
          <div class="text-center mx-auto" style="overflow-x:auto;">
            <!-- INVOCAÇÃO DAS FUNÇÔES DE PESQUISA PARA VOLUNTÁRIOS 
                                OU INSTITUIÇÕES -->
            <?php
            // Seleção do tipo de pesquisa a efetuar
            $vol =  $_POST["Filtrar_vol"];
            $inst = $_POST["Filtrar_inst"];
            $proj = $_POST["Filtrar_proj"];
            $cand = $_POST["Filtrar_cand"];

            // seleção do ficheiro que irá efetuar a pesquisas
            // pesquisa de Voluntários ou instituições
            if ($vol == "Filtrar Voluntários") {
              echo '<h2 class="section-heading-admin">Pesquisa de Voluntários</h2>';
              include "admin_volunteers_table.php";
            } elseif ($inst == "Filtrar Instituições") {
              echo '<h2 class="section-heading-admin">Pesquisa de Instituições</h2>';
              include "admin_institutions_table.php";
            } elseif ($proj == "Filtrar Ações") {
              echo '<h2 class="section-heading-admin">Pesquisa de Ações</h2>';
              include "admin_projects_table.php";
            } elseif ($cand == "Filtrar Candidaturas") {
              echo '<h2 class="section-heading-admin">Pesquisa de Candidaturas</h2>';
              include "admin_applications_table.php";
            }
            ?>
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

  <script src="js/admin_volunteers.js"></script>
  <script src="js/admin_instituition.js"></script>
  <script src="js/admin_projects.js"></script>
  <script src="js/admin_aplications.js"></script>

  <script src="js/filters.js"></script>
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