<?php
require_once 'bd/conexao.php';


$conn = Conexao::getInstance();
$sql = $conn->query("SELECT * FROM usuario");
$dados = $sql->fetch(PDO::FETCH_OBJ);
print_r($dados);

require_once 'php/controller.php';
echo " passou 05";
$usuario = Controller::getUsuario(array(id, '1'));
echo " passou 06";
print_r($usuario);
echo " passou 07";
?>
