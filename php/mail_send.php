<?php

session_start(); // Inicia a sessão
require_once 'controller.php';
//---------------- Email remetente da Mesnagem -----------------------------------//

$email_remetente 	= "pyngolee@gmail.com";
$email_servidor 	= "pyngolee@gmail.com";

//<><><><><><><><><> Informações recebidas do formulário via POST  <><><><><><>><><><>//

$cpf_cnpj       	= preg_replace("/[^0-9\s]/", "", getPost("cpf_cnpj"));
$documentos     	= getPost("documento");
$links				= getPost("link");
$assunto        	= getPost("assunto");
$email_destin   	= validarEmail(getPost("email"));
$nome_destin        = getPost("nome");
$codigo_envio       = gerarCodigoEnvio();
$texto              = nl2br(getPost("mensagem")); // mensagem recebida do usuário
$mensagem   		= gerarMensagem($texto);// mensagem recebido e tratada pelo sistema

// Dados que serão utilizados na pagina de sucesso ou erro //

$_SESSION['email'] 		= $email_destin ;
$_SESSION['codigo']		= $codigo_envio ;

//<><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><<><><<><<<><><><><>//

if ($nome_destin && $email_destin && $mensagem && $cpf_cnpj) 
{
	if(enviarEmail())
	{
		// Chama o metodo do controller para salvar o email no banco de dados e retorna o id do email inserido
        $id_email = Controller::setEmail(array($codigo_envio, $cpf_cnpj, $nome_destin, $email_destin, $assunto, $texto, $_SESSION["id"]));
        // salva os anexos do email no banco 
		setAnexos($id_email);
		// redirect para a página de secesso ao enviar email
        header("location:../views/form_sucesso.php");
	}else{
		// redirect para a página de erro ao enviar email
        header("location:../views/form_error.php");
	}
}
/*
*@Descrition coleta as informações enviadas via post pelo formulario
*@Param nome do atributo do formulario que contenha a informação a ser recebida
*@Return O valor informado pelo usuario durante preenchimento do formulario
*/
//------------------------------------------------------------------------//
function getPost($valor) {
    return isset($_POST[$valor]) ? $_POST[$valor] : '';
}
//------------------------------------------------------------------------//
/*
*@Descrition função que verifica se o email é valido 
*@Param Recebe um email para validação
*@Return o email se valido ou false se for invalido
*/
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
//------------------------------------------------------------------------//
/*
*@Descrition Funação que acrescenta o texto no assunto do email a ser enviado
*@Param Recebe assunto informado pelo usuario no campo assunto do formulario
*@Return O assunto do email pronto para envio
*/
function gerarAssunto ($assunto){
    return "[IFBA EUNAPOLIS]  ".$assunto;
}
//------------------------------------------------------------------------//
/*
*@Descrition Function que envia os emails apartir dos dados coletados pelo sistema
*@Return  boolen indicando se o mail foi ou não enviado
*/
function enviarEmail() {

	global $email_remetente, $email_destin, $email_servidor, $assunto, $mensagem;

    $headers = "From: $email_servidor\r\n" .
               "Reply-To: $email_remetente\r\n" .
               "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  
  	return mail($email_destin, gerarAssunto($assunto), $mensagem, $headers);
}
//----------------------------------------------------------------------------//
/*
*@Descrition Funação que chama o metodo do controle para salvar os anexos dos emails
*@Param Recebe os id do email ao qual os anexos pertencem
*/
function setAnexos( $id_email) {

    global $documentos, $links;
    for ($i=0; $i < count($documentos); $i++){
        Controller::setAnexo(array($documentos[$i], $links[$i], $id_email));
    }
}
//----------------------------------------------------------------------------//
/*
*@Descrition Function que gerar o codigo de envio dos emails
*@Return  O código de envio do email 
*/
function gerarCodigoEnvio(){ 

	$codigo = date('Y').Controller::getMaxId()["max(id)"];
	while ( strlen($codigo) <= 13) {
		$codigo .= (rand(1,9));
	}
	return $codigo;
}
//-------------------------------------------------------------------------//
/*
*@Descrition O metodo que recebe o codigo de envio e a mensagem recebida do usuário
*            e acrescenta partes geradas pelo sistema.
*@Return  O texto da mensagem a pronta para ser enviado pelo email.
*/
function gerarMensagem($mensagem){
   
	global $codigo_envio, $documentos;
    ob_start();
	include("mensagem.php");
	$msg = ob_get_contents();
	ob_end_clean();
	return $mensagem.$msg;
}
/*
jesilva@LBV.ORG.BR
bb
ag 3344 -8
cc 205010-2
WELLING
*/

?>