<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
    
<body>
    <?php
        
        //Função que efetua as querys e que constroi o echo para HTML
        function sqlQuery($selectElem, $fromElem, $whereElem){
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
            //echo "<br>".$query."<br>";

            //Get DB values
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo 'Could not run query: ' . mysql_error();
                exit;
            }

            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){

                
                //codigo único do projeto
                $id = htmlspecialchars($row[1]);
                //Info da moldura
                $funcao = htmlspecialchars($row[7]);
                //$desc = htmlspecialchars($row[8]);
                $data_in = htmlspecialchars($row[11]);
                $data_fim = htmlspecialchars($row[12]);
                $pop_alvo = htmlspecialchars($row[9]);
                $area = htmlspecialchars($row[6]);
                $freg = htmlspecialchars($row[5]);
                //FOTO
                $foto = htmlspecialchars($row[13]); //echo $foto."<br>";
                
                $html[] = '<div class="col-sm-6 col-md-6 col-lg-4 mb-5">
                                <div class="post-entry">
                                  <a href="vol_view_project.php?projid='.$id.'" class="thumb">
                                    <span class="date">'.$data_in.' <br> a <br> '.$data_fim.'</span>
                                    
                                    <img src="images/hero_1.jpg" alt="Image" class="img-fluid">
                                    
                                    
                                    
                                  </a>
                                  <div class="post-meta text-center">
                                    <a href="#">
                                      <span class="icon-user"></span>
                                      <span>'.$pop_alvo.'</span>
                                    </a>
                                    <a href="#">
                                      <span class="icon-work"></span>
                                      <span>'.$area .'</span>
                                    </a>
                                  </div>
                                  <div class="post-meta text-center">
                                    <a href="#">
                                      <span class="icon-room"></span>
                                      <span>'.$freg.'</span>
                                    </a>
                                  </div>
                                  <h3><a href="vol_view_project.php?projid='.$id.'">#'.$id.": ".$funcao.'</a></h3>
                                  <a href="vol_candidatura.php?projid='.$id.'" 
                                   class="btn btn-primary">Inscrever-me!</a>
                                </div>
                            </div>';
            }
            

            if (mysqli_num_rows($result)>0) {
                $html = '<div class="row">'.implode($html).'</div>';
                
                echo '<div class="row mb-5">';
                // Barra de pesquisa por área de interesse
                echo '<input type="text" class="myInput" id="myInput1" onkeyup="filtra_vol(area)" 
                placeholder="Pesquise por área de interesse.." title="Type in a name">';
                // Barra de pesquisa por população alvo
                echo '<input type="text" class="myInput" id="myInput2" onkeyup="filtra_vol(alvo)" 
                placeholder="Pesquise por população alvo.." title="Type in a name">';
                // Barra de pesquisa por disponibilidade
                echo '<input type="text" class="myInput" id="myInput0" onkeyup="filtra_vol(disp)" 
                placeholder="de aaaa-mm-aa.." title="Type in a name">';
                echo '<input type="text" class="myInput" id="myInput0" onkeyup="filtra_vol(disp)" 
                placeholder="até aaaa-mm-aa.." title="Type in a name">';
                // Barra de pesquisa por Freguesia
                echo '<input type="text" class="myInput" id="myInput33" onkeyup="filtra_vol(freg)" 
                placeholder="Pesquise por freguesia.." title="Type in a name">';
                echo '</div>';
                
                // Retorno da tabela com os voluntários em BD
                echo $html;
            } else { echo "<br><p>Sem resultados.</p><br>";}

            // Termina a ligação com a base de dados
            mysqli_close($conn);
        }
    
    //NIF do user logged in
    $varray = $_SESSION["fetch"];
    $cc = $varray["cc"];
    
    //Selecionar todos os projetos para os quais os utilizadores tenham perfil adequado
    $select = "*";
    $from = "V_projeto, V_vol_disponibilidade, V_vol_alvo, V_vol_area, V_voluntario";
    $where = "V_projeto.inicio >= V_vol_disponibilidade.inicio
            AND V_projeto.fim <= V_vol_disponibilidade.fim
            and V_projeto.alvo = V_vol_alvo.alvo
            and V_projeto.area = V_vol_area.area
            and V_projeto.distrito = V_voluntario.distrito
            and V_projeto.concelho = V_voluntario.concelho
            and V_voluntario.cc = ".$cc."
            and V_voluntario.cc = V_vol_area.voluntario
            and V_voluntario.cc = V_vol_alvo.voluntario
            and V_voluntario.cc = V_vol_disponibilidade.voluntario
            GROUP BY V_projeto.id
            ORDER BY V_projeto.id";
    
    
    echo sqlQuery($select, $from, $where);
    
    
    
        ?>
    
</body>

</html>