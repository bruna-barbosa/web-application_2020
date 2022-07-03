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
            if ($whereElem != ""){
                $query = "SELECT ".$selectElem." FROM ".$fromElem." WHERE ".$whereElem;
            }

            //Get DB values
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo 'Could not run query: ' . mysql_error();
                exit;
            }

            $vnom = array();
            $veml = array();
            $vdtr = array();
            $vconc = array();
            $vfreg = array();

            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){

                $vnom[] = $row[1];
                $veml[] = $row[5];
                $vdtr[] = $row[6];
                $vconc[] = $row[7];
                $vfreg[] = $row[8];

                $html[] =   "<tr>" . 
                                "<td>" . htmlspecialchars($row[12]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[0]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[1]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[2]) . "</td>" .
                                "<td>" . intval(date("Y-m-d") - 
                                                htmlspecialchars($row[3]) - 
                                                date("1-0-0")) . "</td>" .
                                "<td>" . htmlspecialchars($row[3]) . "</td>" .
                                "<td>" . htmlspecialchars($row[10]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[5]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[4]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[6]) . "</td>" .
                                "<td>" . htmlspecialchars($row[7]) . "</td>" .
                                "<td>" . htmlspecialchars($row[8]) . "</td>" . 
                                "<td>" . htmlspecialchars($row[11]) . "</td>" . 
                            "</tr>";
            }

            $vdtr = array_unique($vdtr);
            $vconc = array_unique($vconc);
            $vfreg = array_unique($vfreg);

            $selection = "<form class='form-group border' action=''>
                <select id='vnom' class = 'form-select' name='vnom' onchange='setvnom(this.value);vsearch();'>
                    <option value=''>Nome:</option>";

            for ($i=0; $i < count($vnom); $i++) {
                $selection = $selection . "<option value='$vnom[$i]'>$vnom[$i]</option>";
            }

            $selection = $selection . "</select>
                <select id='veml' class = 'form-select' name='veml' onchange='setveml(this.value);vsearch();'>
                    <option value=''>Email:</option>";

            for ($i=0; $i < count($veml); $i++) {
                $selection = $selection . "<option value='$veml[$i]'>$veml[$i]</option>";
            }

            $selection = $selection . "</select>
                <select id='vdtr' class = 'form-select' name='vdtr' onchange='setvdtr(this.value);vsearch();'>
                    <option value=''>Distrito:</option>";

            $keys = array_keys($vdtr);

            for ($i=0; $i < count($vdtr); $i++) {
                $k = $keys[$i];
                $selection = $selection . "<option value='$vdtr[$k]'>$vdtr[$k]</option>";
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

            $selection = $selection . "</select> </form>";

            if (mysqli_num_rows($result)>0) {
                $html = "<div id = 'vols'>
                        <table id='myTable'>
                         <tr class='header'>
                            <th>User</th>
                            <th>CC</th>
                            <th>Nome</th>
                            <th>Género</th>
                            <th>Idade</th>
                            <th>Nascimento</th>
                            <th>Foto</th>
                            <th>E-mail</th>
                            <th>Telemóvel</th>
                            <th>Distrito</th>
                            <th>Concelho</th>
                            <th>Freguesia</th>
                            <th>Carta</th>
                        </tr>" .
                        implode("\n", $html) . "</table></div>";
                
                // Retorno da tabela com os voluntários em BD
                echo $selection . $html;
            } else { echo "<br><p>Sem resultados.</p><br>";}

            // Termina a ligação com a base de dados
            mysqli_close($conn);
        }
    
        
        echo sqlQuery("*", "V_voluntario", "");
        ?>
    
</body>

</html>