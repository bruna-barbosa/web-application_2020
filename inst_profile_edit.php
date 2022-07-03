<!doctype html>
<?php

include "openconn.php";

session_start();
if ($_SESSION['institutionLoggedIn'] == false or isset($_SESSION['volunteerLoggedIn']) && $_SESSION['volunteerLoggedIn'] == true) {
    header('location: index.php');
}

mysqli_query($conn, "set names 'utf8'");
$varray = $_SESSION["fetch"];
?>


<html lang="en">

<head>
    <title>Perfil | VoluntárioCOVID19</title>
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

    <style>

    #photo{
        height: 100%;
        width: 100%;
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
                                if (isset($_SESSION['volunteerLoggedIn']) && $_SESSION['volunteerLoggedIn'] == true
                                    or isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
                                    echo '<li><a href="chat_users.php" class="btn-secondary" id="chat-nav">Chat</a></li>';
                                    }

                                // Botão de Login ou Logout - Consoante o Estado da Sessão
                                if (isset($_SESSION['volunteerLoggedIn']) && $_SESSION['volunteerLoggedIn'] == true or isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
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

        <!-- MAIN -->
        <div class="site-section">
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
                                            if ($varray["foto"] != "Sem imagem") {
                                              echo "<img src = ".$varray["foto"]." id='photo' class='img-fluid'>";
                                            } else {
                                              echo '<img src="images/default_logo.png" id="photo" class="img-fluid"">';
                                            }
                                            ?>
                                          </div>
                                            <br>
                                          <form action="inst_photo.php" method="post" enctype="multipart/form-data">
                                            <input style="margin-bottom: 1rem;" type="file" id="uploadBtn" name="logo">
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
                                <form action="inst_update.php" method="post" class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="mb-2 text-primary">Detalhes</h6>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="iuser">Username</label>
                                                <input type="text" class="form-control" name="user" placeholder="Insira Username *" <?php echo ('value ="' .  $varray["username"] . '"'); ?>>
                                                <?php
                                                  if (isset($_SESSION["iusermsg"])) {
                                                    echo "<div class = 'text-danger'> " . $_SESSION["iusermsg"] . " </div>";
                                                  }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="inome">Nome Completo</label>
                                                <input type="text" class="form-control" name="inome" placeholder="Insira Nome Completo" <?php echo ('value ="' .  $varray["nome"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="nif">Nº Identificação Fiscal</label>
                                                <input type="text" class="form-control" name="nif" placeholder="Insira Nº Identificação Fiscal *" <?php echo ('value ="' .  $varray["nif"] . '"'); ?> disabled>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="vemail">E-mail</label>
                                                <input type="email" class="form-control" name="iemail" placeholder="Insira E-mail" <?php echo ('value ="' .  $varray["email_inst"] . '"'); ?>>
                                                <?php
                                                  if (isset($_SESSION["iemailmsg"])) {
                                                    echo "<div class = 'text-danger'> " . $_SESSION["iemailmsg"] . " </div>";
                                                  }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="itelef">Telefone</label>
                                                <input type="text" class="form-control" name="itelef" placeholder="Insira Telefone" <?php echo ('value ="' .  $varray["telefone"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="imorada">Morada</label>
                                                <input type="name" class="form-control" name="imorada" placeholder="Insira Morada" <?php echo ('value ="' .  $varray["morada"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="idistrito">Distrito</label>
                                                <input type="name" class="form-control" name="idistrito" placeholder="Insira Distrito" <?php echo ('value ="' .  $varray["distrito"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="iconcelho">Concelho</label>
                                                <input type="name" class="form-control" name="iconcelho" placeholder="Insira Concelho" <?php echo ('value ="' .  $varray["concelho"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="ifreguesia">Freguesia</label>
                                                <input type="name" class="form-control" name="ifreguesia" placeholder="Insira Freguesia" <?php echo ('value ="' .  $varray["freguesia"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="website">Website</label>
                                                <input type="text" maxlength="60" class="form-control" name="website" placeholder="Insira Website" <?php echo ('value ="' .  $varray["url_web"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="repr">Nome do Representante</label>
                                                <input type="text" class="form-control" name="repr" placeholder="Nome do Representante" <?php echo ('value ="' .  $varray["representante"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="emailrepr">E-mail do Representante</label>
                                                <input type="text" maxlength="30" class="form-control" name="emailrepr" placeholder="Insira o E-mail do Representante" <?php echo ('value ="' .  $varray["email_repres"] . '"'); ?>>
                                                <?php
                                                  if (isset($_SESSION["iemailrpmsg"])) {
                                                    echo "<div class = 'text-danger'> " . $_SESSION["iemailrpmsg"] . " </div>";
                                                  }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="desc">Descrição</label>
                                                <input type="text" maxlength="150" class="form-control" name="desc" placeholder="Descrição" <?php echo ('value ="' .  $varray["descricao"] . '"'); ?>>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="ipass">Password</label>
                                                <input type="password" class="form-control" name="ipass" placeholder="Alterar Password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="text-right">
                                                <!-- <button type="button" id="cancel" name="cancel" class="btn ">Cancel</button> -->
                                                <button type="submit" id="update" name="update" class="btn btn-primary">Atualizar</button>
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
