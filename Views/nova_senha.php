<?php 
   session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <meta charset="utf-8">
   <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body class="corpo">
   <div class="nav barra">
      <div class="container-fluid">
         <div class="row barra-padding">
            <div class="col-md-1" id="padding-zero">
               <div><a href="https://portal.ifba.edu.br/eunapolis"><img src="../img/logo-clara.png" width="60" height="70" align="right" ></a></div>
            </div>
            <div class="col-md-9" >
               <div class="barra-titulo">Instituto Federal da Bahia</div>
               <div class="barra-sub-titu">Campus Eunápolis</div>
            </div>
         </div>
         <div class="row barra-inferior">
            <div class="col-md-11">Remessa Eletrônica de Documentos Institucionais</div>
         </div>
      </div>
   </div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	<div class="container">
		<div class="content col-lg-6 col-md-offset-3">
         <div class="panel" style="box-shadow: 0 1px 1px 0 rgba(0,0,0,0.06), 0 2px 5px 0 rgba(0,0,0,0.2); margin-top: 5%">
            <div class="panel-body">
               <form name="form_new_user" method="POST" action="/protocolo/php/nova_senha.php">
                  <div class="well well-lg">
                     <!--SENHA ATUAL -->
                     <div class="row" style="margin-top: 20px;">
                        <div class="col-lg-12">
                           <label for="senhaAtual" class="control-label">Senha atual:</label>
                           <input type="password" name="senhaAtual" class="form-control">
                        </div>
                     </div>
                     <!-- NOVA SENHA -->
                     <div class="row" style="margin-top: 20px;">
                        <div class="col-lg-12">
                           <label for="senhaNova" class="control-label">Nova senha:</label>
                           <input type="password" name="senhaNova" class="form-control">
                        </div>
                     </div>
                     <!-- CONFIRMAÇÃO DE SENHA -->
                     <div class="row" style="margin-top: 20px;">
                         <div class="col-lg-12">
                           <label for="senhaConfirma" class="control-label">Confirmar nova senha:</label>
                           <input type="password" name="senhaConfirma" class="form-control">
                        </div>
                     </div>     
                  </div><!-- well -->
                  <!-- VOLTAR E SALVAR  -->
                  <div class="row" style="margin-top: 20px;">
                     <div class="col-lg-6">
                        <a href="home.php"  class="btn btn-default btn-block">Voltar</a>
                     </div>
                     <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                     </div>
                  </div>
               </form> 
            </div>
         </div>
      </div>
	</div>
</body>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
</html>