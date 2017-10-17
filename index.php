<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);


echo 'Conectado com sucesso';
mysql_close($link);
echo $db . " - name<br>";
$conn = new mysqli_connect($server, $username, $password, $db);
if (!$conn) {
    echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
$sql = "SELECT * FROM usuario";
$query = $conn->query($sql);
echo 'Registros encontrados: ' . $query->num_rows;
echo $db . " - name<br>";
echo $server . " - host<br>";
echo $username . " - user<br>";
echo $password . " - passsword<br>";
?>

