<?php
session_start(); // Inicia a sessão
require_once 'controller.php';

$senhaAtual 	= isset($_POST["senhaAtual"]) ? $_POST["senhaAtual"] : '';
$senhaNova 		= isset($_POST["senhaNova"]) ? $_POST["senhaNova"] : '';
$senhaConfirma 	= isset($_POST["senhaConfirma"]) ? $_POST["senhaConfirma"] : '';

// Busca o usuário no banco de dados usando como paremtro o email coletado na tela de login

if(!empty($senhaNova) AND !empty($senhaConfirma) AND !empty($senhaAtual)){
	if($senhaNova == $senhaConfirma){
		$usuario = Controller::getUsuario(array('id', $_SESSION['id']));
		if(password_verify($senhaAtual, $usuario->senha)){
			Controller::updateSenha(array($_SESSION['id'], password_hash($senhaNova , PASSWORD_DEFAULT)));
			echo "Senha alterada com sucesso! ";
			header("location:../views/home.php");
		}else{
			header("location:../index.php");
			echo "Senha atual incorreta ";
		}
	}else{
		header("location:../index.php");
		echo "A senha nova e a confirmação não são iguais ";
	}
}
?>