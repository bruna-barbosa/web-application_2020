<?php
require_once "lib/nusoap.php";

function nomeclientes($nome)
{
	$dbhost="appserver-01.alunos.di.fc.ul.pt";
	$dbuser="asw001";	$dbpass="m34ng1rls2004";	$dbname="asw001";
	//Cria a ligação à BD
    
	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    mysqli_query($conn, "set names 'utf8'");
	//Verifica a ligação à BD
	if(mysqli_connect_error()){die("Database connection failed:".mysqli_connect_error());}

	$sql="SELECT p.distrito, p.concelho, p.freguesia, p.funcao, p.area, p.alvo, hp.dia, hp.periodo
          FROM V_projeto p, V_proj_horario hp
          WHERE p.id = hp.projeto
          AND p.id = '".$nome."'
          ORDER BY hp.dia, hp.periodo ASC";
	$result=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($result,MYSQLI_NUM))
	{
		$html[]="<tr><td>".implode("</td><td>",$row)."</td></tr>";
	}
	$html="<table>".implode("\n",$html)."</table>";	
	// echo $html;
	mysqli_close($conn);
	return $html;
}

$server = new soap_server();
$server->configureWSDL('cumpwsdl', 'urn:cumpwsdl');
$server->register("nomeclientes", // nome metodo
array('nome' => 'xsd:string'), // input
array('return' => 'xsd:string'), // output
	'uri:cumpwsdl', // namespace
	'urn:cumpwsdl#nomeclientes', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>