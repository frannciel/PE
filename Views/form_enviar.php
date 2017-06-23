<?php 
   session_start();
   if (!isset($_SESSION["email"]) || !isset($_SESSION["senha"])) {
      header("location:../index.php");
   }
?>
<!DOCTYPE html>
<html>
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
                  <h5>Preencha para enviar email encaminhando documentos anexos ao destinatário</h5>
               </div>
            </div>

            <div class="panel-body">
               <form action="../php/mail_send.php" method="POST">
                  
                  <div class="well well-lg">
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="row">
                        <div class="col-lg-10">
                           <label> Nome do Destinatário</label>*
                           <input type="text" required class="form-control"  name="nome">
                        </div>
                     </div>
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="row">
                        <div class="col-lg-5">
                           <label> CPF/CNPJ</label>* <i>apenas números</i>
                           <input type="text" required id="cpf_cnpj" class="form-control"  name="cpf_cnpj">
                        </div>
                     </div>                  
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="row">
                        <div class="col-lg-10">
                           <label> E-mail do Destinatário</label>*
                           <input type="text" required id="email_destino" class="form-control"  name="email">
                        </div>
                     </div>
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="row">
                        <div class="col-lg-10">
                           <label> Assunto</label>*
                           <input type="text" required class="form-control"  name="assunto">
                        </div>    
                     </div>
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="row">
                        <div class="col-lg-12">
                           <label > Mensagem</label>*
                           <textarea rows="10" cols="50" class="form-control" name="mensagem"></textarea>
                        </div>
                     </div>
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                  </div>

                  <div class="well well-lg">
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="row" >
                        <div class="col-lg-6" align="center">
                           <label>Documento</label>*
                        </div>
                        <div class="col-lg-5" align="center">
                           <label>Link do Anexo</label>
                        </div>
                     </div>
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                     <div class="row">
                        <div id="anexos">
                           <div class="col-lg-6">
                              <input  type="text" required class=" form-control" name="documento[]" placeholder="Ex: Ofício 001/2017">
                           </div>
                           <div class="col-lg-5">
                              <input class="form-control" type="text" required name="link[]">
                           </div>
                        </div>
                        <div class="col-lg-1">
                          <button id="AddDoc" type="button" class="btn btn-default" title="Adicionar opção" >
                            <span class="glyphicon glyphicon-plus-sign"></span>
                          </button>
                        </div>
                     </div>
                     <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                  </div>

                  <p> Os campos com (*) são de preenchimento obrigatório</p>
                  <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
         			<div class="row">
                     <div class="col-lg-8 col-md-offset-2">
                        <button type="submit" class="btn btn-primary btn-block"> Enviar E-mail</button>
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
            if (valida_cpf_cnpj(cpf_cnpj )) 
            {
                $(this).val(formata_cpf_cnpj(cpf_cnpj));
            } else {
                alert('CPF ou CNPJ inválido!');
            }
          }
	    });
	    $('#fone').blur(function(){
	    	
	    	var dados = $(this).val();
	    	var fone = formatar_fone(dados)
	    	if (fone === false) {
	    		 alert('Telefone invalido');
	    	}else{
	    		$(this).val(fone);
	    	}
	     	
	    });
     $('#AddDoc').click(function(){
      $('#anexos').append(
          "<div class='col-lg-6'>"+      
            "<input  type='text' required class='form-control' name='documento[]' placeholder='Ex: Ofício 001/2017'>"+
          "</div>"+
          "<div class='col-lg-5'>"+
            "<input class='form-control' type='text' name='link[]'>"+
          "</div>"
        );
      });
	}); 
</script>
</html>