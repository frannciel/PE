﻿<?php

echo "começo ";
$PDO = Conexao::getInstance();
$sql = $PDO->query("SELECT * FROM usuario WHERE 'email' = 'frannciel@gmail.com'");
print_r($sql->fetch(PDO::FETCH_OBJ));
echo "Chegou ";

class Conexao {

    public static $instance;

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
            echo "Conetado ";
            return self::$instance;

        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

    }
}
?>
