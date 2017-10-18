<?php 
   // inicia a sessão e verifica se existe uma sessão ativa para o usuario atual
   // caso não haja sessão indica que o usuario não está logado e o redireciona a tela de login
   // tha82274629 
   session_start();
   if (!isset($_SESSION["email"]) || !isset($_SESSION["senha"])) {
      header("location:../index.php");
   }
   
   require_once '../php/controller.php';

   // retorna do banco de todos os emails ennviados pelo usuário ativo na sessão
   // recebe o id do usuario através da sessão ativa
   //$emails = Controller::getEmails(array('id_usuario', $_SESSION["id"]));
   $emails = '';
   $usuario = Controller::getUsuario(array('id', $_SESSION['id']));
   if (!empty($_POST)) {

      $campo = $_POST['campo'];
      $termo = trim($_POST['termo']);

      if ($termo == ""){

         $emails = Controller::getEmails(array('id_usuario', $_SESSION['id']));  

      } else{

         $emails = Controller::getEmailsAjax(array($campo, "%".$termo."%", "id_usuario", $_SESSION['id']));
      }

   }else{

      $emails = Controller::getEmails(array('id_usuario', $_SESSION['id']));
   }
   
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
   <title>Home 2.0</title>
   <meta charset="utf-8">
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" type="text/css" href="../css/styles.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  

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
   #acima::before{
      position: absolute;
      z-index: -1;
      background-color: #009688;
      width: 100%;
      height: 200px;
      content: '';
      top: 0;
      left: 0;
   }
   </style>
</head>
<body class="corpo">
	<!--  BARRA SUPERIOR -->
   <div class="nav barra">
      <div class="container-fluid">
         <div class="row barra-padding">
            <div class="col-md-1" id="padding-zero">
               <div><a href="https://portal.ifba.edu.br/eunapolis"><img src="../img/logo-clara.png" width="60" height="70" align="right"  ></a></div>
            </div>
            <div class="col-md-7" >
               <div class="barra-titulo">Instituto Federal da Bahia</div>
               <div class="barra-sub-titu">Campus Eunápolis</div>
            </div>
            <div class="col-md-3" style="text-align: right; padding-top: 40px;">
              <b><?php echo $usuario->nome; ?></b>
            </div>
            <div class="col-md-1" style="padding-top:25px">
              <div class="dropdown">
					  	<button class="btn dropdown-toggle"  id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					   	<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="false"></span>
					  	</button>
					  	<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu3">
							<li><a href="#">Meus dados</a></li>
						   <li><a href="../views/nova_senha.php">Trocar senha</a></li>
						   <?php if ($usuario->perfil == 1){ ?> 
						   	<li><a href="../views/usuario/novo.php">Novo usuario</a></li>
						   <?php } ?>
						   <li><a href="../php/sair.php">Sair</a></li>
						</ul>
					</div>
            </div>
         </div><!--row-->
         <div class="row barra-inferior">
            <div class="col-md-11">Remessa Eletrônica de Documentos Institucionais</div>
         </div>
      </div><!--container-->
   </div><!--nav bar-->

   <div class="container" >
		
		<div class="content col-lg-10 col-md-offset-1">
         
         <div class="panel" style="box-shadow: 0 1px 1px 0 rgba(0,0,0,0.06), 0 2px 5px 0 rgba(0,0,0,0.2); margin-top: 5%">
            <div class="panel-body">
               <div class="well well-lg">
                  <div class="row"><!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                  	<!-- PESQUISSAR MENSAGEM-->
                     <div class="col-md-10">
                        <form class="form-inline" method="POST" action="home.php">
                           <fieldset>
                               <div class="form-group">
                                    <label for="campo" class="control-label">Buscar </label>
                                    <select class="form-control" id="campo" name="campo" >
                                       <option value="nome_destinatario">Destinatário</option>
                                       <option value="assunto">Assunto</option>
                                       <option value="codigo_envio">Código Envio</option>
                                       <option value="email_destinatario">Email</option>
                                    </select>
                                    <input type="text" class="form-control" name="termo" id="buscar">
                                    <input type="submit" class="form-control" name="Enviar">
                               </div>
                           </fieldset>
                        </form>
                     </div>
                     <!--BUTÃO NOVA MENSAGEM-->
                     <div class="col-md-2">
                        <a class="btn " href="form_enviar.php" style="background: #19882c; color: #fff"> 
                           <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true">
                           <span>Nova </span>
                        </a>
                     </div>   
                  </div><!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
               </div><!--well pesquisa-->



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
                           // retorna todos os anexos do email atual 
                           $anexos = Controller::getAnexos(array('id_email', $email->id));
                           // retorna todos os possiveis destinatarios recebedores dos anexos
                           $destinatarios = Controller::getDestinatarios(array('id_email', $email->id));
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
                                                <?php foreach ($anexos as $anexo) { ?>
                                                   [ <a href="<?php echo $anexo->link; ?>" target="_blank"><?php echo $anexo->documento; ?></a> ]  
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

                                             <div class="col-md-12" style="margin-bottom: 1%">
                                                <b>Recebido por:</b>
                                             </div>

                                             <?php foreach ($destinatarios as $destinatario) { ?>
                                                <div class="col-md-9">
                                                      <?php echo $destinatario->nome." - ".$destinatario->cargo; ?>
                                                </div>
                                                <!--  Presciso passar os ids do destinatario e do email através da session ativa para cada destinatario-->
                                                <div class="col-md-3" style="margin-bottom: 1%">
                                                   <a class="btn btn-success btn-xs" onclick="mySession(<?php echo $email->id.','.$destinatario->id;?>)"> Visualizar Recibo </a>
                                                   <!-- <a class="btn btn-success btn-xs" href="../php/create_recibo.php?e=<?php //echo $email->id;?>&d=<?php //echo $destinatario->id;?>" target="blank" onclick="mySession()"> Visualizar Recibo </a> --> 
                                                </div>
                                             <?php  } ?>
                                          <?php } else {?>
                                             <center><i> Aguardando Recebimento</i> </center> 
                                          <?php }  ?>
                                          </div><!-- row -->                                 
                                       </div><!--painel footer -->
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
               </div><!-- well -->
               <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            </div> <!-- painel-body externo -->
         </div><!-- painel externo -->
		</div><!-- content -->
	</div><!-- conatiner-->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
<script>
 $('[data-toggle="popover"]').popover();

function mySession(email, destinatario){
   $.ajax({
      method:'post',
      url: '../php/create_recibo.php',
      data: {
         id_email: email,
         id_destinatario: destinatario
      },
      success: function(data) {
         pagina = window.open(" ", '_blank') ;
         pagina.document.open();
         pagina.document.write(data);
         pagina.document.close();
         //console.log(data);
      }
   });
}

$('#').keyup(function (){ 
   var  termo = $(this).val();
   var  campo = $('#campo').val();
   $.ajax({
      method:'post',
      url: 'home.php',
      data: {
         termo: termo,
         campo: campo
      },
      success: function(data) {
         console.log(data);
      }
   });
});  
</script>
</html>
