<?php 
	session_start();
    	
    // senão existir nada no post e por que os dados estão na sesão
    // Dois aquivos diferentes faz usudo deste código
    if (isset($_POST['id_email']))
    {
        $id_email = $_POST['id_email'];
        $id_destinatario = $_POST['id_destinatario'];
  	}

   	if (isset($_SESSION['id_email']))
    {
        $id_email = $_SESSION['id_email'];
        $id_destinatario = $_SESSION['id_destinatario'];
   	}

   	if (empty($id_email) || empty($id_destinatario)) 
    {
   		header("location:../index.php");
   	}
    require_once 'controller.php';
    // Retona do banco os dados do email e recebe o id do email da sessão ativa
    $email = Controller::getEmail(array('id', $id_email));
    //Retona do banco o destinatario para gerar o recibo e pega seu id na sessão ativa
    $destinatario = Controller::getDestinatario(array('id', $id_destinatario));
    //Retorna do banco os anexos do email
    $anexos = Controller::getAnexos(array('id_email', $id_email));
    // Salva na session o array de anexos que serão utilizados na geração do recibo
    //Utilizado também na pagina de downloads
    $_SESSION["anexos"] = $anexos;

?>
<div  style="border:2px #000 solid; width:70%; padding:5%; margin:10%; background:#effbf2">

    <center><img src="../img/brasao.png" width="100px" height="100px"></center>
    <h3>
        <center>SERVIÇO PUBLICO FEDERAL</center>
        <center>Ministerio da Educação</center>
        <center>Instituto Federal de Educação, Ciência e Tecnologia Bahia</center>
        <center>Campus Eunápolis</center>
    </h3>
    <h2 style=" margin-top: 7%; margin-bottom: 7%"><center>RECIBO ELETRONICO DE ENTREGA DE DOCUMENTOS</center></h2>
       
    <div class="row">
        <div class="col-md-10"><h3>Código de Envio: <?php echo $email->codigo_envio; ?></h3></div>
        <div class="col-md-10"><h3>Recebente:</h3></div>
        <div class="col-md-10"><b>Nome:</b>         <?php echo $destinatario->nome; ?></div>
        <div class="col-md-10"><b>Cargo/Função:</b> <?php echo $destinatario->cargo; ?></div>
        <div class="col-md-10"><b>Telefone:</b>     <?php echo $destinatario->telefone; ?></div>
        <div class="col-md-10"><b>Email:</b>        <?php echo $destinatario->email; ?></div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <p>
                O recebente, acima descrito, recebeu nesta data por meio eletrônico, em nome da pessoa física ou jurídica 
                <b><?php echo $email->nome_destinatario; ?></b> inscrita no CNPJ ou CPF sob o nº <b><?php echo $email->cpf_cnpj; ?></b>,  
                os seguintes documentos:
            </p>
        </div>
    </div>

    <div> 
        <table border="1" width="100%" class=" table table-striped">
           <thead><tr><th>DOCUMENTOS</th></tr></thead>
           <tbody>
                <tr><td><b>Clique nos documentos para baixar</b></td></tr>
                <?php foreach ($anexos as $anexo) { ?>
                   <tr><td><a href="<?php echo $anexo->link ; ?>" target="_blank"><?php echo $anexo->documento ; ?></a></td></tr>
                <?php } ?>
            </tbody>
        </table>

        <p>Eunápolis-BA, <?php echo $destinatario->data; ?></p>
    </div>

    <p>Endereço ip <?php echo $_SERVER["REMOTE_ADDR"]; ?> do dispositivo de preenchimento do formulário</p>
</div>