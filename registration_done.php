<!doctype html>

<?php mysqli_query($conn, "set names 'utf8'"); ?>
<?php session_start(); ?>

<html>

<html lang="en">

<head>
    <title>VoluntárioCOVID19 | Registo Efetuado com Sucesso</title>

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

                        <h1 class="heading mb-3">Registo efetuado com sucesso!</h1>

                        <p class="mb-5">Pode regressar à página inicial, ou efetuar login para aceder à sua área. </p>
                        <p class="mb-4">
                            <a href="index.php" class="btn btn-secondary">Voltar</a>
                            <a href="login.php" class="btn btn-primary">Login</a>
                        </p>


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

</body>

</html>