<?php
session_start();

$id=$_GET['id'];

$res=file_get_contents("http://engpro.dev/obtain/pagamento");
$res=json_decode($res);


?>
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
			<a class="pure-menu-heading" href="">Bem-vindo! faça a sua edicao </a>
			<li class="pure-menu-item"><a href="restaurante_hub.php" class="pure-button"> Back </a></li>
		</div>
	</div>
	<div class="content">
		<div class="pure-g">
			<div class="l-box-lrg pure-u-2 pure-u-md-2-5">
				<form class="pure-form pure-form-stacked" method="POST">
					<fieldset>
						<label for="dinheiro" style="margin-top: 20px" >Metodos de pagamento:</label>
						<select name="dinheiro" class="pure-input-1-2" required>
							<option value=<?php echo $res[0]->dinheiro?>>Aceita dinheiro:</option>
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</select>
						<select name="multibanco" class="pure-input-1-2" required>
							<option value=<?php echo $res[0]->multibanco?>>Aceita Multibanco :</option>
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</select>
						<select name="cheque" class="pure-input-1-2" required>
							<option value=<?php echo $res[0]->cheque?>>Aceita cheques :</option>
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</select>
					</fieldset>

					<button type="submit" name="registo" class="pure-button pure-button-primary">Editar</button>

					<?php
					if(isset($_POST['registo'])){
						$dinheiro=$_POST['dinheiro'];
						$multibanco=$_POST['multibanco'];
						$cheque=$_POST['cheque'];

						$data=array(
							"dinheiro" => $dinheiro,
							"multibanco" => $multibanco,
							"cheque" => $cheque
						);
						$data=json_encode($data);
						$curl=curl_init("http://engpro.dev/edit/pagamento/".$id);
						curl_setopt($curl, CURLOPT_CUSTOMREQUEST,'PUT');
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
						$response=curl_exec($curl);
						if(strcmp($response,"ok")==0){
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
		© 2017! Engenharia Softtware Pedro Costa Nº: 31179 & Paulo Bento Nº:33959 .
	</div>
</div>
</body>
</html>
