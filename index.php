<?php
	session_start(); // Inicia a sessão
	if (!isset($_SESSION['error'])) {
		$_SESSION['error'] = false;
      $_SESSION['email'] = "";
	}
 ?>
<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="UTF-8">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <link rel="stylesheet" type="text/css" href="css/styles.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
       integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   </head>   
   <body class="corpo">
      <div class="nav barra">
         <div class="container-fluid">
            <div class="row barra-padding">
               <div class="col-md-1" id="padding-zero">
                  <div><a href="https://portal.ifba.edu.br/eunapolis"><img src="img/logo-clara.png" width="60" height="70" align="right"  ></a></div>
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
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <div class="panel col-lg-4 col-md-offset-4" style="margin-top: 5%; padding: 60px">
      <!-- ALERTA DE ERRO DE LOGIN -->
      	<?php if ($_SESSION['error']) { ?>
   		<div class="alert alert-danger row" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<span class="sr-only">Error:</span>Email ou senha inválido, tente novamente!
			</div>
      	<?php } ?>
	      <!-- FORMULÁRIO DE LOGIN-->
         <form name="form_login" method="POST" action="php/autenticador.php">
            <div class="row">
               <label>Email:</label>
               <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['email']; ?>">
            </div>

             <div class="row" style="margin-top: 20px;">
               <label>Senha:</label>
               <input type="password" name="senha" class="form-control">
            </div>

            <div class="row" style="margin-top: 20px;">
               <button type="submit" class="btn btn-primary btn-block"> Entrar</button>
            </div>

            <div class="row" style="margin-top: 20px;">
               <center><a href="#">Esqueceu a Senha?</a></center>
            </div>
         </form> 
      </div> <!-- fim do panel-->   
   </body>
<?php
	// Remove as variáveis de erro e email da sessão 
	unset($_SESSION['error']);
	unset($_SESSION['email']);
?>
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
      integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
   </script>
</html>