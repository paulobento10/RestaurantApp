<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="login">
	<title>web page of &ndash; Pedro Costa and Paulo Bento &ndash; Pure</title>


	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title></title>

</head>

<style></style>

<body>
	<div class="header">
		<div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
			<a class="pure-menu-heading" href="">Bem-vindo! Ponto de ementa </a>
		</div>
	</div>
	<div class="content">
		<div class="pure-g">
			<div class="l-box-lrg pure-u-2 pure-u-md-2-5">
				<form class="pure-form pure-form-stacked" method="POST">
					<fieldset>
						<label for="produto" style="margin-top: 20px" required >Ementa:</label>
						<input name="produto" type="text" class="pure-input-rounded" placeholder="Insira o produto/prato" required  >
						<select name="tipo">
							<option value="">Tipo:</option>
							<option value="entradas">entradas</option>
							<option value="bebidas">Bebidas</option>
							<option value="prato_principal">Prato principal</option>
							<option value="sobremesas">sobremesas</option>
							<option value="Prato do dia">Prato do dia</option>
							<option value="Especial">Especial</option>
						</select>
						<input name="preco" type="float" class="pure-input-rounded" placeholder="Insira as preco" required >
						<input name="extras" type="text" class="pure-input-rounded" placeholder="Insira extras" >
					</fieldset>

					<button type="submit" name="add" class="pure-button pure-button-primary">Registar</button>
					<?php

					if(isset($_POST['add'])){

						$produto=$_POST['produto'];
						$tipo=$_POST['tipo'];
						$preco=$_POST['preco'];
						$extras=$_POST['extras'];

						$data=array(
							"produto" => $produto,
							"tipo" => $tipo,
							"preco" => $preco,
							"extras" => $extras
						);

						$data=json_encode($data);
						$curl=curl_init("http://engpro.dev/new/ementa");
						curl_setopt($curl, CURLOPT_POST,1);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
						$response=curl_exec($curl);
						if(strcmp($response,"ok")==0){
							echo $response;
							header("Location: restaurante_hub.php");
						}
						echo $response;
						echo '<div id="erro" class="error">Algo correu mal !</div>';
					}
					?>
				</form>
			</div>
		</div>
	</div>
	<div class="footer">
		© 2017! Engenharia Software Pedro Costa Nº: 31179 & Paulo Bento Nº:33959 .
	</div>
</div>
</body>
</html>
