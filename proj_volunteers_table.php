<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>

<body>
    <?php

        //Função que efetua as querys e que constroi o echo para HTML
        //Formatado para tabelas: voluntário, disponibilidade, horário, popAlvo e areaInt
        function sqlQuery($selectElem, $fromElem, $whereElem, $nif){
            
                
            
            
            
            // CONSTRUÇÃO DOS ARRAY'S DE VERIFICAÇÃO DE ESTADO DE INSCRIÇÃO NOS PROJETOS
            $select2 = "*";
            $from2 = "V_candidatura, V_projeto";
            $where2 = "V_projeto.nif = ".$nif."
                       AND V_projeto.id = V_candidatura.projeto";
            $query2 = "SELECT ".$select2." FROM ".$from2." WHERE ".$where2;
            //echo $query2."<br>";
            
            include "openconn.php";
            mysqli_query($conn, "set names 'utf8'");
            $result2 = mysqli_query($conn, $query2);
            
            $verif_volCheck = array(); $verif_projCheck = array();
            
            while ($row = mysqli_fetch_array($result2, MYSQLI_NUM)){
                
                //echo "Aqui dentro : ".($row[0]);
                //echo " // : ".($row[1])."<br>";
                array_push($verif_volCheck,$row[1]);
                
                //no caso do voluntário não ter aplicado ainda a candidatura
                //acrecenta no array de verificação
                if ($row[2]==1){
                    //array_push($verif_volCheck,$row[1]);
                    array_push($verif_projCheck,$row[0]);
                }
            }
            mysqli_close($conn); 

            /* TESTES
            echo "<br>Conteúdo do array Vols<br>";
            for($i = 0; $i < count($verif_volCheck); ++$i) {
                echo "linha: ".$verif_volCheck[$i]."<br>";
            }
            echo "<br><br>";
            
            echo "<br>Conteúdo do array Projs<br>";
            for($i = 0; $i < count($verif_projCheck); ++$i) {
                echo "linha: ".$verif_projCheck[$i]."<br>";
            }
            echo "<br><br>";
            */
            
            //ELABORAÇÃO DA TABELA DE DADOS A APRESENTAR
            include "openconn.php";
            mysqli_query($conn, "set names 'utf8'");

            //Set Query
            $query = "SELECT ".$selectElem." FROM ".$fromElem;
            if ($whereElem != ""){
                $query = "SELECT ".$selectElem." FROM ".$fromElem." WHERE ".$whereElem;
            }
            //echo $query."<br>";

            //Get DB values
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo 'Could not run query: ' . mysql_error();
                exit;
            }

            

            $vfuncao = array();
            $valvo = array();
            $varea = array();
            $vdist = array();
            $vconc = array();
            $vfreg = array();
            $vcarta = array();
            
            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                
                // CONTABILIZAÇÃO DAS VAGAS OCUPADAS EM CADA PROJETO
                $query3 = "SELECT V_projeto.vagas-SUM(V_candidatura.inst_check)
                            FROM V_candidatura, V_projeto
                            WHERE V_candidatura.projeto = V_projeto.id
                            AND V_candidatura.projeto = '".$row[1]."'";
                //echo $query3."<br>";
                include "openconn.php";
                mysqli_query($conn, "set names 'utf8'");
                $result3 = mysqli_query($conn, $query3);
                while ($val = mysqli_fetch_array($result3, MYSQLI_NUM)){
                    $vagas = $val[0];
                }
                mysqli_close($conn);
                
                
                
                //SELEÇÃO DO BUTÃO/FUNÇÃO
                //Verifica se voluntário já está incrito no projeto
                //Muda opção do butão para increver ou retirar candidatura
                if(in_array(htmlspecialchars($row[15]), $verif_volCheck) &&
                   !in_array(htmlspecialchars($row[1]), $verif_projCheck) &&
                   $vagas > 0){
                    //echo $row[1];
                    /*$button =  '<form method="post">
                                <input type="submit" name="Selecionar"
                                value="'.$row[1].'" class="btn btn-primary">
                                </form>';*/
                    $button =  '<form method="post">
                                    <input type="text" name="Selecionar" value="'.$row[1].'" hidden>
                                    <input type="submit" value="Aceitar" class="btn btn-primary">
                                </form>';
                } else {
                    /*$button = '<form method="post">
                                <input type="submit" name="Retirar"
                                value="'.$row[1].'" class="btn btn-secondary">
                                </form>';*/
                    $button = '<form method="post">
                                    <input type="text" name="Retirar" value="'.$row[1].'" hidden>
                                    <input type="submit" value="Declinar" class="btn btn-secondary">
                               </form>';
                }

                



                $vfuncao[] = $row[7];
                $valvo[] = $row[9];
                $varea[] = $row[6];
                $vdist[] = $row[21];
                $vconc[] = $row[22];
                $vfreg[] = $row[23];
                $vcarta[] = $row[26];

                $html[] =   "<tr>" .
                                "<td>" . htmlspecialchars($row[1]) . "</td>" .
                                "<td>" . htmlspecialchars($row[7]) . "</td>" .
                                "<td>" . htmlspecialchars($row[11]) . "</td>" .
                                "<td>" . htmlspecialchars($row[12]) . "</td>" .
                                "<td>" . htmlspecialchars($row[9]) . "</td>" .
                                "<td>" . htmlspecialchars($row[6]) . "</td>" .
                                "<td>" . htmlspecialchars($row[27]) . "</td>" .
                                "<td>" . htmlspecialchars($row[15]) . "</td>" .
                                "<td>" . htmlspecialchars($row[16]) . "</td>" .
                                "<td>" . htmlspecialchars($row[17]) . "</td>" .
                                "<td>" . intval(date("Y-m-d") -
                                                htmlspecialchars($row[18]) -
                                                date("1-0-0")) . "</td>" .
                                "<td>" . htmlspecialchars($row[20]) . "</td>" .
                                "<td>" . htmlspecialchars($row[19]) . "</td>" .
                                "<td>" . htmlspecialchars($row[21]) . "</td>" .
                                "<td>" . htmlspecialchars($row[22]) . "</td>" .
                                "<td>" . htmlspecialchars($row[23]) . "</td>" .
                                "<td>" . htmlspecialchars($row[26]) . "</td>" .
                                "<td>" . $vagas . "</td>" .
                                "<td>" . $button . "</td>" .
                            "</tr>";
            }

            $vfuncao = array_unique($vfuncao);
            $valvo = array_unique($valvo);
            $varea = array_unique($varea);
            $vdist = array_unique($vdist);
            $vconc = array_unique($vconc);
            $vfreg = array_unique($vfreg);
            $vcarta = array_unique($vcarta);

            $selection = "<form class='form-group border' action=''>
                <select id='vfunc' class = 'form-select' name='vfunc' onchange='setvfunc(this.value);vsearch();'>
                    <option value=''>Função:</option>";

            $keys = array_keys($vfuncao);

            for ($i=0; $i < count($vfuncao); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$vfuncao[$k]'>$vfuncao[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='vavl' class = 'form-select' name='vavl' onchange='setvavl(this.value);vsearch();'>
                    <option value=''>Alvo:</option>";

            $keys = array_keys($valvo);

            for ($i=0; $i < count($valvo); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$valvo[$k]'>$valvo[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='vare' class = 'form-select' name='vare' onchange='setvare(this.value);vsearch();'>
                    <option value=''>Área:</option>";

            $keys = array_keys($varea);

            for ($i=0; $i < count($varea); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$varea[$k]'>$varea[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='vdist' class = 'form-select' name='vdist' onchange='setvdist(this.value);vsearch();'>
                    <option value=''>Distrito:</option>";

            $keys = array_keys($vdist);

            for ($i=0; $i < count($vdist); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$vdist[$k]'>$vdist[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='vconc' class = 'form-select' name='vconc' onchange='setvconc(this.value);vsearch();'>
                    <option value=''>Concelho:</option>";

            $keys = array_keys($vconc);

            for ($i=0; $i < count($vconc); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$vconc[$k]'>$vconc[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='vfreg' class = 'form-select' name='vfreg' onchange='setvfreg(this.value);vsearch();'>
                    <option value=''>Freguesia:</option>";

            $keys = array_keys($vfreg);

            for ($i=0; $i < count($vfreg); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$vfreg[$k]'>$vfreg[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='vcrt' class = 'form-select' name='vcrt' onchange='setvcrt(this.value);vsearch();'>
                    <option value=''>Carta:</option>";

            $keys = array_keys($vcarta);

            for ($i=0; $i < count($vcarta); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$vcarta[$k]'>$vcarta[$k]</option>";
            }

            $selection = $selection . "</select> </form>";

            if (mysqli_num_rows($result)>0) {
                $html = "<div class='w-auto p-3'>
                        <table class='table table-striped table-hover table-sm' id='myTable'>
                         <tr class='header'>
                            <th scope='col'>ID</th>
                            <th scope='col'>Função</th>
                            <th scope='col'>in. Disp.</th>
                            <th scope='col'>Fim Disp.</th>
                            <th scope='col'>Pop. Alvo</th>
                            <th scope='col'>Área</th>
                            <th scope='col'>User</th>
                            <th scope='col'>CC</th>
                            <th scope='col'>Nome</th>
                            <th scope='col'>Género</th>
                            <th scope='col'>Idade</th>
                            <th scope='col'>E-mail</th>
                            <th scope='col'>Telemóvel</th>
                            <th scope='col'>Distrito</th>
                            <th scope='col'>Concelho</th>
                            <th scope='col'>Freguesia</th>
                            <th scope='col'>Carta</th>
                            <th scope='col'>Vagas Disponíveis</th>
                            <th scope='col'>Aceitar Voluntário</th>
                        </tr>" .
                        implode("\n", $html) . "</table></div>";

                $_SESSION["spvt"] = $selection;
                $_SESSION["pvt"] = $html;

            } else { echo "<br><p>Sem resultados.</p><br>";}

            // Termina a ligação com a base de dados
            mysqli_close($conn);
        }

    
    session_start();
    //NIF do user logged in
    $varray = $_SESSION["fetch"];
    $nif = $varray["nif"];
    
    //Select dos voluntários que estão inscritos nos projetos da instituição em causa
    
    /* VERSÃO ANTERIOR
    $select = "*";
    $from = "V_voluntario, V_vol_disponibilidade, V_vol_horario,
            V_vol_alvo, V_vol_area, V_projeto, V_proj_horario";
    $where = "V_voluntario.cc = V_vol_disponibilidade.voluntario
                AND V_vol_disponibilidade.voluntario = V_vol_horario.voluntario
                AND V_voluntario.cc = V_vol_alvo.voluntario
                AND V_voluntario.cc = V_vol_area.voluntario
                AND V_vol_alvo.alvo = V_projeto.alvo
                AND V_vol_area.area = V_projeto.area
                AND V_vol_disponibilidade.inicio <= V_projeto.inicio
                AND V_vol_disponibilidade.fim >= V_projeto.fim
                AND V_vol_horario.dia = V_proj_horario.dia
                AND V_vol_horario.periodo = V_proj_horario.periodo
                AND V_projeto.carta = V_voluntario.carta
                AND V_voluntario.distrito = V_projeto.distrito
                AND V_voluntario.concelho = V_projeto.concelho
                AND V_projeto.nif = ".$nif."
                GROUP BY V_projeto.id, V_voluntario.cc
                ORDER BY V_projeto.id";
    */
    
    $select = "*";
    $from = "V_projeto, V_voluntario, V_candidatura ";
    $where = "V_projeto.nif = ".$nif."
            AND V_projeto.id = V_candidatura.projeto
            AND V_voluntario.cc = V_candidatura.voluntario";
    sqlQuery($select, $from, $where, $nif);
    ?>

    
</body>

</html>
