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
            $query = "SELECT ".$selectElem." FROM ".$fromElem;
            echo $que;ry;
            if ($whereElem != ""){
                $query = "SELECT ".$selectElem." FROM ".$fromElem." WHERE ".$whereElem;
            }

            //Get DB values
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo 'Could not run query: ' . mysql_error();
                exit;
            }

            $inom = array();
            $ieml = array();
            $idtr = array();
            $iconc = array();
            $ifreg = array();

            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){

                $inom[] = $row[1];
                $ieml[] = $row[8];
                $idtr[] = $row[5];
                $iconc[] = $row[6];
                $ifreg[] = $row[7];

                $html[] =   "<tr>" . 
                                "<td>" . htmlspecialchars($row[14]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[0]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[1]) . "</td>" .
                                "<td>" . htmlspecialchars($row[2]) . "</td>" .
                                "<td>" . htmlspecialchars($row[9]) . "</td>" .
                                "<td>" . htmlspecialchars($row[13]) . "</td>" .
                                "<td>" . htmlspecialchars($row[8]) . "</td>" .
                                "<td>" . htmlspecialchars($row[3]) . "</td>" .
                                "<td>" . htmlspecialchars($row[4]) . "</td>" .
                                "<td>" . htmlspecialchars($row[5]) . "</td>" .
                                "<td>" . htmlspecialchars($row[6]) . "</td>" .
                                "<td>" . htmlspecialchars($row[7]) . "</td>" .
                                "<td>" . htmlspecialchars($row[10]) . "</td>" .
                                "<td>" . htmlspecialchars($row[11]) . "</td>" .
                            "</tr>";
            }

            $idtr = array_unique($idtr);
            $iconc = array_unique($iconc);
            $ifreg = array_unique($ifreg);

            $selection = "<form class='form-group border' action=''>
                <select id='inom' class = 'form-select' name='inom' onchange='setinom(this.value);isearch();'>
                    <option value=''>Nome:</option>";

            for ($i=0; $i < count($inom); $i++) {
                $selection = $selection . "<option value='$inom[$i]'>$inom[$i]</option>";
            }

            $selection = $selection . "</select>
                <select id='ieml' class = 'form-select' name='ieml' onchange='setieml(this.value);isearch();'>
                    <option value=''>Email:</option>";

            for ($i=0; $i < count($ieml); $i++) {
                $selection = $selection . "<option value='$ieml[$i]'>$ieml[$i]</option>";
            }

            $selection = $selection . "</select>
                <select id='idtr' class = 'form-select' name='idtr' onchange='setidtr(this.value);isearch();'>
                    <option value=''>Distrito:</option>";

            $keys = array_keys($idtr);

            for ($i=0; $i < count($idtr); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$idtr[$k]'>$idtr[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='iconc' class = 'form-select' name='iconc' onchange='seticonc(this.value);isearch();'>
                    <option value=''>Concelho:</option>";

            $keys = array_keys($iconc);

            for ($i=0; $i < count($iconc); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$iconc[$k]'>$iconc[$k]</option>";
            }

            $selection = $selection . "</select>
                <select id='ifreg' class = 'form-select' name='ifreg' onchange='setifreg(this.value);isearch();'>
                    <option value=''>Freguesia:</option>";

            $keys = array_keys($ifreg);

            for ($i=0; $i < count($ifreg); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$ifreg[$k]'>$ifreg[$k]</option>";
            }

            $selection = $selection . "</select> </form>";

            if (mysqli_num_rows($result)>0) {
                $html = "<div id = 'insts'>
                        <table id='myTable'>
                         <tr>
                            <th>Username</th>
                            <th>NIF</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>URL</th>
                            <th>Foto</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Morada</th>
                            <th>Distrito</th>
                            <th>Concelho</th>
                            <th>Freguesia</th>
                            <th>Representante</th>
                            <th>E-mail Repr.</th>
                        </tr>" .
                        implode("\n", $html) . "</table></div>";
                
                // Retorno da tabela com os voluntários em BD
                echo $selection . $html;
            } else { echo "<br><p>Sem resultados.</p><br>";}

            // Termina a ligação com a base de dados
            mysqli_close($conn);
        }
    
        echo sqlQuery("*", "V_instituicao", "");

        ?>
    
</body>

</html>