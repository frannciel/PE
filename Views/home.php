<?php 
   require_once '../bd/conexao.php';
   // recebe uma conexão de banco de dados
   $PDO = Conexao::getInstance();

   // inicia a sessão e verifica se existe uma sessão ativa para o usuario atual
   // caso não haja sessão indica que o usuario não está logado e o redireciona a tela de login
   session_start();
   if (!isset($_SESSION["email"]) || !isset($_SESSION["senha"])) {
      header("location:../index.php");
   }

   // retorna do banco de todos os emails ennviados pelo usuário ativo na sessão
   //  recebe o id do usuario através da sessão ativa
   $sql = $PDO->query("SELECT * FROM email WHERE id_usuario = '".$_SESSION["id"]."'");
   $emails = $sql->fetchAll(PDO::FETCH_OBJ);

   /*
   *@Description Metodo que retorna do banco os anexos do emaial
   *@Atributo id_emal 
   *@retun array de objeto Anexos
   */
   function getAnexos($id_email){

      global $PDO;
      $sql = $PDO->query("SELECT * FROM anexo WHERE id_email = '".$id_email."'");
      $anexos = $sql->fetchAll(PDO::FETCH_OBJ);
      return $anexos;
   }

   /*
   *@Description Metodo que retorna do banco de dados os destinatários do email
   *@Atributo id_emal 
   *@retun array de objeto Destinatário
   */
   function getDetinatarios($id_email){

      global $PDO;
      $sql = $PDO->query("SELECT * FROM destinatario WHERE id_email = '".$id_email."'");
      $destinatarios = $sql->fetchAll(PDO::FETCH_OBJ);
       return $destinatarios;
   }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Sendark 2.0</title>
    <meta charset="utf-8">
   <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<style type="text/css">
   
.celula{
   white-space: nowrap;  
   overflow: hidden; 
   text-overflow: ellipsis; 
   width: 35%;
   padding-right: 5px;
}
.td-icon{
   width: 5%; 
}
.td-date{
   width: 25%; 
}  
.tabela{
   table-layout: fixed;
   width: 100%;
}
.centro{
   text-align: center;
   align-content: center;
}

