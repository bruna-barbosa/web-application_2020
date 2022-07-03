<?php mysqli_query($conn, "set names 'utf8'"); ?>
<?php session_start(); ?>

<html>

<html lang="en">

<head>
	<title>VoluntárioCOVID19 | Registo</title>

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

	<style>
		.btnRegister {
			float: right;
		}
	</style>

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
							<form action="vol_registration.php" method="post" enctype="multipart/form-data" class="tab-pane fade show active needs-validation" id="home" role="tabpanel" aria-labelledby="home-tab">
								<h3 class="login-heading">Registo de Voluntários</h3>
									<div class="text-center text-danger">
										<?php
										//mensagem de sucesso ou insucesso
										if (isset($_SESSION["msg"])) {
											echo $_SESSION["msg"];
											session_destroy();
										}
										?>
									</div>

								<div class="row login-form">
									<div class="col-md-4 rounded h-100">
										<div class="form-group">
											Nome completo: <br>
											<input style="margin-bottom: 1rem;" type="text" maxlength="40" name="vnome" class="form-control" placeholder="Nome completo"
											<?php if (isset($_SESSION["msg"]) and $_SESSION["msg"] == "Registo não Efetuado" or $_SESSION["msg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["vnome"] . '"');
												session_destroy();
											} ?>>

											Nome de utilizador: <br>
											<input style="margin-bottom: 1rem;" type="text" maxlength="20" name="vuser" class="form-control" placeholder="Nome de utilizador"
											<?php if (isset($_SESSION["msg"]) and $_SESSION["msg"] == "Registo não Efetuado" or $_SESSION["msg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["vuser"] . '"');
												session_destroy();
											} ?>>
											<?php
											if ($_SESSION["usermsg"] != "msg") {
												echo "<div class='text-danger'>" . $_SESSION["usermsg"] . "</div>";
											}
											?>

											Data de Nascimento: <br>
											<input style="margin-bottom: 1rem;" type="text" maxlength="10" name="data" class="form-control"
											<?php if (isset($_SESSION["msg"]) and $_SESSION["msg"] == "Registo não Efetuado" or $_SESSION["msg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["vdata"] . '"');
												session_destroy();
											} else {
												echo ('value ="' .  "AAAA-MM-DD" . '"');
											} ?>>

											Telemóvel: <br>
											<input style="margin-bottom: 1rem;" type="text" maxlength="9" name="vtele" class="form-control" placeholder="Telemóvel"
											<?php if (isset($_SESSION["msg"]) and $_SESSION["msg"] == "Registo não Efetuado" or $_SESSION["msg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["vtele"] . '"');
												session_destroy();
											} ?>>

											<div>
												E-mail: <br>
												<input style="margin-bottom: 1rem;" type="text" maxlength="40" name="vemail" class="form-control" placeholder="E-mail"
												<?php if (isset($_SESSION["msg"]) and $_SESSION["msg"] == "Registo não Efetuado" or $_SESSION["msg"] == "Campos por Preencher") {
													echo ('value ="' .  $_SESSION["vemail"] . '"');
													session_destroy();
												} ?>>
												<?php
												if ($_SESSION["emailmsg"] != "msg") {
													echo "<div class='text-danger'>" . $_SESSION["emailmsg"] . "</div>";
												}
												?>

												Password: <br>
												<input type="password" maxlength="30" name="vpass" class="form-control" placeholder="Password"
												<?php if (isset($_SESSION["msg"]) and $_SESSION["msg"] == "Registo não Efetuado" or $_SESSION["msg"] == "Campos por Preencher") {
													echo ('value ="' .  $_SESSION["vpass"] . '"');
													session_destroy();
												} ?>>

											</div>
										</div>
									</div>
									<div class="col-md-4 rounded h-100">
										<div class="form-group">
											Distrito:<br>
											<input style="margin-bottom: 1rem;" type="text" maxlength="30" name="vdistrito" class="form-control" placeholder="Distrito"
											<?php if (isset($_SESSION["msg"]) and $_SESSION["msg"] == "Registo não Efetuado" or $_SESSION["msg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["vdistrito"] . '"');
												session_destroy();
											} ?>>

											Concelho:<br>
											<input style="margin-bottom: 1rem;" type="text" maxlength="30" name="vconcelho" class="form-control" placeholder="Concelho"
											<?php if (isset($_SESSION["msg"]) and $_SESSION["msg"] == "Registo não Efetuado" or $_SESSION["msg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["vconcelho"] . '"');
												session_destroy();
											} ?>>

											Freguesia:<br>
											<input style="margin-bottom: 1rem;" type="text" maxlength="30" name="vfreguesia" class="form-control" placeholder="Freguesia"
											<?php if (isset($_SESSION["msg"]) and $_SESSION["msg"] == "Registo não Efetuado" or $_SESSION["msg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["vfreguesia"] . '"');
												session_destroy();
											} ?>>

											Cartão de Cidadão:<br>
											<input style="margin-bottom: 1rem;" type="text" maxlength="8" name="cartaocidadao" class="form-control" placeholder="Cartão de Cidadão"
											<?php if (isset($_SESSION["msg"]) and $_SESSION["msg"] == "Registo não Efetuado" or $_SESSION["msg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["cc"] . '"');
												session_destroy();
											} ?>>
											<?php
											if ($_SESSION["ccmsg"] != "msg") {
												echo "<div class='text-danger'>" . $_SESSION["ccmsg"] . "</div>";
											}
											?>

											Carta de Condução:<br>
											<label style="margin-top: 0.5rem;margin-right: 1rem;" class="radio inline">
												<input type="radio" name="carta" value="sim">
												<span > Sim </span>
											</label>
											
											<label style="margin-bottom: 1rem;" class="radio inline">
												<input type="radio" name="carta" value="nao" checked="">
												<span> Não </span>
											</label>
											

											<div class="maxl">
												Género: <br>
												<label style="margin-top: 0.5rem;margin-right: 1rem;" class="radio inline">
													<input type="radio" name="genero" value="F">
													<span> F </span>
												</label>
												
												<label style="margin-right: 1rem;" class="radio inline">
													<input type="radio" name="genero" value="M">
													<span> M </span>
												</label>

												<label class="radio inline">
													<input type="radio" name="genero" value="N" checked="">
													<span> Prefiro não dizer </span>
												</label>
											</div>

										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group rounded h-100">
											<input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)" style="display: none;"><br>
											<label for="file" style="cursor: pointer;">
												<img class="upload-photo" src="images/upload-photo.png">
											</label><br>
											<img id="output" width="100" height=auto /><br>
										</div>
										<input type="submit" class="btnRegister btn btn-primary" value="Registar">
									</div>
								</div>
							</form>

							<form action="inst_registration.php" method="post" enctype="multipart/form-data" class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<div class="text-center text-danger">
									<?php
									//mensagem de sucesso ou insucesso
									if (isset($_SESSION["imsg"])) {
										echo $_SESSION["imsg"];
										session_destroy();
									}
									?>
								</div>
								<h3 class="login-heading">Registo de Instituições</h3>
								
								<div class="row login-form">
									<div class="col-md-4 rounded h-100">
										<div class="form-group">
											Nº de Identificação Fiscal:<br>
											<input type="text" maxlength="9" class="form-control" name="nif" placeholder="Nº de Identificação Fiscal"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["inif"] . '"');
												session_destroy();
											} ?>>
											<?php
											if ($_SESSION["inifmsg"] != "msg") {
												echo "<div class='text-danger'>" . $_SESSION["inifmsg"] . "</div>";
											}
											?>
										</div>
										<div class="form-group">
											Nome da Instituição:<br>
											<input type="text" maxlength="60" class="form-control" name="inome" placeholder="Nome da Instituição"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["inome"] . '"');
												session_destroy();
											} ?>>
										</div>
										<div class="form-group">
											Nome de utilizador:<br>
											<input type="text" maxlength="20" class="form-control" name="user" placeholder="Nome de utilizador"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
												echo ('value ="' . $_SESSION["user"] . '"');
												session_destroy();
											} ?>>
											<?php
											if ($_SESSION["iusermsg"] != "msg" and $_SESSION["imsg"] != "erro") {
												echo "<div class='text-danger'>" . $_SESSION["iusermsg"] . "</div>";
											}
											?>
										</div>
										<div class="form-group">
											E-mail da Instituição:<br>
											<input type="text" maxlength="30" class="form-control" name="iemail" placeholder="E-mail da Instituição"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["iemail"] . '"');
												session_destroy();
											} ?>>
										</div>
										<div>
											Telefone: <br>
											<input type="text" maxlength="9" name="itelef" class="form-control" placeholder="Telefone"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["itelef"] . '"');
												session_destroy();
											} ?>>
										</div>
										<div class="form-group">
											Morada:<br>
											<input type="text" maxlength="60" class="form-control" name="imorada" placeholder="Morada"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["imorada"] . '"');
												session_destroy();
											} ?>>
										</div>
										<div class="form-group">
											Distrito:<br>
											<input type="text" class="form-control" name="idistrito" placeholder="Distrito"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["idistrito"] . '"');
												session_destroy();
											} ?>>
										</div>
									</div>
									<div class="col-md-4 rounded h-100">
										<div class="form-group">
											Concelho:<br>
											<input type="text" class="form-control" name="iconcelho" placeholder="Concelho"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["iconcelho"] . '"');
												session_destroy();
											} ?>>
										</div>
										<div class="form-group">
											Freguesia:<br>
											<input type="text" class="form-control" name="ifreguesia" placeholder="Freguesia"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["ifreguesia"] . '"');
												session_destroy();
											} ?>>
										</div>
										<div class="form-group">
											Website da Instituição:<br>
											<input type="text" maxlength="60" class="form-control" name="website" placeholder="Website da Instituição"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["website"] . '"');
												session_destroy();
											} else {
												echo ('value ="' .  "Website da Instituição" . '"');
											} ?>>
										</div>
										<div class="form-group">
											Representante:<br>
											<input type="text" class="form-control" name="repr" placeholder="Representante"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["repr"] . '"');
												session_destroy();
											} ?>>
										</div>
										<div class="form-group">
											E-mail do Representante:<br>
											<input type="text" maxlength="30" class="form-control" name="emailrepr" placeholder="E-mail do Representante"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["emailrepr"] . '"');
												session_destroy();
											} ?>>
											<?php
											if ($_SESSION["iemailrpmsg"] != "msg") {
												echo "<div class='text-danger'>" . $_SESSION["iemailrpmsg"] . "</div>";
											}
											?>
										</div>
										<div class="form-group">
											Password:<br>
											<input type="password" maxlength="30" class="form-control" name="pass" placeholder="Password"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
												echo ('value ="' .  $_SESSION["pass"] . '"');
												session_destroy();
											} ?>>
										</div>
										<div class="form-group">
											Descrição:<br>
											<input type="text" maxlength="150" class="form-control" name="desc" placeholder="Descrição"
											<?php if (isset($_SESSION["imsg"]) and $_SESSION["imsg"] == "Registo não Efetuado" or $_SESSION["imsg"] == "Campos por Preencher") {
											echo ('value ="' .  $_SESSION["desc"] . '"');
											session_destroy();
										} ?>>
										</div>

									</div>
                                    <!-- EM TESTE
                                    <div class="col-md-4">
										<div class="form-group rounded h-100">
											<input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)" style="display: none;"><br>
											<label for="file" style="cursor: pointer;">Upload da Foto de Perfil</label><br>
											<img id="output" width="100" height=auto /><br>
										</div>
										<input type="submit" class="btnRegister" value="Register">
									</div>
                                    -->
                                    
									<!--<div class="col-md-4">
										<div class="form-group rounded h-100">
											<div class="profile-pic-div">
												<img class="upload-photo" src="images/upload-photo.png" id="photo">
											</div>
											<input type="file" id="uploadBtn" name="logo">
										</div>
										<input type="submit" class="btnRegister" value="Registar">
									</div>-->

									<div class="col-md-4">
										<div class="form-group rounded h-100">
											<input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)" style="display: none;"><br>
											<label for="file" style="cursor: pointer;">
												<img class="upload-photo-large" src="images/upload-photo.png">
											</label><br>
											<img id="output" width="100" height=auto /><br>
										</div>
										<input type="submit" class="btnRegister btn btn-primary" value="Registar">
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
                            <p><small>ASW001</small></p>
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

</html>
