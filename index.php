<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

$sql = "SELECT * FROM `usuario`";
$query = $conn->query($sql);
var_dump($query);
echo 'Registros encontrados: ' . $query->num_rows;

?>
