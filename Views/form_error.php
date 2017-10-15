<?php 
   session_start();
   if (!isset($_SESSION["email"]) || !isset($_SESSION["senha"])) {
      header("location:../index.php");
   }
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
        <meta charset="utf8">
        <title>Erro</title>
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   </head>
   <body class="corpo">
      <div class="nav barra">
         <div class="container-fluid">
            <div class="row barra-padding">
               <div class="col-md-1" id="padding-zero">
                  <div><a href="#"><img src="../img/logo-clara.png" width="60" height="70" align="right"  ></a></div>
               </div>
               <div class="col-md-9" >
                  <div class="barra-titulo">Instituto Federal da Bahia</div>
                  <div class="barra-sub-titu">Campus Eunápolis</div>
               </div>
               <div class="col-md-2">
                  <img  src="../img/usuario.png" class="img-circle " width="70" height="70" align="right">
               </div>
            </div>
            <div class="row barra-inferior">
               <div class="col-md-11">Remessa Eletrônica de Documentos Institucionais</div>
            </div>
         </div>
      </div>
      
      <h1>Erro</h1>
        
      <hr>
        
      <p>Houve um erro no envio do e-mail. <a href="../views/home.php">Tentar novamente</a>.</p>
   </body>
</html>