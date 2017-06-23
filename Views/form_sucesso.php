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
</head>
<body>
	<div class="container">
		<div class="content col-lg-8 col-md-offset-2">
			<!-- ~~~~~~~~~~~~~~~~~Cabeçalho~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<div class="row texto-centro" id="sucesso-header">
				<span id="sucesso-icon" class="glyphicon glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
				<h1> Email enviado com sucesso</h1>
			</div>
			<!-- ~~~~~~~~~~~~~~~~~~Corpo ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<div class="row" id="sucesso-body">
				<div class="col-lg-12 margem">
					<p>Sua mensagem e anexos foram enviados com sucesso para o email <?php echo $_SESSION['email']; ?></p>
				</div>
				<div class="col-lg-8 col-md-offset-2 margem texto-centro" id="sucesso-cod-env">
					<h4>Código de envio nº <?php echo $_SESSION['codigo'];  ?></h4>
				</div>
				<div class="col-lg-4 col-md-offset-4 margem ">
					<a class="btn btn-success btn-block" href="home.php">ok</a>
				</div>
			</div>
		</div>
	</div>
</body>
<!-- Latest compiled and minified JavaScript --> 	
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
