<?php
session_start(); // Inicia a sessão
require_once 'controller.php';

$email = isset($_POST["email"]) ? $_POST["email"] : '';
$senha = isset($_POST["senha"]) ? $_POST["senha"] : '';
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
// Busca o usuário no banco de dados usando como parametro o email coletado na tela de login
if($email != 1){
	echo "passou 4";
	echo ($senha);
	echo ($email);
	$emails =  str_replace('\'','',str_replace('"','',$email ));
	echo ($emails);
	$usuario = Controller::getUsuario(array('email', $emails));
	echo "passou 6";
	if(!empty($senha)){
		echo "passou 7";
		if(password_verify($senha, $usuario->senha)){
			echo "passou 8";
			$_SESSION['email']	= $email ;
			$_SESSION['senha']	= $senha ;
			$_SESSION['id'] = $usuario->id;
			//header("location:../views/home.php");
		}else{
			$_SESSION['error']	= true;
			$_SESSION['email']	= $email;
			//header("location:../index.php");
		}
	}else{
		$_SESSION['error']	= true;
		$_SESSION['email']	= $email ;
		//header("location:../index.php");
	}
}else{
	echo "passou 9";
	$_SESSION['error']	= true;
	$_SESSION['email']	= $email ;
	//header("location:../index.php");
}
