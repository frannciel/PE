<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new PDO('mysql:host=' .$server.';dbname='.$db, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING)   
echo 'Conectado </br>';

$sql = $conn->query("SELECT * FROM usuario");
$dados = $sql->fetch(PDO::FETCH_OBJ);
print_r($dados);

//$sql = "SELECT * FROM `usuario`";
?>
