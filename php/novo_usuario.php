<?php

session_start(); // Inicia a sessão
require_once 'controller.php';
if (!isset($_SESSION["email"]) || !isset($_SESSION["senha"])) {
  	header("location:../index.php");
}
// Se o usuario não tiver perfil para cadastrar usuario ele é redirecionado para o tela princpil
if (Controller::getUsuario(array('id', $_SESSION['id']))->perfil != 1) {
	header("location:../index.php");
}

$nome     		= getPost("nome");
$sobrenome    	= getPost("sobrenome");
$email			= filter_var(getPost("email"), FILTER_VALIDATE_EMAIL);
$cpf       		= preg_replace("/[^0-9\s]/", "", getPost("cpf"));
$dataNasc   	= preg_replace("/[^0-9\s]/", "", getPost("dataNasc"));
$perfil      	= getPost("perfil");
$telefone      	= preg_replace("/[^0-9\s]/", "", getPost("telefone"));
$sexo           = getPost("sexo"); // mensagem recebida do usuário
$senha          = "NOVA".rand(1,9).rand(1,9).rand(1,9).rand(1,9);
$hash 			= password_hash($senha , PASSWORD_DEFAULT);

$remetente 	= "pyngolee@gmail.com";
$servidor 	= "pyngolee@gmail.com";


var_dump($_POST);
/*
*@Descrition coleta as informações enviadas via post pelo formulario
*@Param nome do atributo do formulario que contenha a informação a ser recebida
*@Return O valor informado pelo usuario durante preenchimento do formulario
*/
//------------------------------------------------------------------------//
function getPost($valor) {
    return isset($_POST[$valor]) ? $_POST[$valor] : '';
}
if($nome && $sobrenome && $email && $cpf && $dataNasc && $perfil && $telefone && $sexo){

	if (Controller::getUsuarioExiste(array('email', $email)) > 0) {
		echo "Email associado a outro usuário";
	}
	}else{
		echo "Email invalido! o formato correto é exemplo@servidor.com";
	}

	if (Controller::getUsuarioExiste(array('cpf', $cpf)) > 0) {
		echo "CPF associado a outro usuário";
	}
	if (Controller::getUsuarioExiste(array('telefone', $telefone)) > 0) {
		echo "Telefone associado a outro usuário";
	}

	$id = Controller::setUsuario(array($nome,$sobrenome,$email,$cpf,$dataNasc,$perfil,$telefone,$sexo,$hash));

	if(enviarEmail($email, $remetente, $servidor)){
		//header("location:../views/home.php");
		echo "Usuário cadastrado com sucesso!";
	} else{
		echo "Falha ao cadastrar usuário, tente novamente e contate o administrador";
	}
}else{

	echo "vou chupar a novinha";
}
//------------------------------------------------------------------------//
/*

//---------------------------------------------------------------------//
/*
*@Descrition Function que envia os emails apartir dos dados coletados pelo sistema
*@Return  boolen indicando se o mail foi ou não enviado
*/
function enviarEmail($email, $remetente, $servidor) {

    $headers = "From: $servidor\r\n" .
               "Reply-To: $remetente\r\n" .
               "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  
  	return mail($email, getAssunto(), nl2br(getMensagem()), $headers);
}

//-------------------------------------------------------------------------//
/*
*@Descrition O metodo que recebe o codigo de envio e a mensagem recebida do usuário
*            e acrescenta partes geradas pelo sistema.
*@Return  O texto da mensagem a pronta para ser enviado pelo email.
*/
function getMensagem(){

	global $senha, $nome, $sobrenome;

	$mensagem = "
	Seja bem vindo ".$nome." ".$sobrenome."!

	Agora você já pode enviar seus documentos através do nosso sistema eletrônico.
	Acesse o nosso site através do endereço http://localhost/protocolo/index.php e troque sua senha no primeiro acesso.

	Sua senha previsória: ".$senha.".
	
	Fique a vontade e aproveite!

	Equipe
	eProtocolo
	";
   	return $mensagem;
}

function getAssunto(){
	return "Seja bem vindo a Protocolo Eletrônico";
}
?>