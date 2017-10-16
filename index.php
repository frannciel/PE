<?php
/*
echo "começo ";
$PDO = Conexao::getInstance();
$sql = $PDO->query("SELECT * FROM usuario WHERE 'email' = 'frannciel.edu@gmail.com'");
$user = $sql->fetch(PDO::FETCH_OBJ);
echo($user->nome);
print_r($user->nome);
var_dump($user);
echo "Chegou ";
*/

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["us-cdbr-iron-east-05.cleardb.net"];
$username = $url["b9fb1bd306346b"];
$password = $url["12f65fd4"];
$db = substr($url["heroku_a2e65a5cd7ae39b"], 1);

$conn = new mysqli($server, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

?>
