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

            //Set Query
            $query = "SELECT ".$selectElem." FROM ".$fromElem; //echo $query;
            if ($whereElem != ""){
                $query = "SELECT ".$selectElem." FROM ".$fromElem." WHERE ".$whereElem;
            }

            //Get DB values
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo 'Could not run query: ' . mysql_error();
                exit;
            }

            $pnif = array();
            $pact = array();
            $pdtr = array();
            $pconc = array();
            $pfreg = array();

            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){

                $pnif[] = $row[6];
                $pact[] = $row[14];
                $pdtr[] = $row[7];
                $pconc[] = $row[8];
                $pfreg[] = $row[9];

                $html[] =   "<tr>" . 
                                "<td>" . htmlspecialchars($row[0]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[1]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[2]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[3]) . "</td>" .
                                "<td>" . htmlspecialchars($row[4]) . "</td>" .
                                "<td>" . htmlspecialchars($row[5]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[6]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[7]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[8]) . "</td>" .
                                "<td>" . htmlspecialchars($row[9]) . "</td>" .
                                "<td>" . htmlspecialchars($row[10]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[11]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[12]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[13]) . "</td>" . 
                            "</tr>";
            }

            $pnif = array_unique($pnif);
            $pact = array_unique($pact);
            $pdtr = array_unique($pdtr);
            $pconc = array_unique($pconc);
            $pfreg = array_unique($pfreg);

            $selection = "<form class='form-group border' action=''>
                <select id='pnif' class = 'form-select' name='pnif' onchange='setpnif(this.value);psearch();'>
                    <option value=''>NIF:</option>";

            $keys = array_keys($pnif);

            for ($i=0; $i < count($pnif); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$pnif[$k]'>$pnif[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='pact' class = 'form-select' name='pact' onchange='setpact(this.value);psearch();'>
                    <option value=''>Actividade:</option>";

            $keys = array_keys($pact);

            for ($i=0; $i < count($pact); $i++) {
                $k = $keys[$i];
                if ($k == 1) {
                    $pact[$k] = "Ativo";
                } else {
                    $pact[$k] = "Inativo";
                }
                $selection = $selection . "<option value='$pact[$k]'>$pact[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='pdtr' class = 'form-select' name='pdtr' onchange='setpdistr(this.value);psearch();'>
                    <option value=''>Distrito:</option>";

            $keys = array_keys($pdtr);

            for ($i=0; $i < count($pdtr); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$pdtr[$k]'>$pdtr[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='pconc' class = 'form-select' name='pconc' onchange='setpconc(this.value);psearch();'>
                    <option value=''>Concelho:</option>";

            $keys = array_keys($pconc);

            for ($i=0; $i < count($pconc); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$pconc[$k]'>$pconc[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='pfreg' class = 'form-select' name='pfreg' onchange='setpfreg(this.value);psearch();'>
                    <option value=''>Freguesia:</option>";

            $keys = array_keys($pfreg);

            for ($i=0; $i < count($pfreg); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$pfreg[$k]'>$pfreg[$k]</option>";
            }

            $selection = $selection . "</select> </form>";

            if (mysqli_num_rows($result)>0) {
                $html = "<div id = 'pjt'>
                        <table id='myTable'>
                         <tr class='header'>
                            <th>ID</th>
                            <th>Função</th>
                            <th>Descrição</th>
                            <th>Área</th>
                            <th>Alvo</th>
                            <th>Foto</th>
                            <th>NIF Instituição</th>
                            <th>Distrito</th>
                            <th>Concelho</th>
                            <th>Freguesia</th>
                            <th>Carta</th>
                            <th>Vagas</th>
                            <th>Início</th>
                            <th>Fim</th>
                        </tr>" .
                        implode("\n", $html) . "</table></div>";
                                
                // Retorno da tabela com os voluntários em BD
                echo $selection . $html;
            } else { echo "<br><p>Sem resultados.</p><br>";}

            // Termina a ligação com a base de dados
            mysqli_close($conn);
        }
    
        $select = "id, funcao, descricao, area, alvo, 
        foto, nif, distrito, concelho,                            
        freguesia, carta, vagas, inicio,                          
        fim, atividade";
        echo sqlQuery($select, "V_projeto", "");
        ?>
    
</body>

</html>