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

            $cid = array();
            $ci = array();
            $cv = array();

            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){

                $cid[] = $row[0];
                $ci[] = $row[2];
                $cv[] = $row[4];

                $html[] =   "<tr>" . 
                                "<td>" . htmlspecialchars($row[0]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[1]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[2]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[3]) . "</td>" .
                                "<td>" . htmlspecialchars($row[4]) . "</td>" .
                            "</tr>";
            }

            $cid = array_unique($cid);
            $ci = array_unique($ci);
            $cv = array_unique($cv);

            $selection = "<form class='form-group border' action=''>
                <select id='cid' class = 'form-select' name='pjtid' onchange='setcid(this.value);csearch();'>
                    <option value=''>ID Projeto:</option>";

            $keys = array_keys($cid);

            for ($i=0; $i < count($cid); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$cid[$k]'>$cid[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='ci' class = 'form-select' name='ci' onchange='setci(this.value);csearch();'>
                    <option value=''>Instituição:</option>";

            $keys = array_keys($ci);

            for ($i=0; $i < count($ci); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$ci[$k]'>$ci[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='cv' class = 'form-select' name='cv' onchange='setcv(this.value);csearch();'>
                    <option value=''>Voluntário:</option>";

            $keys = array_keys($cv);

            for ($i=0; $i < count($cv); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$cv[$k]'>$cv[$k]</option>";
            }

            $selection = $selection . "</select> </form>";

            if (mysqli_num_rows($result)>0) {
                $html = "<div id = 'aplications'>
                        <table id='myTable'>
                         <tr class='header'>
                            <th>ID Projeto</th>
                            <th>NIF Instituição</th>
                            <th>Instituição</th>
                            <th>CC Voluntário</th>
                            <th>Voluntário</th>
                        </tr>" .
                        implode("\n", $html) . "</table></div>";
                                
                // Retorno da tabela com os voluntários em BD
                echo $selection . $html;
            } else { echo "<br><p>Sem resultados.</p><br>";}

            // Termina a ligação com a base de dados
            mysqli_close($conn);
        }
    
        $select = "V_candidatura.projeto, V_projeto.nif, V_instituicao.nome, 
                   V_candidatura.voluntario, V_voluntario.nome";
        $from = "V_candidatura, V_projeto,V_instituicao, V_voluntario";
        $where = "V_candidatura.projeto = V_projeto.id
                  and V_projeto.nif = V_instituicao.nif
                  and V_voluntario.cc = V_candidatura.voluntario";
        echo sqlQuery($select, $from, $where);
        ?>
    
</body>

</html>