<h1>Perdi a password</h1>
<?php
  if( !empty($_POST) ){
      
    //https://pt.stackoverflow.com/questions/11124/fun%C3%A7%C3%A3o-mail-n%C3%A3o-envia-o-e-mail
    ini_set('display_errors', true); error_reporting(E_ALL);
    ini_set(PHP_INI_USER,1);
      
    // processar o pedido de ligação à BD
    include "openconn.php";
    mysqli_query($conn, "set names 'utf8'");
            
    //Email indicado pelo user --> deverá ser o mesmo presenta na BD
    $user = $_POST['email'];
    echo "Link de recuperação de password enviado para: <b>".$_POST['email']."</b><br><br><br>";
      
    //$user = mysql_real_escape_string($_POST['email']);
    $query = "SELECT * FROM V_voluntario WHERE email = '".$user."'";
    echo $query;
      
    //Get DB values
    $result = mysqli_query($conn, $query);
 
    // se o utilizador existir, vamos gerar um link único e enviá-lo para o e-mail
    if( mysqli_num_rows($result) == 1 ){
      echo "<p>Foi encontrado um resultado correto na BD para ".$user."</p><br>"; 
      
 
      // gerar a chave de confirmação
      // exemplo adaptado de http://snipplr.com/view/20236/
      $chave = sha1(uniqid( mt_rand(), true));
      echo "Chave gerada e a ser enviada para email do user: ".$chave."<br>";
 
      // elimina registo anterior caso exista e 
      //guarda este par de valores na tabela para confirmar mais tarde
      mysqli_query($conn, "DELETE FROM recuperacao WHERE (utilizador = '$user')");
      $conf = mysqli_query($conn, "INSERT INTO recuperacao VALUES ('$user', '$chave')");
	  
      //No caso dos valores para recuperação serem corretamente adicionados à BD
      if( $conf ){
        echo "<p>Valores adicionado na tabela recuperação: </p>";
        echo "INSERT INTO recuperacao VALUES ('$user', '$chave')<br><br>";
 
        $link = "http://appserver-01.alunos.di.fc.ul.pt/~asw001/Projeto/pswdRecovery/?utilizador=".$user."&confirmacao=".$chave;
          
        $to      = "144castro@gmail.com";//$user; 
        echo "to = ".$to;
        $subject = 'REcuperação de Password';
        $message = 'Olá '.$user.', visite este link '.$link;
        $headers = 'From: -r144castro@gmail.com' . phpversion().
                    'MIME-Version: 1.0' . "\n".
                    'Content-type: text/html; charset=UTF-8' . "\r\n";

        $email = mail($to, $subject, $message);//, $headers);
 
        //if( mail($user, 'Recuperação de password', 'Olá '.$user.', visite este link '.$link) ){
        if( $email ){
          echo '<p>Foi enviado um e-mail para o seu endereço, onde poderá encontrar um link único para alterar a sua password</p>';
            
          //https://pt.stackoverflow.com/questions/11124/fun%C3%A7%C3%A3o-mail-n%C3%A3o-envia-o-e-mail
          echo error_get_last();
 
        } else {
          echo '<p>Houve um erro ao enviar o email (o servidor suporta a função mail?)</p>';
 
        }
 
		// Apenas para testar o link, no caso do e-mail falhar
		echo '<p>Link: '.$link.' (apresentado apenas para testes; nunca expor a público!)</p>';
 
      } else {
        echo '<p>Não foi possível gerar o endereço único</p>';
 
      }
    } else {
	  echo '<p>Esse utilizador não existe</p>';
	}
  } else {
    // mostrar formulário de recuperação
?>
<form method="post">
  <label for="email">E-mail:</label>
  <input type="text" name="email" id="email" />
  <input type="submit" value="Recuperar" />
</form>
<?php
  }
?>