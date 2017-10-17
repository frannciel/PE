<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

//check connection 
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$sql = "SELECT * FROM `usuario`";
$query = $conn->query($sql);
echo 'Registros encontrados: ' . $query->num_rows;
$dados = $query->fetch_array();
print_r($dados);

echo 'Registros encontrados: ' . $query->num_rows;

$conn->close();
?>
