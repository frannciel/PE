<?php
require_once 'bd/conexao.php';
require_once 'php/controller.php';

$conn = Conexao::getInstance();
$sql = $conn->query("SELECT * FROM usuario");
$dados = $sql->fetch(PDO::FETCH_OBJ);
print_r($dados);

$usuario = Controller::getUsuario(array(id, '1'));
print_r($usuario);

?>
