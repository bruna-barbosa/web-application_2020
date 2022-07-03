<!doctype html>

<?php
    session_start();
?>

<html lang="en">

    <head>
        <title>VoluntárioCOVID19 | Área PRIVADA</title>

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
                                if (isset($_SESSION['volunteerLoggedIn']) && $_SESSION['volunteerLoggedIn'] == true
                                    or isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
                                    echo '<li><a href="chat_users.php" class="btn-secondary" id="chat-nav">Chat</a></li>';
                                    }

                                // Botão de Login ou Logout - Consoante o Estado da Sessão                                            
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

            <div class="hero-v1 hero-v1-reduced"> </div>
            
            
            <div class="site-section">
                <div class="container">
            
                    
            <!-- DESCRIÇÃO DO PROJETO -->
            <?php
            // Para garantir que voluntário esteja Logged In
                if (isset($_SESSION['volunteerLoggedIn']) && $_SESSION['volunteerLoggedIn'] == true) {
                    session_start();
                    $id = $_GET["projid"];
                        
                    //Função que efetua as querys e que constroi o echo para HTML
                    function sqlQuery($selectElem, $fromElem, $whereElem, $id){
                        include "openconn.php";
                        mysqli_query($conn, "set names 'utf8'"); 

                        //CC do user logged in
                        $varray = $_SESSION["fetch"];
                        $cc = $varray["cc"];

                        //Set Query
                        $query = "SELECT ".$selectElem." FROM ".$fromElem;
                        if ($whereElem != ""){
                            $query = "SELECT ".$selectElem." FROM ".$fromElem." WHERE ".$whereElem;
                        }
                        //echo $query;

                        //Get DB values
                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            echo 'Could not run query: ' . mysql_error();
                            exit;
                        }
                        
                        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){

                            //codigo único do projeto
                            $id = htmlspecialchars($row[1]);
                            
                            //Info
                            $funcao = htmlspecialchars($row[7]);
                            $desc = htmlspecialchars($row[8]);
                            $data_in = htmlspecialchars($row[11]);
                            $data_fim = htmlspecialchars($row[12]);
                            $pop_alvo = htmlspecialchars($row[9]);
                            $area = htmlspecialchars($row[6]);
                            $vagas = htmlspecialchars($row[10]);
                            $dist = htmlspecialchars($row[3]);
                            $conc = htmlspecialchars($row[4]);
                            $carta = htmlspecialchars($row[33]);
                            if ($carta = 1) {
                                $text = '<a href="#">Deve possuir carta de condução</a>,';
                            } else {
                                $text = '';
                            }
                                                

                            $html[] =
                                '<div class="site-section">
                                  <div class="container">
                                    <div class="row">
                                      <div class="col-md-8 blog-content">
                                        <div class="row mb-5">
                                          <div class="col-lg-6">
                                            <figure><img src="images/hero_1.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid">
                                              <figcaption>This is an image caption</figcaption></figure>
                                            </div>
                                            <div class="col-lg-6">
                                              <figure><img src="images/hero_2.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid">
                                                <figcaption>This is an image caption</figcaption></figure>
                                              </div>
                                            </div>
                                            <p class="lead">Projeto de voluntariado #'.$id.' - '.$funcao.'.</p>
                                            <p>'.$desc.'</p>
  
                                          
                                            <div class="pt-5">
                                              <p>População Alvo:  <a href="#">'.$pop_alvo.'</a>
                                              Área de ação: <a href="#">'.$area.'</a></p>
                                              <p>Requisitos: '.$text.' <a href="#">disponibilidade entre '.$data_in.' e '.$data_fim.'</a></p>
                                            </div>
                                            
                                                <a href="vol_candidatura.php?projid='.$id.'" 
                                                class="btn btn-primary">Inscrever-me!</a>
                                            
                                            <br><br>
                                            <div>
                                                <?php

                                                require_once "lib/nusoap.php";

                                                $client = new nusoap_client(
                                                    "http://appserver-01.alunos.di.fc.ul.pt/~asw001/Projeto/InfoAcaoVol.php"
                                                );
                                                $error = $client->getError();
                                                $result = $client->call("nomeclientes", array("nome" => '.$id.'));	//handle errors

                                                if ($client->fault)
                                                {   //check faults
                                                }
                                                else {    $error = $client->getError();
                                                         echo $result;
                                                }
                                                ?>
                                            </div>

                                            

                                          </div>
                                          <div class="col-md-4 sidebar">
                                            <div class="sidebar-box">
                                              <div class="categories">
                                                <h3>Informações</h3>
                                                <li><a href="#">Vagas <span>('.$vagas.')</span></a></li>
                                                <li><a href="#">Início <span>('.$data_in.')</span></a></li>
                                                <li><a href="#">Pop. Alvo <span>('.$pop_alvo.')</span></a></li>
                                                <li><a href="#">Área <span>('.$area.')</span></a></li>
                                                <li><a href="#">Distrito <span>('.$dist.')</span></a></li>
                                                <li><a href="#">Concelho <span>('.$conc.')</span></a></li>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>'
                                ;
                        }


                        if (mysqli_num_rows($result)>0) {
                            $html = '<div class="row">'.implode($html).'</div>';
                            echo $html;
                        } else { echo "<br><p>Ocorreu um problema. Projeto não finalizado, contacte a instituição.</p><br>";}

                        // Termina a ligação com a base de dados
                        mysqli_close($conn);
                    }

                //NIF do user logged in
                $varray = $_SESSION["fetch"];
                $cc = $varray["cc"];

                //Selecionar as informações dos projetos
                $select = "*";
                $from = "V_projeto, V_vol_disponibilidade, V_vol_alvo, V_vol_area, 
                            V_voluntario, V_proj_horario";
                $where = "V_projeto.inicio >= V_vol_disponibilidade.inicio
                        AND V_projeto.fim <= V_vol_disponibilidade.fim
                        and V_projeto.alvo = V_vol_alvo.alvo
                        and V_projeto.area = V_vol_area.area
                        and V_projeto.distrito = V_voluntario.distrito
                        and V_projeto.concelho = V_voluntario.concelho
                        and V_voluntario.cc = ".$cc."
                        and V_projeto.id = '".$id."'
                        and V_projeto.id = V_proj_horario.projeto
                        GROUP BY V_proj_horario.dia";


                echo sqlQuery($select, $from, $where, $id);
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