</style>
</head>
<body>
	<div class="container">
		<div class="content col-lg-8 col-md-offset-2">
         <div class="panel panel-success">
             
            <div class="panel-heading">
               <div class="row titulo">
                  <h2>Protocolo Eletrônico</h2>
                  
               </div>
            </div>

            <div class="panel-body">
               <div class="well well-lg">
                  <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                  <div class="row">
                     <div class="col-md-9">
                        <form class="form-inline">
                           <fieldset>
                               <div class="form-group">
                                    <label for="campo" class="control-label">Buscar </label>
                                    <select class="form-control" id="campo" name="campo" >
                                       <option value="destina">Destinatário</option>
                                       <option value="assunto">Assunto</option>
                                       <option value="assunto">Código Envio</option>
                                       <option value="assunto">Email</option>
                                    </select>
                                    <input type="text" class="form-control" name="termo" id="buscarQuest">
                               </div>
                           </fieldset>
                        </form>
                     </div>
                     <div class="col-md-2">
                        <a class="btn btn-info" href="form_enviar.php"> 
                           <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true">
                           <span>Nova </span>
                        </a>
                     </div>   
                  </div>
                  <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
               </div>
               
               <div class="well well-lg">
                  <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                  
                  <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                  <table class="tabela table table-striped">
                     <thead>
                        <tr>
                           <td>
                               <table class="tabela">
                                 <tr>
                                    <th class="celula">Destinatário</th>
                                    <th class="celula">Assunto</th>
                                    <th class="td-date">Data</th>
                                    <th class="td-icon centro">Status</th>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </thead>
                     <tbody>
                     <?php if ($emails) { ?>
                        <?php foreach($emails as  $email) { 
                           $anexos = getAnexos($email->id);
                           $destinatarios = getDetinatarios($email->id);
                        ?>
                           <tr>
                              <td>
                                 <table class="tabela" style="margin-bottom: 5px">
                                    <tr data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $email->id; ?>" aria-expanded="false" aria-controls="collapseOne">
                                       <td class="celula"><?php echo $email->nome_destinatario; ?></td>
                                       <td class="celula"><?php echo $email->assunto; ?></td>
                                       <td class="td-date"><?php echo $email->data; ?></td>
                                       <td class="td-icon centro">
                                          <?php if ( $destinatarios) { ?>
                                             <button type="button" class="btn btn-default btn-xs" title="Recebido com sucesso">
                                                <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#3ADF00"></span>
                                             </button>
                                          <?php } else { ?>
                                             <button type="button" class="btn btn-default btn-xs" title="Aguardando Recebimento">
                                                <span class="glyphicon glyphicon-send" aria-hidden="true" style="color:#3ADF00"></span>
                                             </button>
                                          <?php } ?>
                                       </td>
                                    </tr>
                                 </table> 

                                 <div id="collapse<?php echo $email->id; ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel">                                             
                                       <div class="panel-heading" style="background-color: #fcf8e3;">
                                          <div class="row">
                                             <div class="col-md-8">
                                                <b>De:</b><?php echo $email->email_destinatario; ?>
                                             </div>

                                             <div class="col-md-4">
                                                <?php echo $email->data; ?>
                                             </div>

                                             <div class="col-md-12">
                                                <b>Para:</b> <?php echo $email->nome_destinatario; ?> &#60<?php echo $email->email_destinatario; ?>&#62 
                                             </div> 

                                              <div class="col-md-12">
                                                 <b>Codigo Envio: <?php echo $email->codigo_envio; ?></b> 
                                             </div>  

                                              <div class="col-md-12">
                                                <b>Anexos:</b>
                                                <?php foreach (getAnexos($email->id) as $anexo) { ?>
                                                   [ <a href="<?php echo $anexo->link; ?>"><?php echo $anexo->documento; ?></a> ]  
                                                <?php } ?>
                                             </div>  
                                               
                                             <div class="col-md-12">
                                                <b>Assunto:</b> <?php echo $email->assunto; ?>
                                             </div>
                                          </div>
                                       </div>

                                       <div class="panel-body">
                                          <?php echo $email->mensagem; ?>
                                       </div>

                                       <div class="panel-footer" style="background-color: #fcf8e3;">
                                          
                                          <div class="row">
                                          <?php if ($destinatarios) { ?>                                    
                                             <?php foreach ($destinatarios as $destinatario) { ?>
                                                <div class="col-md-12" style="margin-bottom: 1%">
                                                   <b>Recebido por:</b>
                                                </div>

                                                <div class="col-md-9">
                                                      <?php echo $destinatario->nome." - ".$destinatario->cargo; ?>
                                                </div>

                                                <div class="col-md-3" style="margin-bottom: 1%">
                                                   <button type="button" class="btn btn-success btn-xs">Visualizar Recibo </button>
                                                </div>
                                             <?php  } ?>
                                          <?php } else {?>
                                             <center><i> Aguardando Recebimento</i> </center> 
                                          <?php }  ?>
                                          </div>                                 
                                       </div> <!--painel footer -->
                                    </div><!--painel -->
                                 </div><!-- collapse -->
                              </td>
                           </tr>
                        <?php } ?>
                     <?php } else {?>
                        <tr><td><center><i> Nenhum email enviado </i></center></td></tr>
                     <?php }  ?>
                     </tbody>
                  </table>                   
               </div>
               <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            </div>
         </div>
		</div>
	</div>
</body>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
<script>
   $(function(){
	    // Aciona a validação ao sair do input
	    $('#cpf_cnpj').blur(function(){
	        // O CPF ou CNPJ
	        var cpf_cnpj = $(this).val();
	        if(cpf_cnpj.length > 0)
	        {
		        // Testa a validação
		        if ( valida_cpf_cnpj(cpf_cnpj )) 
		        {
		            $(this).val(formata_cpf_cnpj(cpf_cnpj));
		        } else {
		            alert('CPF ou CNPJ inválido!');
		        }
	   		 }
	    });
	    $('#fone').blur(function(){
	    	
	    	var dados = $(this).val();
	    	if(dados.length > 0)
	        {
	        	var fone = formatar_fone(dados)
		    	if (fone === false) {
		    		 alert('Telefone invalido');
		    	}else{
		    		$(this).val(fone);
		    	}
	     	}
	    });
	}); 
</script>
</html>