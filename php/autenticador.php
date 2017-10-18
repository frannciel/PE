<?php
echo "passou 1";
session_start(); // Inicia a sessão
echo "passou 2";
include 'controller.php';
echo "passou 3";

$email = isset($_POST["email"]) ? $_POST["email"] : '';
$senha = isset($_POST["senha"]) ? $_POST["senha"] : '';
echo "passou 4";
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
echo "passou 5";
// Busca o usuário no banco de dados usando como parametro o email coletado na tela de login
if($email != 1){
	$usuario = Controller::getUsuario(array('email', str_replace('\'','',str_replace('"','',$email ))));

	if(!empty($senha)){
		if(password_verify($senha, $usuario->senha)){
			$_SESSION['email']	= $email ;
			$_SESSION['senha']	= $senha ;
			$_SESSION['id'] = $usuario->id;
			header("location:../views/home.php");
		}else{
			$_SESSION['error']	= true;
			$_SESSION['email']	= $email;
			header("location:../index.php");
		}
	}else{
		$_SESSION['error']	= true;
		$_SESSION['email']	= $email ;
		header("location:../index.php");
	}
}else{
	$_SESSION['error']	= true;
	$_SESSION['email']	= $email ;
	header("location:../index.php");
}
