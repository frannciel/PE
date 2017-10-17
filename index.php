<?php

$dbstr = getenv('CLEARDB_DATABASE_URL');
$dbstr = substr("$dbstr", 8);
$dbstrarruser = explode(":", $dbstr);
//Please don't look at these names. Yes I know that this is a little bit trash :D
$dbstrarrhost = explode("@", $dbstrarruser[1]);
$dbstrarrrecon = explode("?", $dbstrarrhost[1]);
$dbstrarrport = explode("/", $dbstrarrrecon[0]);
$dbpassword = $dbstrarrhost[0];
$dbhost = $dbstrarrport[0];
$dbport = $dbstrarrport[0];
$dbuser = $dbstrarruser[0];
$dbname = $dbstrarrport[1];
unset($dbstrarrrecon);
unset($dbstrarrport);
unset($dbstrarruser);
unset($dbstrarrhost);
unset($dbstr);

//Uncomment this for debug reasons
echo $dbname . " - name<br>";
echo $dbhost . " - host<br>";
echo $dbport . " - port<br>";
echo $dbuser . " - user<br>";
echo $dbpassword . " - passwd<br>";

$dbanfang = 'mysql:host=' . $dbhost . ';dbname=' . $dbname;
$PDO = new PDO($dbanfang, $dbuser, $dbpassword);
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$PDO->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
var_dump($PDO);
//You can only use this with the standard port!

$sql = $PDO->query("SELECT * FROM usuario WHERE 'id' = '1'");
$user = $sql->fetch(PDO::FETCH_OBJ);
echo("Dados do usuario \n");
var_dump($user);
?>


/*
$PDO = Conexao::getInstance();
var_dump($PDO);
$sql = $PDO->query("SELECT * FROM usuario WHERE  'email' = frannciel@gmail.com'");
var_dump($sql->fetch(PDO::FETCH_OBJ));
  		  
class Conexao {
  		  
   private function __construct() {
         //
   }
 
    public static function getInstance() {
        try{
          if (!isset(self::$instance)) {
               self::$instance = new PDO('mysql:host=us-cdbr-iron-east-05.cleardb.net;dbname=heroku_a2e65a5cd7ae39b', 'b9fb1bd306346b', '12f65fd4', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
               self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
           }
           return self::$instance;
           echo "Conetado ";
       } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
         }

    }
 }
?>



echo "começo ";
$PDO = Conexao::getInstance();
$sql = $PDO->query("SELECT * FROM usuario WHERE 'email' = 'frannciel.edu@gmail.com'");
$user = $sql->fetch(PDO::FETCH_OBJ);
echo($user->nome);
print_r($user->nome);
var_dump($user);
echo "Chegou ";


$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = "us-cdbr-iron-east-05.cleardb.net";
$username = "b9fb1bd306346b";
$password = "12f65fd4";
$db = "heroku_a2e65a5cd7ae39b";

$conn = new mysqli($server, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
*/

