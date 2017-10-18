<?php


include 'PE/bd/conexao.php';

class Controller {

    public static $PDO;

    private function __construct() {
        //
    }
    
    public static function geTest(){
         return "Chegou aki";
    }
        
    /*
    *@Description Metodo que cria o registro de um novo destinatario no banco de dados
    *@Param Um array contendo os dados do novo destinatario ser salvo no banco
    *@Return Um inteiro indicando o numero de id do ultimo anexo salvo no banco
    */
    public static function setDestinatario($Destinatario) {

        try {

            $sql = "INSERT INTO destinatario (nome, cargo, telefone, email, data, id_email) 
            VALUES (:nome, :cargo, :telefone, :email, :data, :id_email)";

            $PDO = Conexao::getInstance();
            $conn = $PDO->prepare($sql);
            $conn->bindValue(":nome",       $Destinatario[0]); // Nome do destinatário
            $conn->bindValue(":cargo",      $Destinatario[1]); // Cargo ou função do destinatário
            $conn->bindValue(":telefone",   $Destinatario[2]); // telefone do destinatário
            $conn->bindValue(":email",      $Destinatario[3]); // email do destinatario
            $conn->bindValue(":data",       date("Y/m/d H:i:s")); // Data do preenchimento do formulario de recebimento dos anexos
            $conn->bindValue(":id_email",   $Destinatario[4]); // id do email ao qual recebe os anexos
            $conn->execute();
            return $PDO->lastInsertId();
            
        } catch (Exception $e) {
            print("<center>Ocorreu ao tentar salvar, favor entrar em contato com o Administrador no Telefone (73)3281-2266</center>");
            print($e->getMessage());
        }
    }
    /*
    *@Description Metodo que consulta os destinatrios de acordo com um parametro informado
    *@Param Um array contendo como chave o atributo da tabela do banco e valor é o parametro da consulta
    *@Return Um array de objetos do tipo destinatario 
    */
    public static function getDestinatarios($request) {

        $PDO = Conexao::getInstance();
        $sql = $PDO->query("SELECT * FROM destinatario WHERE ".$request[0]." = '".$request[1]."'");
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    /*
    *@Description Metodo que consulta o destinatrio de acordo com um parametro informado
    *@Param Um array contendo como chave o atributo da tabela do banco e valor é o parametro da consulta
    *@Return Um a objetos do tipo destinatario 
    */
    public static function getDestinatario($request) {

        $PDO = Conexao::getInstance();
        $sql = $PDO->query("SELECT id, nome, cargo, telefone, email, date_format(data,'%d/%m/%Y %H:%m') AS data
        FROM destinatario WHERE ".$request[0]." = '".$request[1]."'");
        return $sql->fetch(PDO::FETCH_OBJ);
    }
    /*
    *@Description Metodo que cria o registro de anexo no banco de dados
    *@Param Um array contendo os dados do anexo  ser salvo no banco
    *@Return Um inteiro indicando o numero de id do ultimo anexo salvo no banco
    */
    public static function setAnexo($anexo) {

        try {

            $sql = "INSERT INTO anexo (documento, link, id_email)  VALUES (:documento, :link, :id_email)";

            $PDO = Conexao::getInstance();
            $conn = $PDO->prepare($sql);
            $conn->bindValue(":documento",  $anexo[0]);
            $conn->bindValue(":link",       $anexo[1]);
            $conn->bindValue(":id_email",   $anexo[2]);
            $conn->execute();
            return $PDO->lastInsertId();
            
        } catch (Exception $e) {
            print("Ocorreu um erro ao tentar salvar o anexo, tente novamnete ou contate o Administrador");
            print($e->getMessage());
        }
    }
    /*
    *@Description Metodo que consulta os anexos de acordo com um parametro
    *@Param Um array contendo como chave o atributo da tabela do banco e valor é o parametro da consulta
    *@Return Um array de objetos do tipo anexos 
    */
    public static function getAnexos($request) {

        $PDO = Conexao::getInstance();
        $sql = $PDO->query("SELECT * FROM anexo WHERE ".$request[0]." = '".$request[1]."'");
        return $sql->fetchAll(PDO::FETCH_OBJ);
        //$anexos;
    }
    /*
    *@Description Metodo que cria o registro de usuario no banco de dados
    *@Param Um array contendo os dados do usuário  ser salvo no banco
    *@Return Um inteiro indicando o numero de id do novo usuario no banco
    */
    public static function setUsuario($usuario) {

        try {

            $sql = "INSERT INTO usuario (nome, sobrenome, email, cpf, data_nascimento, perfil, telefone, sexo, senha) 
            VALUES (:nome, :sobrenome, :email, :cpf, :data_nascimento, :perfil, :telefone, :sexo, :senha )";

            $PDO = Conexao::getInstance();
            $conn = $PDO->prepare($sql);
            $conn->bindValue(":nome",           $usuario[0]);
            $conn->bindValue(":sobrenome",      $usuario[1]); 
            $conn->bindValue(":email",          $usuario[2]); 
            $conn->bindValue(":cpf",            $usuario[3]); 
            $conn->bindValue(":data_nascimento",$usuario[4]); 
            $conn->bindValue(":perfil",         $usuario[5]); 
            $conn->bindValue(":telefone",       $usuario[6]); 
            $conn->bindValue(":sexo",           $usuario[7]);
            $conn->bindValue(":senha",          $usuario[8]); 
            $conn->execute();
            return $PDO->lastInsertId();
            
        } catch (Exception $e) {
            print("Ocorreu ao tentar salvar um email, tente novamnete ou contate o Administrador");
            print($e->getMessage());
        }

    }
    /*
    *@Description Metodo que consulta os dados de um usuario de acordo com um parametro
    *@Param Um array contendo na chave o atributo da tabela do banco e valor é o parametro da consulta
    *@Return Um objeto do tipo usuário
    */
    public static function getUsuario($request) {
        echo "passou 01";
        $PDO = Conexao::getInstance();
        echo "passou 02";
        $sql = $PDO->query("SELECT * FROM usuario WHERE ".$request[0]." = '".$request[1]."'");
        return $sql->fetch(PDO::FETCH_OBJ);
    }
     /*
    *@Description Metodo que consulta os dados de um usuario de acordo com um parametro
    *@Param Um array contendo na chave o atributo da tabela do banco e valor é o parametro da consulta
    *@Return Um objeto do tipo usuário
    */
    public static function getUsuarioExiste($request) {

        $PDO = Conexao::getInstance();
        $sql = $PDO->query("SELECT 0 FROM usuario WHERE ".$request[0]." = '".$request[1]."'");
        return $sql->fetch(PDO::FETCH_OBJ);
    }
    /*
    *@Description Metodo que insere um registro de email no banco de dados
    *@Param Um array contendo os dados do email a ser salvo no banco
    *@Return Um inteiro indicando o numero de id do ultimo email salvo no banco
    */
    public static function setEmail($email) {

        try {

            $sql = "INSERT INTO email (codigo_envio, cpf_cnpj, nome_destinatario, email_destinatario, assunto, mensagem, id_usuario) 
            VALUES (:codigo_envio, :cpf_cnpj, :nome_destinatario, :email_destinatario, :assunto, :mensagem, :id_usuario)";

            $PDO = Conexao::getInstance();
            $conn = $PDO->prepare($sql);
            $conn->bindValue(":codigo_envio", $email[0]);  // codigo envio
            $conn->bindValue(":cpf_cnpj", $email[1]); // cpf ou cnpj
            $conn->bindValue(":nome_destinatario", $email[2]); // nome do destinatario
            $conn->bindValue(":email_destinatario", $email[3]); // email do destinatario
            $conn->bindValue(":assunto", $email[4]); // assunto
            $conn->bindValue(":mensagem",  $email[5]); // texto conteúdo da mensagem
            $conn->bindValue(":id_usuario",  $email[6]); // id do usuario que envio o email
            $conn->execute();
            return $PDO->lastInsertId();
            
        } catch (Exception $e) {
            print("Ocorreu ao tentar salvar um email, tente novamnete ou contate o Administrador");
            print($e->getMessage());
        }
    }
    /*
    *@Description Metodo de consulta realizado pela função ajax da tela home
    *@Param  recebe um array contendo como chave o atributo da tabela do banco e valor é o parametro da consulta
    *@Return retorn um array de objetos emails 
    */
    public static function getEmailsAjax($request) {

        $PDO = Conexao::getInstance();
        $sql = $PDO->query("SELECT id, codigo_envio, cpf_cnpj, nome_destinatario, email_destinatario, assunto,  mensagem, date_format(data, '%d/%m/%Y %h:%m') AS data 
        FROM email WHERE ".$request[0]." LIKE '".$request[1]."' AND ".$request[2]." = '".$request[3]."'");
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    /*
    *@Description Metodo que consulta os emails de acordo com um parametro
    *@Param  recebe um array contendo como chave o atributo da tabela do banco e valor é o parametro da consulta
    *@Return retorn um array de objetos emails 
    */
    public static function getEmails($request) {

        $PDO = Conexao::getInstance();
        $sql = $PDO->query("SELECT id, codigo_envio, cpf_cnpj, nome_destinatario, email_destinatario, assunto,  mensagem, date_format(data, '%d/%m/%Y %h:%m') AS data 
        FROM email WHERE ".$request[0]." LIKE '".$request[1]."'");
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
     /* 
    *@Descrition Metodo que consulta e retirna o email de acordo com o parametro de retorno único
    *@Param  recebe um array contendo como chave o atributo da tabela do banco e valor é o parametro da consulta
    *@Return retorn um objeto do tipo email 
    */
    public static function getEmail($request) {

        $PDO = Conexao::getInstance();
        $sql = $PDO->query("SELECT id, codigo_envio, cpf_cnpj, nome_destinatario, email_destinatario, assunto,  mensagem, date_format(data, '%d/%m/%Y %h:%m') AS data 
        FROM email WHERE ".$request[0]." = '".$request[1]."'");
        return $sql->fetch(PDO::FETCH_OBJ);
   }
    /*
    *@Description Metodo que retorna o maior id da tabela email utilizado para gerar o código de envio
    *@Return um array contendo o maior id da tabela email
    */
   public static function getMaxId(){

        return Conexao::getInstance()->query("SELECT max(id) from email")->fetch(PDO::FETCH_ASSOC);
   }

   public static function updateSenha($request){
        
      $PDO = Conexao::getInstance();
      try {
         $PDO = Conexao::getInstance();
         $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
         $stmt = $PDO->prepare('UPDATE usuario SET senha = :senha WHERE id = :id');
         $stmt->execute(array(':id'=> $request[0], ':senha' => $request[1]));
         echo $stmt->rowCount(); 
      } catch(PDOException $e) {
         echo 'Error: ' . $e->getMessage();
      }
   }
}
?>
