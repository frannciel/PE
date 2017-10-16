<?php

$PDO = Conexao::getInstance();
var_dump($PDO);
$sql = $PDO->query("SELECT * FROM usuario WHERE  'email' = frannciel@gmail.com'");
var_dump($sql->fetch(PDO::FETCH_OBJ));
  		  
$usuario = Controller::getUsuario(array('email', 'frannciel@gmail.com'));		 

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



















/*
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
?>
