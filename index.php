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

var_dump($conn);
$sql = "SELECT * FROM `usuario`";
$query = $conn->query($sql);
$dados = $query->fetch_array();
print_r($dados);
echo 'Registros encontrados: ' . $query->num_rows;

$conn->close();
?>
