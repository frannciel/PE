<?php

session_start(); // Inicia a sessão
if (!isset($_POST["codigo"]) || !isset($_POST["cpf_cnpj"])) {
      header("location:../views/form_receber.php");
}
require_once 'controller.php';

$email_remetente 	= "pyngolee@gmail.com";
$email_servidor 	= "pyngolee@gmail.com";

//<><><><><><><><><> Informações recebidas do formulário via POST  <><><><><><>><><><>//
$codigo_envio 	= preg_replace("/[^0-9\s]/", "", getPost("codigo"));
$cpf_cnpj     	= preg_replace("/[^0-9\s]/", "", getPost("cpf_cnpj"));
$telefone		= preg_replace("/[^0-9\s]/", "", getPost("telefone"));
$nome 			= getPost("nome");
$cargo			= getPost("cargo");
$email_destin	= email_validar(getPost("email"));
//<><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><<><><<><<<><><><><>//

$email = Controller::getEmail(array('codigo_envio', $codigo_envio));

if($codigo_envio == $email->codigo_envio && $cpf_cnpj == $email->cpf_cnpj && $email_destin){

	$id_destinatario = db_insert_destinatario($email->id);

	$_SESSION['id_destinatario'] = $id_destinatario;
	$_SESSION['id_email'] = $email->id;
	email_enviar(getAssunto($email->codigo_envio), getRecibo());
	//header("location:../views/download.php");
	//echo $id_destinatario;
	echo getRecibo();
}

//------------------------------------------------------------------------//
function getPost($valor) {
    return isset($_POST[$valor]) ? $_POST[$valor] : '';
}
//------------------------------------------------------------------------//
function email_validar($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
//------------------------------------------------------------------------//
function getAssunto($codigo){
	return "[ IFBA EUNAPOLIS ] - Recibo Eletrônico nº ".$codigo;
}
//------------------------------------------------------------------------//
function email_enviar($assunto, $mensagem) {

	global $email_remetente, $email_destin, $email_servidor;

    $headers = "From: $email_servidor\r\n" .
               "Reply-To: $email_remetente\r\n" .
               "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  
  	return mail($email_destin, $assunto, $mensagem, $headers);
}
//-------------------------------------------------------------------------//
/*
*@Description Chama o meto do controle que cria novo gestro na tabela de destinatario
* 			  apos fazer as verificações se o usuario já existe
*@Param id do email ao qual pertence os anexos que o destinatário deseja receber
*@Return id do novo destinatario que acabou de cadastrar
*/
function db_insert_destinatario($id_email) {

	global $nome, $cargo, $telefone, $email_destin;
	// id do destinatario
	$id = '';
	// Retorna todos os destinatarios que receberam os anexos enviados por email
	$destinatarios = Controller::getDestinatarios(array('id_email', $id_email));

    // verifica se o destinatário já recebeu os anexos anteriormente, em caso positivo insere seu id na vaiável 
	foreach ($destinatarios as  $destinatario) {
		echo "string1";
    	if ($destinatario->nome == $nome && $destinatario->cargo == $cargo && $destinatario->email == $email_destin) {
    		echo "string2";
    		$id = $destinatario->id;
    	}
	}
	//se a variável ainda está nula salva os dados do destinatario recebedor no banco de dados e insere seu id na variável
	if(empty($id)){
		echo "string3";
		$id = Controller::setDestinatario(array($nome, $cargo, $telefone, $email_destin, $id_email));	
	}
	// Retorna o id destinatario reccebedor salvo no banco de dados
	return $id;
}
//-------------------------------------------------------------------------//
/*
*@Description Função que utilizando buffer gera o recibo de recebimeto 
*@Return o codigo html contendo o recibo de entrega recebimento dos anexos
*/
function getRecibo(){

	ob_start();
	include("create_recibo.php");
	$recibo = ob_get_contents();
	ob_end_clean();
	return $recibo;
}
//-------------------------------------------------------------------------//
?>