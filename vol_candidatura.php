<!DOCTYPE html>

<html lang="en">
    
<html>
    
<head>
    <meta charset="utf-8">
</head>

<body>
    
    <?php
    session_start();
    
    //CC do user logged in
    $varray = $_SESSION["fetch"];
    $cc = $varray["cc"];
    echo "CC:   ".$cc."<br>";
    
    //ID do projeto pelo método GET
    $projid = $_GET["projid"];
    echo "ProjID:   ".$projid."<br>";
    
    
    
    //VERIFICAR QUAIS OS PROJETOS JÁ PRESENTES EM BD
    //ligar à BD
    include "openconn.php";
    mysqli_query($conn, "set names 'utf8'");
    //construção da query
    $query2 = "SELECT * FROM V_candidatura";
    //echo $query2."<br>";
    $result2 = mysqli_query($conn, $query2);
    if (!$result2) {
        echo 'Could not run query: ' . mysql_error();
        exit;
    }
    $projs = array();
    $vols = array();
    $vols_checks = array();
    while ($val = mysqli_fetch_array($result2, MYSQLI_NUM)){
        //echo $val[0]."<br>";
        array_push($projs,$val[0]);
        array_push($vols,$val[1]);
        array_push($vols_checks,$val[3]);
    }
        // Termina a ligação com a base de dados
    mysqli_close($conn);      
    
    echo count($projs)."<br>";

    
    for($i = 0; $i < count($projs); ++$i) {
        //NO CASO DO PROJETO ESTAR CRIADO MAS NÃO SELECIONADO PELO VOLUNTÁRIO
        echo $vols_checks[$i]."//<br>";
        
        if ($projs[$i] == $projid &&
            $vols[$i] == $cc &&
            $vols_checks[$i] == 0){
            
            include "openconn.php";
            mysqli_query($conn, "set names 'utf8'");
            //construção da query
            $query3 = "UPDATE V_candidatura
                        SET V_candidatura.vol_check = 1
                        WHERE V_candidatura.projeto = '".$projid."'
                        AND V_candidatura.voluntario = ".$cc;
            //echo $query3;
            $result3 = mysqli_query($conn, $query3);
            if (!$result3) {
                echo 'Could not run query: ' . mysql_error();
                exit;
            }
            mysqli_close($conn);
            
            //header('location: vol_private.php');
            header('location: http://appserver-01.alunos.di.fc.ul.pt/~asw001/Projeto/VolCandAcao_usermsg.php?proj='.$projid.'&vol='.$cc);
            
            exit;
        } /*elseif ($projs[$i] == $projid &&
                  $vols[$i] == $cc &&
                  $vols_checks[$i] == 1){
           //header('location: vol_private.php');
           //header('location: http://appserver-01.alunos.di.fc.ul.pt/~asw001/Projeto/VolCandAcao_usermsg.php?proj='.$projid.'&vol='.$cc);
            exit;
        } elseif ($projs[$i] == $projid &&
                  $vols[$i] == $cc &&
                  $vols_checks[$i] == 0)  {
                  $inst_checks[$i] == 0)  {
            //header('location: http://appserver-01.alunos.di.fc.ul.pt/~asw001/Projeto/VolCandAcao_usermsg.php?proj='.$projid.'&vol='.$cc);
            
            include "openconn.php";
            mysqli_query($conn, "set names 'utf8'");
            //construção da query para acrescentar os valores
            $tableName = "V_candidatura";
            $values = "('".$projid."', ".$cc.", 1)";
            $query = "INSERT INTO ".$tableName."(projeto, voluntario, vol_check) VALUES  ".$values;
            //echo $query;

            //INSERT das query's na BD
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo 'Could not run query: ' . mysql_error();
                exit;
            }
            // Termina a ligação com a base de dados
            mysqli_close($conn);
            
            header('location: http://appserver-01.alunos.di.fc.ul.pt/~asw001/Projeto/VolCandAcao_usermsg.php?proj='.$projid.'&vol='.$cc);
            exit;
        }
        */
    }
    
    header('location: http://appserver-01.alunos.di.fc.ul.pt/~asw001/Projeto/VolCandAcao_usermsg.php?proj='.$projid.'&vol='.$cc);
    
    ?>

    
    
    
</body>

</html>