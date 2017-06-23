<?php


session_start(); // Inicia a sessão
require_once "../bd/conexao.php";

$PDO = Conexao::getInstance();
$email_remetente 	= "pyngolee@gmail.com";
$email_servidor 	= "pyngolee@gmail.com";

//<><><><><><><><><> Informações recebidas do formulário via POST  <><><><><><>><><><>//
$codigo_envio  = preg_replace("/[^0-9\s]/", "", getPost("codigo"));
$cpf_cnpj      = preg_replace("/[^0-9\s]/", "", getPost("cpf_cnpj"));
$telefone		= preg_replace("/[^0-9\s]/", "", getPost("telefone"));
$nome 			= getPost("nome");
$cargo			= getPost("cargo");
$email_destin	= email_validar(getPost("email"));
//<><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><><<><><<><<<><><><><>//

$_SESSION['codigo']		= $codigo_envio ;
$_SESSION['cpf_cnpj']	= $cpf_cnpj ;
$_SESSION['nome'] 		= $nome ;
$_SESSION['cargo'] 		= $cargo ;
$_SESSION['telefone']	= $telefone ;
$_SESSION['email'] 		= $email_destin ;

$result = db_select_email($codigo_envio);

if($codigo_envio == $result->codigo_envio && $cpf_cnpj == $result->cpf_cnpj && $email_destin){
	
	db_insert_usuario($result->id);
	$recibo = getRecibo($result);
	email_enviar(getAssunto($result->codigo_envio), $recibo);
	echo $recibo;
	//b_select_anexo($result->id);
	//http_redirect("download.php");
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
    Metodo que registra no banco os dados do usuário que recebeu os documentos
    Este metodo recebo o id do email que contem os anexos 
*/
function db_insert_usuario($id_email) {

	global $PDO, $nome, $cargo, $telefone, $email_destin;
	$data = date('d/m/Y');

	try 
	{
		$sql = "INSERT INTO destinatario (nome, cargo, telefone, email, data, id_email) 
		VALUES (:nome, :cargo, :telefone, :email, :data, :id_email)";

		$conn = $PDO->prepare($sql);
		$conn->bindValue(":nome", 		$nome);
		$conn->bindValue(":cargo", 		$cargo);
		$conn->bindValue(":telefone",	$telefone);
		$conn->bindValue(":email",		$email_destin);
		$conn->bindValue(":data", 		$data);
		$conn->bindValue(":id_email", 	$id_email);
		$conn->execute();
        
	} catch (Exception $e) {
		print("Ocorreu ao tentar salvar usuario tente novamnete ou contate o Administrador");
		print($e->getMessage());
	}
}


function db_select_email($codigo_envio){

	global $PDO;
	$sql = $PDO->query("SELECT * FROM email WHERE codigo_envio = ".$codigo_envio);
	$result = $sql->fetch(PDO::FETCH_OBJ);
 	return $result;

/* segunda forma
$result = $select->fetchAll(PDO::FETCH_ASSOC);
print_r($result);
 
//terceira forma
$result = $select->fetch(PDO::FETCH_OBJ);
echo $result->titulo;
echo $result->descricao;
*/
}
function getRecibo($result_email){

	global $PDO, $nome, $cargo, $telefone, $email_destin;

	$result_anexo = db_select_anexo($result_email->id);
	//$ipEndress = getenv("REMOTE_ADDR");
	$ipEndress = $_SERVER["REMOTE_ADDR"];

	ob_start();
	include("recibo.php");
	$recibo = ob_get_contents();
	ob_end_clean();
	return $recibo;
}

function db_select_anexo($id_email){

	global $PDO;
	$sql = $PDO->query("SELECT * FROM anexo WHERE id_email = ".$id_email);
 	return $sql->fetchAll(PDO::FETCH_OBJ);
}

?>