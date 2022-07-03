<!doctype html>

<?php
    session_start();
    $varray = $_SESSION["fetch"];
?>

<html lang="en">

    <head>
        <title>VoluntárioCOVID19 | Área Privada</title>

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
            <br><br><br>

        		<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
        			<li class="nav-item">
        				<a class="nav-link active" id="home-tab" data-toggle="tab" href="#project" role="tab" aria-controls="project" aria-selected="true">Os nossos Voluntários!</a>
        			</li>

        			<li class="nav-item">
        				<a class="nav-link" id="profile-tab" data-toggle="tab" href="#inst_proj" role="tab" aria-controls="inst_proj" aria-selected="false">Projetos da Instituição</a>
        			</li>
        		</ul>

        		<div class="site-section login">
        			<div class="container-fluid">
      					<div class=" login-right">
      						<div class="tab-content" id="myTabContent">

                      <div class="tab-pane fade show active" id="project">
                        <!-- ZONA PARA APARECER A TABLEA COM VOLUNTÁRIOS QUE CORRSPONDEM AOS REQUISITOS
                            DOS SEUS PROJETOS ATIVOS/REGISTADOS -->
                        <?php
                            if (isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
                                include "proj_volunteers_table.php";
                                if (isset($_SESSION["spvt"])) {
                                    echo "<div>" . $_SESSION["spvt"] . "</div>";
                                }
                                if (isset($_SESSION["pvt"])) {
                                    echo "<div id = 'avl_vp'>" . $_SESSION["pvt"] . "</div>";
                                }
                            }
                          
                            //ALTERAR O ESTADO DA TABELA DAS CANDIDATURA
                            //SELECIONA OU RETIRA A SELEÇÃO DOS CANDIDATOS
                            if(isset($_POST["Selecionar"])) {
                                $proj = $_POST["Selecionar"];
                                //echo "Id do projeto:   ".$proj;
                                                                
                                include "openconn.php";
                                mysqli_query($conn, "set names 'utf8'");
                                $query = 'UPDATE V_candidatura
                                          SET V_candidatura.inst_check = 1
                                          WHERE  V_candidatura.projeto = "'.$proj.'"';
                                //Atualização de valores na BD
                                $result = mysqli_query($conn, $query);
                                if (!$result) {
                                    echo 'Could not run query: ' . mysql_error();
                                    exit;
                                }
                                // Termina a ligação com a base de dados
                                mysqli_close($conn);
                                echo "<meta http-equiv='refresh' content='0'>";
                                
                            }
                            if(isset($_POST["Retirar"])) {
                                $proj = $_POST["Retirar"];
                                                                
                                include "openconn.php";
                                mysqli_query($conn, "set names 'utf8'");
                                $query = 'UPDATE V_candidatura
                                          SET V_candidatura.inst_check = 0
                                          WHERE  V_candidatura.projeto = "'.$proj.'"';
                                //Atualização de valores na BD
                                $result = mysqli_query($conn, $query);
                                if (!$result) {
                                    echo 'Could not run query: ' . mysql_error();
                                    exit;
                                }
                                // Termina a ligação com a base de dados
                                mysqli_close($conn);
                                echo "<meta http-equiv='refresh' content='0'>";
                            }
                        ?>
                      </div>

                      <div class="tab-pane fade showe" id="inst_proj">
                        <?php
                          if (isset($_SESSION['institutionLoggedIn']) && $_SESSION['institutionLoggedIn'] == true) {
                              include "inst_projs_table.php";
                              $select = "id, carta, distrito, concelho, freguesia, area, funcao, descricao, alvo, vagas, inicio, fim";
                              $from = "V_projeto";
                              $where = "nif = " . $varray["nif"];
                              //print_r(isqlQuery($select, $from, $where));
                              isqlQuery($select, $from, $where);
                              if (isset($_SESSION["searchbar"]) && isset($_SESSION["allprojtable"])) {
                                echo "<div id='searchbar'>" . $_SESSION["searchbar"] . "</div>";
                                echo "<div id='projtable'>" . $_SESSION["allprojtable"] . "</div>";
                              }
                          }
                        ?>
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

    <script>

    var instid = <?php echo $varray["nif"]; ?>; //nif da Instituição
    var va = [instid, "", "", "", "", "", "", ""];

    function setvfunc(x){
    va[1] = x;
    }

    function setvavl(x){
    va[2] = x;
    }

    function setvare(x){
    va[3] = x;
    }

    function setvdist(x){
    va[4] = x;
    }

    function setvconc(x){
    va[5] = x;
    }

    function setvfreg(x){
    va[6] = x;
    }

    function setvcrt(x){
    va[7] = x;
    }

    function vsearch() {
        str = "inif="+instid;

        if (va[1] != "") {
            str = str + "&funcao=" + va[1];
        }

        if (va[2] != "") {
            str = str + "&alvo=" + va[2];
        }

        if (va[3] != "") {
            str = str + "&area=" + va[3];
        }

        if (va[4] != "") {
            str = str + "&dist=" + va[4];
        }

        if (va[5] != "") {
            str = str + "&conc=" + va[5];
        }

        if (va[6] != "") {
            str = str + "&freg=" + va[6];
        }

        if (va[7] != "") {
            str = str + "&carta=" + va[7];
        }

        console.log(str);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          document.getElementById("avl_vp").innerHTML = this.responseText;
          }
        };
        xhttp.open("GET", "get_volunteers_table.php?"+str, true);
        xhttp.send();

    }

    </script>

      <script>

      var instid = <?php echo $varray["nif"]; ?>;
      var a = [instid, "*", "", "", "", "", "", ""];

      function setpid(x){
        a[1] = x;
      }

      function setpcarta(x){
        a[2] = x;
      }

      function setpdistrito(x){
        a[3] = x;
      }

      function setpconcelho(x){
        a[4] = x;
      }

      function setpfreguesia(x){
        a[5] = x;
      }

      function setparea(x){
        a[6] = x;
      }

      function setpalvo(x){
        a[7] = x;
      }

      function search() {

        str = "inif="+instid;

        if (a[1] != "" && a[1] != "*") {

          str = str+"&pid="+a[1];

          document.getElementById("carta").disabled = true;
          document.getElementById("distrito").disabled = true;
          document.getElementById("concelho").disabled = true;
          document.getElementById("freguesia").disabled = true;
          document.getElementById("area").disabled = true;
          document.getElementById("alvo").disabled = true;

        } else {

          document.getElementById("carta").disabled = false;
          document.getElementById("distrito").disabled = false;
          document.getElementById("concelho").disabled = false;
          document.getElementById("freguesia").disabled = false;
          document.getElementById("area").disabled = false;
          document.getElementById("alvo").disabled = false;

          if (a[2] != "") {
            str = str + "&pcarta=" + a[2];
            document.getElementById("projid").disabled = true;
          }

          if (a[3] != "") {
            str = str + "&pdistrito=" + a[3];
            document.getElementById("projid").disabled = true;
          }

          if (a[4] != "") {
            str = str + "&pconcelho=" + a[4];
            document.getElementById("projid").disabled = true;
          }

          if (a[5] != "") {
            str = str + "&pfreguesia=" + a[5];
            document.getElementById("projid").disabled = true;
          }

          if (a[6] != "") {
            str = str + "&parea=" + a[6];
            document.getElementById("projid").disabled = true;
          }

          if (a[7] != "") {
            str = str + "&palvo=" + a[7];
            document.getElementById("projid").disabled = true;
          }

          if (a[1] == "*" &&
              a[2] == "" &&
              a[3] == "" &&
              a[4] == "" &&
              a[5] == "" &&
              a[6] == "" &&
              a[7] == "" ) {
            str = str+"&pid="+a[1];
            document.getElementById("projid").disabled = false;
          }

        }
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          document.getElementById("projtable").innerHTML = this.responseText;
          }
        };
        xhttp.open("GET", "get_project.php?"+str, true);
        xhttp.send();
      }

      </script>

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
