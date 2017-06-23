<?php 
   session_start();
   if (!isset($_SESSION["email"]) || !isset($_SESSION["senha"])) {
      header("location:../index.php");
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
    <!-- Funções para validação de CPF e CNPJ -->
    <script src="../js/valida_cpf_cnpj.js"></script>
</head>
<body>
	<div class="container">
		<div class="content col-lg-8 col-md-offset-2">
         <div class="panel panel-success">
             
            <div class="panel-heading">
               <div class="row titulo">
                  <h2>Protocolo Eletrônico</h2>
                  <h5>Preencha este formulário para baixar os documentos em anexo</h5>
               </div>
            </div>

            <div class="panel-body">
               <form action="../php/mail_receive.php" method="POST">

                  <div class="well well-lg">
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                		<div class="row margem">
                       <p><i>Preencha com o código de envio recebio por email e CNPJ da Empresa ou CPF do Resposável</i></p>
                     </div>
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="row">
             				<div class="col-lg-6">
                           <?php 
                              $codigoEnvio = ""; 
                              $codigoEnvio = isset($_GET['codigo']) ? $_GET['codigo'] : '';
                            ?>
             				   <label> Código de Envio</label>*
                 			   <input class="form-control" type="text"  name="codigo" required  value="<?php echo $codigoEnvio; ?>">
             				</div>
             				<div class="col-lg-6">
                    			<label> CNPJ / CPF</label>* <i>apenas números</i> 
                    			<input class="form-control" type="text" name="cpf_cnpj" required id="cpf_cnpj">
                 			</div>
                		</div>
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                  </div>
                  
                  <div class="well well-lg">
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="row titulo">
                        <h3><b>Dados do Responsável pelo Recebimento</b></h3>
                     </div>
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                     <label>Nome Completo</label>*
                     <input class="form-control" type="text" required name="nome">
    
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
             			<div class="row">
             				<div class="col-lg-6">
             					<label>Cargo ou Função</label>
             					<input class="form-control" type="text" name="cargo">
             				</div>
             				<div class="col-lg-6">
             					<label>Telefone</label>* <i>apenas números</i>
             					<input id="fone" class="form-control" type="text" required  name="telefone" >
             				</div>
             			</div>
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
             			
                     <label>E-mail</label>*
             			<input class="form-control" type="text" required  name="email">
                  </div>

                  <p> Os campos com (*) são de preenchimento obrigatório</p>
                  <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                  <div class="row">
                     <div class="col-lg-8 col-md-offset-2">
                        <button type="submit" class="btn btn-primary btn-block">Receber Arquivo</button>
                     </div>
                  </div>
                  <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
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