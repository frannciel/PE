<?php

class Conexao {

    public static $instance;

    private function __construct() {
        //
    }

    public static function getInstance() {
        try{
            if (!isset(self::$instance)) {
                
                $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
                $server = $url["host"];
                $username = $url["user"];
                $password = $url["pass"];
                $db = substr($url["path"], 1);
                
                self::$instance = new PDO('mysql:host=' .$server.';dbname='.$db, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
            }
            return self::$instance;
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

    }
}
?>

