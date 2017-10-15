<?php 
   // inicia a sessão e verifica se existe uma sessão ativa para o usuario atual
   // caso não haja sessão indica que o usuario não está logado e o redireciona a tela de login
   // tha82274629 
   /*
   session_start();
   if (!isset($_SESSION["email"]) || !isset($_SESSION["senha"])) {
      header("location:../index.php");
   }
   require_once '../php/controller.php';
   */
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
   <title>Home 2.0</title>
   <meta charset="utf-8">
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" type="text/css" href="/protocolo/css/styles.css">
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
               <div><a href="https://portal.ifba.edu.br/eunapolis"><img src="/protocolo/img/logo-clara.png" width="60" height="70" align="right"  ></a></div>
            </div>
            <div class="col-md-7" >
               <div class="barra-titulo">Instituto Federal da Bahia</div>
               <div class="barra-sub-titu">Campus Eunápolis</div>
            </div>
            <div class="col-md-3" style="text-align: right; padding-top: 40px;">
              <b>Anderson Franciel de Castro</b>
            </div>
            <div class="col-md-1" style="padding-top:25px">
              <div class="dropdown">
                  <button class="btn dropdown-toggle"  id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="false"></span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu3">
                     <li><a href="#">Meus dados</a></li>
                     <li><a href="#">Trocar senha</a></li>
                     <li><a href="/protocolo/php/sair.php">Sair</a></li>
                  </ul>
               </div>
            </div>
         </div><!--row-->
         <div class="row barra-inferior">
            <div class="col-md-11">Remessa Eletrônica de Documentos Institucionais</div>
         </div>
      </div><!--container-->
   </div><!--nav bar-->
   <!--ALERTA DE DADOS INVÁIDOS-->
	<div class="alert alert-danger row" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span>Email ou senha inválido, tente novamente!
	</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
   <div class="container" >
      <div class="content col-lg-8 col-md-offset-2">
         
         <div class="panel" style="box-shadow: 0 1px 1px 0 rgba(0,0,0,0.06), 0 2px 5px 0 rgba(0,0,0,0.2); margin-top: 5%">
            <div class="panel-body">
               <div class="well well-lg">
                  <div class="row">
                     <!-- PESQUISSAR USUÁRIO-->
                     <div class="col-md-12">
                        <form class="form-inline" method="POST" action="home.php">
                           <fieldset>
                               <div class="form-group">
                                    <label for="campo" class="control-label">Buscar </label>
                                    <select class="form-control" id="campo" name="campo" >
                                       <option value="nome">Nome</option>
                                       <option value="cpf">CPF</option>
                                       <option value="email">Email</option>    
                                    </select>
                                    <input type="text" class="form-control" name="termo" id="buscar">
                                    <input type="submit" class="form-control" name="Enviar">
                               </div>
                           </fieldset>
                        </form>
                     </div>
                  </div>
               </div><!--well pesquisa-->

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
               <form name="form_new_user" method="POST" action="/protocolo/php/novo_usuario.php">
                  <div class="well well-lg">
                     <!-- NOME E SOBRENOME -->
                     <label for="nome" class="control-label">Nome:</label>
                     <div class="row">
                        <div class="col-lg-6">
                           <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                        </div>
                        <div class="col-lg-6">
                           <input type="text" name="sobrenome" class="form-control" placeholder="Sobrenome" required>
                        </div>
                     </div>
                      <!-- EMAIL E CPF -->
                     <div class="row" style="margin-top: 20px;">
                        <div class="col-lg-6">
                           <label for="email" class="control-label">Email:</label>
                           <input type="text" name="email" class="form-control" required>
                        </div>
                        <div class="col-lg-6">
                           <label for="cpf" class="control-label">CPF:</label>
                           <input type="text" id="cpf" name="cpf" class="form-control" required>
                        </div>
                     </div>
                      <!-- DATA NASCIMENTO E PERFIL DE USUARIO -->
                     <div class="row" style="margin-top: 20px;">
                         <div class="col-lg-6">
                           <label for="data_nasc" class="control-label">Data Nascimento:</label>
                           <input type="text" name="dataNasc" class="form-control" placeholder="DD/MM/AAAA" required>
                        </div>
                        <div class="col-lg-6">
                           <label for="perfil" class="control-label">perfil:</label>
                           <select class="form-control" id="perfil" name="perfil" required>
                              <option value="" noSelected></option>
                              <option value="1">Administrador</option>
                              <option value="2">Usuario</option>
                           </select>
                        </div>
                     </div>
                     <!-- TELEFONE E SEXO-->
                     <div class="row" style="margin-top: 20px;">
                         <div class="col-lg-6">
                           <label for="telefone" class="control-label">Telefone</label>
                           <input type="text" name="telefone" class="form-control" required>
                        </div>
                        <div class="col-lg-6">
                           <label for="sexo" class="control-label">Sexo:</label>
                           <select class="form-control" id="sexo" name="sexo" required>
                              <option value="" noSelected></option>
                              <option value="M">Masculino</option>
                              <option value="F">Feminino</option>
                              <option value="O">Outro</option>
                           </select>
                        </div>
                     </div>                            
                  </div><!-- well -->
                  <!-- VOLTAR E SALVAR  -->
                  <div class="row" style="margin-top: 20px;">
                     <div class="col-lg-6">
                        <a href="../home.php"  class="btn btn-default btn-block">Voltar</a>
                     </div>

                     <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                     </div>
                  </div>
               </form> 
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
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
</script>
</html>