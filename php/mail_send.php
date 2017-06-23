<?php

session_start(); // Inicia a sessão
require_once "../bd/conexao.php";
$PDO = Conexao::getInstance();

//---------------- Email remetente da Mesnagem -----------------------------------//

$email_remetente 	= "pyngolee@gmail.com";
$email_servidor 	= "pyngolee@gmail.com";

//<><><><><><><><><> Informações recebidas do formulário via POST  <><><><><><>><><><>//

$cpf_cnpj       	= preg_replace("/[^0-9\s]/", "", getPost("cpf_cnpj"));
$documentos     	= getPost("documento");
$links				= getPost("link");
$assunto        	= getAssunto(getPost("assunto"));
$email_destin   	= email_validar(getPost("email"));
$nome_destin        = getPost("nome");
$codigo_envio       = getCodigo_envio();
$texto              = nl2br(getPost("mensagem")); // mensagem recebida pelo usuário
$mensagem   		= getMensagem($texto);

// Dados que serão utilizados na pagina de sucesso ou erro //

$_SESSION['email'] 		= $email_destin ;
$_SESSION['codigo']		= $codigo_envio ;

//<><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><<><><<><<<><><><><>//

if ($nome_destin && $email_destin && $mensagem && $cpf_cnpj) 
{
	if(email_enviar())
	{
		// Sava email e retorna no BD e retorna o id
		$ultimoId = db_insert_email();
		// salva os anexos no BD
		db_insert_anexo($ultimoId);
		//Pagina de secesso
		$pagina = "../views/form_sucesso.php";
	}else{
		// Pagina de erro
		$pagina = "../views/form_error.php";
	}
	header("location:$pagina");
}
$PDO = NULL;
//------------------------------------------------------------------------//
function getPost($valor) {
    return isset($_POST[$valor]) ? $_POST[$valor] : '';
}

//------------------------------------------------------------------------//
function email_validar($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function getAssunto ($assunto){
    return "[IFBA EUNAPOLIS]  ".$assunto;
}
/*
//------------------------------------------------------------------------//
function email_enviar($email_remeten, $email_destin, $email_servidor, $assunto, $mensagem) {
    $headers = "From: $email_servidor\r\n" .
               "Reply-To: $email_remeten\r\n" .
               "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  
  	return mail($email_destin, $assunto, nl2br($mensagem), $headers);
}*/
//------------------------------------------------------------------------//
function email_enviar() {

	global $email_remetente, $email_destin, $email_servidor, $assunto, $mensagem;

    $headers = "From: $email_servidor\r\n" .
               "Reply-To: $email_remetente\r\n" .
               "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  
  	return mail($email_destin, $assunto, $mensagem, $headers);
}
//-------------------------------------------------------------------------//
/*
    Metodo que faz que salva os dados no bannco de dados antes de enviar o emial
    para o fornecedor.
*/
function db_insert_email() {

	global $PDO, $nome_destin, $email_destin, $cpf_cnpj, $codigo_envio, $assunto, $texto ;

    try 
    {
        $sql = "INSERT INTO email (codigo_envio, cpf_cnpj, nome_destinatario, email_destinatario, assunto, mensagem, id_usuario) 
        VALUES (:codigo_envio, :cpf_cnpj, :nome_destinatario, :email_destinatario, :assunto, :mensagem, :id_usuario)";

        $conn = $PDO->prepare($sql);
        $conn->bindValue(":codigo_envio", $codigo_envio);
        $conn->bindValue(":cpf_cnpj", $cpf_cnpj);
        $conn->bindValue(":nome_destinatario", $nome_destin);
        $conn->bindValue(":email_destinatario", $email_destin);
        $conn->bindValue(":assunto", $assunto);
        $conn->bindValue(":mensagem",  $texto);
        $conn->bindValue(":id_usuario",  $_SESSION["id"]);
        $conn->execute();
        return $PDO->lastInsertId();
        
    } catch (Exception $e) {
        print("Ocorreu ao tentar enviar o arquivo, tente novamnete ou contate o Administrador");
        print($e->getMessage());
    }
}


function db_insert_anexo( $id_email) {

	global $PDO, $documentos, $links;

    try 
    {
        $sql = "INSERT INTO anexo (documento, link, id_email) 
        VALUES (:documento, :link, :id_email)";

        $conn = $PDO->prepare($sql);

        for ($i=0; $i < count($documentos); $i++) { 

        	$conn->bindValue(":documento", $documentos[$i]);
        	$conn->bindValue(":link", $links[$i]);
        	$conn->bindValue(":id_email", $id_email);
      		$conn->execute();
        }
        
    } catch (Exception $e) {
        print("Ocorreu ao tentar enviar o arquivo, tente novamnete ou contate o Administrador");
        print($e->getMessage());
    }
}
/*
jesilva@LBV.ORG.BR
bb
ag 3344 -8
cc 205010-2
WELLING
*/

//----------------------------------------------------------------------------//
/*
    Metodo que Gera e retorna o código de envio
*/
function getCodigo_envio(){ 

	global $PDO;

	$sql = $PDO->query("SELECT max(id) from email");
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	$codigo = date('Y').$result["max(id)"];
	while ( strlen($codigo) <= 13) {
		$codigo .= (rand(1,9));
	}
	return $codigo;
}
//-------------------------------------------------------------------------//
/*
    O metodo que recebe o codigo de envio e a mensagem recebida do usuário e prepara
    o texto a ser enviado pelo email.
*/
function getMensagem($mensagem){
   
	global $codigo_envio, $documentos;
   /*
    $parte_dois = '';
    $parte_um   =   "<div style='width: 80%; margin-top:30px;'>".
                    "<hr>".
                    "<table><tr><td><h4>Código de Envio:</h4></td><td style='color:#3b5998;'><h4>".$codigo."</h4></td></tr></table>".
                    "<p style='color:#3b5998'><a href='http://localhost/Sendark/form_receber.php?codigo=".$codigo."'><h4>Click aqui para ter acesso aos documentos em anexo</h4></a></p>".
                    "<table border='1 'width='100%'>".
                    " <th>ANEXOS</th>";
    foreach ($documentos as  $value) 
    {
        $parte_dois .= "<tr><td>".$value."</td></tr>";
    }
    $parte_tres =   "</table>".
                    "<p align='justify'>".
                        "Acesse e preencha o formulário para baixar os documentos em anexo. ". 
                        "Caso tenha dificuldade para acessar a pagina do formulário copie o URL abaixo e cole ".
                        "na barra de endereço do navegador ou entre em contato  com o  IFBA  Campus Eunápolis.</p>".
                    "<p>http://localhost/Sendark/form_receber.php?codigo=".$codigo."</p>".
                    "</div>".
                    "<a href='http://portal.ifba.edu.br/eunapolis'><img src='https://scontent-gru2-2.xx.fbcdn.net/v/t1.0-9/17457839_1174545449337568_6460502873829503647_n.jpg?oh=774f883eefd69980f2d3ffbe5de2c3f1&oe=596261B2'/></a>";
    return $mensagem.$parte_um.$parte_dois.$parte_tres;
    */
    ob_start();
	include("mensagem.php");
	$msg = ob_get_contents();
	ob_end_clean();
	echo $msg ;
	return $mensagem.$msg;
}

?>