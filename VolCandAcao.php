<?php
require_once "lib/nusoap.php";

function nomeclientes($vol, $proj)
{
	$dbhost="appserver-01.alunos.di.fc.ul.pt";
	$dbuser="asw001";	$dbpass="m34ng1rls2004";	$dbname="asw001";
	//Cria a ligação à BD
	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	//Verifica a ligação à BD
	if(mysqli_connect_error()){die("Database connection failed:".mysqli_connect_error());}

	$sql="SELECT inst_check, vol_check
          FROM V_candidatura 
          WHERE voluntario = ".$vol."
          AND projeto = '".$proj."'";
	$result=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($result,MYSQLI_NUM))
	{
		$html[]="<tr><td>".implode("</td><td>",$row)."</td></tr>";
        $inst_check = $row[0];
        $vol_check = $row[1];
	}
	$html="<table>".implode("\n",$html)."</table>";	
	//echo $html;
	mysqli_close($conn);
    if ($inst_check == 1 &&
        $vol_check == 1){
        $msg = "Aceite";
    } else {
        $msg = "Não Aceite";
    }
	return $msg;
}

$server = new soap_server();
$server->configureWSDL('cumpwsdl', 'urn:cumpwsdl');
$server->register("nomeclientes", // nome metodo
array('nome' => 'xsd:string',
      'projeto' => 'xsd:string'), // input
array('return' => 'xsd:string'), // output
	'uri:cumpwsdl', // namespace
	'urn:cumpwsdl#nomeclientes', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>
