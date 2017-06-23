<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf8">
    </head>
    <body>
		<div style='width: 80%; margin-top: 3%'>
			<hr>
			<table>
				<tbody>
					<tr>
						<td><h4>Código de Envio:</h4></td>
						<td style='color:#3b5998;'><h4><?php echo $codigo_envio;?></h4></td>
					</tr>
				</tbody>
			</table>

			<p>
				<a href='http://localhost/protocolo/views/form_receber.php?codigo=<?php echo $codigo_envio;?>'>
					<h4>Click aqui para ter acesso aos documentos em anexo</h4>
				</a>
			</p>

			<table border='1' width='100%'>
				<thead>
					<th>ANEXOS</th>
				</thead>
				<tbody>
					<?php foreach ($documentos as  $value) { ?> 
				    	<tr><td><b><?php echo $value; ?></b></td></tr>
					<?php } ?>
				</tbody>
			</table>

			<p align='justify'>
			   	Acesse e preencha o formulário para baixar os documentos em anexo.<br>
			   	Caso tenha dificuldade para acessar a pagina do formulário copie o URL abaixo e cole 
			    na barra de endereço do navegador ou entre em contato  com o  IFBA  Campus Eunápolis.
			</p>

			<p>	URL: localhost/Sendark/form_receber.php?codigo=<?php echo $codigo_envio;?> </p>
		</div>

		<a href='http://portal.ifba.edu.br/eunapolis'>
			<img src='https://scontent-gru2-2.xx.fbcdn.net/v/t1.0-9/17457839_1174545449337568_6460502873829503647_n.jpg?oh=774f883eefd69980f2d3ffbe5de2c3f1&oe=596261B2'/>
		</a>
    </body>
</html>