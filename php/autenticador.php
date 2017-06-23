<?php

require_once '../vendor/autoload.php';
require_once '../bd/conexao.php';

$PDO = Conexao::getInstance();
$email = getPost("email");
$senha = getPost("senha");
$CLIENT_ID = "131804782068-7tjdq664uf5p2hllor3p6g7ebr9ki7q2.apps.googleusercontent.com";
$id_token = getPost("idtoken");
if ($id_token) {
	$data = file_get_contents("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=".$id_token);
	$payload = json_decode($data);

	if ($payload) {
    $userid = $payload->sub;

    echo  $userid;
    // If request specified a G Suite domain:
    //$domain = $payload['hd'];
	} else {
	  // Invalid ID token
	}
}



function getPost($valor) {
    return isset($_POST[$valor]) ? $_POST[$valor] : '';
}
// G = et $id_token via HTTPS POST.
//$client = new Google_Client(['client_id' => $CLIENT_ID]);
//$payload = $client->verifyIdToken($id_token);



$sql = $PDO->query("SELECT * FROM usuario WHERE email='".$email."'");
$usuario = $sql->fetch(PDO::FETCH_OBJ);
print_r($usuario) ;
if($usuario){
	if($usuario->senha == $senha){
		session_start(); // Inicia a sessão
		$_SESSION['email']	= $email ;
		$_SESSION['senha']	= $senha ;
		$_SESSION["id"] = $usuario->id;
		header("location:../views/form_enviar.php");
	}else{
		header("location:../index.php");
	}
}else{
	header("location:../index.php");
}





//https://www.youtube.com/watch?v=-yUMdFWrPJc

  
  
  /*


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
$mensagem   		= getMensagem(nl2br(getPost("mensagem")));

// Dados que serão utilizados na pagina de sucesso ou erro //

$_SESSION['email'] 		= $email_destin ;
$_SESSION['codigo']		= $codigo_envio ;

//<><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><<><><<><<<><><><><>//
//------------------------------------------------------------------------//

*/
