<?php

include 'php/controller.php';
$usuario = Controller::geTest();
echo ($usuario);

//require_once 'bd/conexao.php';
//$conn = Conexao::getInstance();
//$sql = $conn->query("SELECT * FROM usuario");
//$dados = $sql->fetch(PDO::FETCH_OBJ);
//print_r($dados);


$usuario = Controller::getUsuario(array(id, '1'));
echo " passou 06";
print_r($usuario);

?>
