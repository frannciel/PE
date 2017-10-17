<?php
require_once 'bd/conexao.php';

$conn = Conexao::getInstance();

var_dump($conn);
$sql = $conn->query("SELECT * FROM usuario");
$dados = $sql->fetch(PDO::FETCH_OBJ);
print_r($dados);

?>
