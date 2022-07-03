<?php
$proj = "FD35";

require_once "lib/nusoap.php";

$client = new nusoap_client(
    'http://appserver-01.alunos.di.fc.ul.pt/~asw001/Projeto/InfoAcaoVol.php'
);
$error = $client->getError();
$result = $client->call('nomeclientes', array('nome' => $proj));	//handle errors

echo "<h2>Pedido</h2>";
echo "<pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
echo "<h2>Resposta</h2>";
echo "<pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";

if ($client->fault)
{   //check faults
}
else {    $error = $client->getError();		 //handle errors
   		 echo "<h2>$result</h2>";
}
?>