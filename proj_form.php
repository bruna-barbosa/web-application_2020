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

<html>

<html lang="en">

<head>
	<title>VoluntárioCOVID19 | Novo Projeto</title>

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
		<div class="site-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<h3 class="mb-3 side-title">Perfil do Projeto</h3>

						<form action="proj_inserts.php" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="projid">Código único</label>
										<input type="text" name="projid" class="form-control" maxlength="4" placeholder="Código alfanumérico, ex.: AB01">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="vagas">Vagas</label>
										<input type="text" name="vagas" class="form-control" maxlength="4" placeholder="até 9999">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="distP">Distrito</label>
										<input type="text" name="distP" class="form-control" maxlength="30" placeholder="ex.: Lisboa...">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="concP">Concelho</label>
										<input type="text" name="concP" class="form-control" maxlength="30" placeholder="ex.: Lisboa...">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label for="fregP">Freguesia</label>
										<input type="text" name="fregP" class="form-control" maxlength="30" placeholder="ex.: Ajuda...">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="area_int">Área de Intervenção</label><br>
										<input type="radio" id="SAU" name="area_int" value="Saúde" required>
										<label for="SAU">Saúde</label><br>
										<input type="radio" id="LOG" name="area_int" value="Logística" required>
										<label for="LOG">Logística</label><br>
										<input type="radio" id="EDU" name="area_int" value="Educação" required>
										<label for="EDU">Educação</label><br>
										<input type="radio" id="ASO" name="area_int" value="Ação Social" required>
										<label for="ASO">Ação Social</label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="pop_alvo">População Alvo</label><br>
										<input type="radio" id="CRI" name="pop_alvo" value="Crianças" required>
										<label for="CRI">Crianças</label><br>
										<input type="radio" id="MEN" name="pop_alvo" value="Jovens" required>
										<label for="MEN">Jovens</label><br>
										<input type="radio" id="ADU" name="pop_alvo" value="Adultos" required>
										<label for="ADU">Adultos</label><br>
										<input type="radio" id="IDO" name="pop_alvo" value="Idosos" required>
										<label for="IDO">Idosos</label>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label for="carta">Carta de Condução</label><br>
										<input type="radio" id="carta" name="carta" value="1" required>
										<label for="carta">Necessária</label>
										<input type="radio" id="ncarta" name="carta" value="0" required>
										<label for="ncarta">Indiferente</label>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label for="funcao">Função</label>
										<input type="text" name="funcao" class="form-control" maxlength="30" placeholder="Nome da função a exercer...">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label for="desc">Descrição</label>
										<textarea name="desc" class="form-control" cols="30" rows="3" maxlength="300" placeholder="Descrição da função a exercer..."></textarea>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="data_inP">Data de início</label>
										<input type="date" id="data_inP" name="data_inP" class="form-control" value="2021-01-01" min="2021-01-01" max="2021-12-31">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="data_fimP">Data final</label>
										<input type="date" id="data_fimP" name="data_fimP" class="form-control" value="2021-12-31" min="2021-01-01" max="2021-12-31">
									</div>
								</div>
                                <!--
								<div class="col-lg-12">
									<div class="form-group">
										<label for="n_horas">Número de horas semanais</label><br>
										<input type="radio" id="ate10" name="n_horas" value="10" required>
										<label for="10">Até 10h</label>
										<input type="radio" id="11a20h" name="n_horas" value="20" required>
										<label for="20">11 a 20h</label>
										<input type="radio" id="21a40h" name="n_horas" value="40" required>
										<label for="40">21 a 40h</label>
										<input type="radio" id="maisde40h" name="n_horas" value="60" required>
										<label for="60">mais de 40h</label>
									</div>
								</div>
                                -->
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label>Horário</label><br>
										<label>2ª feira</label>
										<input type="checkbox" id="2fm" name="2fm" value="Manhã">
										<label for="2m">manhã</label>
										<input type="checkbox" id="2ft" name="2ft" value="Tarde">
										<label for="2t">tarde</label>
										<input type="checkbox" id="2fn" name="2fn" value="Noite">
										<label for="2n">noite</label><br>
										<label>3ª feira</label>
										<input type="checkbox" id="3fm" name="3fm" value="Manhã">
										<label for="3m">manhã</label>
										<input type="checkbox" id="3ft" name="3ft" value="Tarde">
										<label for="3t">tarde</label>
										<input type="checkbox" id="3fn" name="3fn" value="Noite">
										<label for="3n">noite</label><br>
										<label>4ª feira</label>
										<input type="checkbox" id="4fm" name="4fm" value="Manhã">
										<label for="4m">manhã</label>
										<input type="checkbox" id="4ft" name="4ft" value="Tarde">
										<label for="4t">tarde</label>
										<input type="checkbox" id="4fn" name="4fn" value="Noite">
										<label for="4n">noite</label><br>
										<label>5ª feira</label>
										<input type="checkbox" id="5fm" name="5fm" value="Manhã">
										<label for="5m">manhã</label>
										<input type="checkbox" id="5ft" name="5ft" value="Tarde">
										<label for="5t">tarde</label>
										<input type="checkbox" id="5fn" name="5fn" value="Noite">
										<label for="5n">noite</label><br>
										<label>6ª feira</label>
										<input type="checkbox" id="6fm" name="6fm" value="Manhã">
										<label for="6m">manhã</label>
										<input type="checkbox" id="6ft" name="6ft" value="Tarde">
										<label for="6t">tarde</label>
										<input type="checkbox" id="6fn" name="6fn" value="Noite">
										<label for="6n">noite</label><br>
										<label>sáb.</label>
										<input type="checkbox" id="sabm" name="sabm" value="Manhã">
										<label for="sm">manhã</label>
										<input type="checkbox" id="sabt" name="sabt" value="Tarde">
										<label for="st">tarde</label>
										<input type="checkbox" id="sabn" name="sabn" value="Noite">
										<label for="sn">noite</label><br>
										<label>dom.</label>
										<input type="checkbox" id="domm" name="domm" value="Manhã">
										<label for="dm">manhã</label>
										<input type="checkbox" id="domt" name="domt" value="Tarde">
										<label for="dt">tarde</label>
										<input type="checkbox" id="domn" name="domn" value="Noite">
										<label for="dn">noite</label><br>
									</div>
								</div>
                                
                                <div class="col-md-4">
                                    <!--
                                    <div class="form-group border rounded h-100">
                                        <div class="profile-pic-div">
                                            <img src="images/default_logo.png" id="photo">
                                        </div>
                                        <input type="file" id="uploadBtn" name="logo">
                                    </div>
                                    -->
                                    <!---->
                                    <input type="submit" class="btnRegister" value="Register">
                                </div>
                                
	                               <div class="col-lg-6">
										<div class="profile-pic-div">
											<input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)" style="display: none;"><br>
											<label for="file" style="cursor: pointer;">Upload da Foto de Perfil</label><br>
											<img id="output" width="100" height=auto /><br>
										</div>
										<input type="file" id="uploadBtn" name="project">
	                               </div>
                                
							</div>

							<br><br><br>

							<div class="row">
								<div class="col-lg-6">
									<input type="submit" class="btn btn-primary" value="Criar Ação de Voluntariado">
								</div>
							</div>
						</form>
					</div>

					<div class="col-lg-5 ml-auto">
						<h3 class="mb-3 side-title"><?php echo ($varray["nome"]); ?></h3>
						<div class="quick-contact">

							<div class="d-flex">
								<span class="icon-room"></span>
								<address>
								<?php echo ($varray["morada"]); ?>
								</address>
							</div>
							<div class="d-flex">
								<span class="icon-phone"></span>
								<a href="#"><?php echo ($varray["telefone"]); ?></a>
							</div>
							<div class="d-flex">
								<span class="icon-envelope"></span>
								<a href="#"><?php echo ($varray["email_inst"]); ?></a>
							</div>
							<div class="d-flex">
								<span class="icon-globe"></span>
								<a href="#"><?php echo ($varray["url_web"]); ?></a>
							</div>
														
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
	

		<script type="text/javascript"></script>
		<script>
			var loadFile = function(event) {
				var image = document.getElementById('output');
				image.src = URL.createObjectURL(event.target.files[0]);
			};

			function remove_image() {
				document.getElementById('img').remove();
			}
		</script>
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
