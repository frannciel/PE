<?php 
   session_start();
   if (!isset($_SESSION["anexos"])) {
      header("location:form_receber.php");
   }
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

	<div class="container">
		<div class="content col-lg-6 col-md-offset-3">
         
         <div class="panel panel-margim">
            <div class="row titulo">
               <h5>Click para acessar os documentos</h5>
            </div>
            <div class="panel-body">
               <div class="well well-lg">
               <table class="table ">
                  <tr>
                     <th class="titulo">ANEXOS DO EMAIL</th>
                  </tr>
                  <?php 
                     $anexos = $_SESSION["anexos"];
                     foreach ($anexos as  $anexo) {
                  ?>
                     <tr>
                        <td><a href="<?php echo $anexo->link;?>" target="_blank"><?php echo $anexo->documento; ?></a></td>
                     </tr>
                  <?php } ?>
               </table>
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