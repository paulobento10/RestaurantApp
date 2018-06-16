<?php
session_start();
if(!isset($_SESSION['N_id']))
{
	header('location: login.php');
}
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
			<a class="pure-menu-heading" href="">Bem-vindo! faça o seu registo </a>
		</div>
	</div>
	<div class="content">
		<div class="pure-g">
			<div class="l-box-lrg pure-u-2 pure-u-md-2-5">
				<form class="pure-form pure-form-stacked" enctype="multipart/form-data" action="register_restaurante.php" method="POST">
					<fieldset>
						<label for="nome" style="margin-top: 20px" >Registar restaurante:</label>

						<input name="nome" type="text" class="pure-input-rounded" placeholder="nome do restaurante" <?php echo isset($_POST['nome']) ? "value='".$_POST['nome']."'":""; ?> required >

						<input name="morada" type="text" class="pure-input-rounded" placeholder="morada do restaurante" <?php echo isset($_POST['morada']) ? "value='".$_POST['morada']."'":""; ?> required >

						<input name="localidade" type="text" class="pure-input-rounded" placeholder="Localidade do restaurante" <?php echo isset($_POST['localidade']) ? "value='".$_POST['localidade']."'":""; ?> required >

						<input name="imagem1" type="file" class="pure-input-rounded" placeholder="Imagem do restaurante">

						<select name="takeaway" class="pure-input-1-2" required>
							<option value="">Tem takeaway:</option>
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</select>

						<input name="tipo" type="text" class="pure-input-rounded" placeholder="tipo de restaurante" <?php echo isset($_POST['tipo']) ? "value='".$_POST['tipo']."'":""; ?> required >

						<input name="tipocomida" type="text" class="pure-input-rounded" placeholder="separe por vigulas EX: pizas,massas" <?php echo isset($_POST['tipocomida']) ? "value='".$_POST['tipocomida']."'":""; ?> required >

						<select name="pequeno_almoco" class="pure-input-1-2" required>
							<option value="">Serve pequeno almoço:</option>
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</select>

						<select name="brunch" class="pure-input-1-2" required>
							<option value="">Serve Brunch:</option>
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</select>

						<input name="link_pagina" type="text" class="pure-input-rounded" placeholder="link para a página" <?php echo isset($_POST['link_pagina']) ? "value='".$_POST['link_pagina']."'":""; ?> required >

						<input name="telemovel" type="text" class="pure-input-rounded" placeholder="telemovel" <?php echo isset($_POST['telemovel']) ? "value='".$_POST['telemovel']."'":""; ?> required >

						<input name="email" type="text" class="pure-input-rounded" placeholder="email" <?php echo isset($_POST['email']) ? "value='".$_POST['email']."'":""; ?> required >

						<input name="preco_medio" type="text" class="pure-input-rounded" placeholder="preco medio por pessoa" <?php echo isset($_POST['preco_medio']) ? "value='".$_POST['preco_medio']."'":""; ?> required >

						<input name="descricao" type="text" class="pure-input-rounded" placeholder="descrição" <?php echo isset($_POST['descricao']) ? "value='".$_POST['descricao']."'":""; ?> required >

						<input name="tags" type="text" class="pure-input-rounded" placeholder="tags , separe por virgulas" <?php echo isset($_POST['tags']) ? "value='".$_POST['tags']."'":""; ?> required >

						<input name="capacidade" type="text" class="pure-input-rounded" placeholder="capacidade do restaurante" <?php echo isset($_POST['capacidade']) ? "value='".$_POST['capacidade']."'":""; ?> required >

						<label for="dinheiro" style="margin-top: 20px" >Metodos de pagamento:</label>
						<select name="dinheiro" class="pure-input-1-2" required>
							<option value="">Aceita dinheiro:</option>
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</select>
						<select name="multibanco" class="pure-input-1-2" required>
							<option value="">Aceita Multibanco :</option>
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</select>
						<select name="cheque" class="pure-input-1-2" required>
							<option value="">Aceita cheques :</option>
							<option value="1">Sim</option>
							<option value="0">Não</option>
						</select>

						<label for="segunda" style="margin-top: 20px" >Horario do restaurante:</label>
						<label for="segunda" style="margin-top: 20px" >Segunda-feira:</label>
						<input name="segunda" type="time" class="pure-input-rounded" placeholder="EX: 11:00-15:00 ate 19:00-01:00" <?php echo isset($_POST['segunda']) ? "value='".$_POST['segunda']."'":""; ?> required >
						<input name="segunda2" type="time" class="pure-input-rounded" placeholder="EX: 11:00-15:00 ate 19:00-01:00" <?php echo isset($_POST['segunda2']) ? "value='".$_POST['segunda2']."'":""; ?> required >

						<label for="terca" style="margin-top: 20px" >terça-feira:</label>
						<input name="terca" type="time" class="pure-input-rounded"  <?php echo isset($_POST['terca']) ? "value='".$_POST['terca']."'":""; ?> required >
						<input name="terca2" type="time" class="pure-input-rounded"  <?php echo isset($_POST['terca2']) ? "value='".$_POST['terca2']."'":""; ?> required >

						<label for="quarta" style="margin-top: 20px" >Quarta-feira:</label>
						<input name="quarta" type="time" class="pure-input-rounded" <?php echo isset($_POST['quarta']) ? "value='".$_POST['quarta']."'":""; ?> required >
						<input name="quarta2" type="time" class="pure-input-rounded" <?php echo isset($_POST['quarta2']) ? "value='".$_POST['quarta2']."'":""; ?> required >

						<label for="quinta" style="margin-top: 20px" >Quinta-feira:</label>
						<input name="quinta" type="time" class="pure-input-rounded"  <?php echo isset($_POST['quinta']) ? "value='".$_POST['quinta']."'":""; ?> required >
						<input name="quinta2" type="time" class="pure-input-rounded"  <?php echo isset($_POST['quinta2']) ? "value='".$_POST['quinta2']."'":""; ?> required >

						<label for="sexta" style="margin-top: 20px" >Sexta-feira:</label>
						<input name="sexta" type="time" class="pure-input-rounded"	<?php echo isset($_POST['sexta']) ? "value='".$_POST['sexta']."'":""; ?> required >
						<input name="sexta2" type="time" class="pure-input-rounded"	<?php echo isset($_POST['sexta2']) ? "value='".$_POST['sexta2']."'":""; ?> required >

						<label for="sabado" style="margin-top: 20px" >Sabado:</label>
						<input name="sabado" type="time" class="pure-input-rounded" <?php echo isset($_POST['sabado']) ? "value='".$_POST['sabado']."'":""; ?> required >
						<input name="sabado2" type="time" class="pure-input-rounded" <?php echo isset($_POST['sabado2']) ? "value='".$_POST['sabado2']."'":""; ?> required >

						<label for="domingo" style="margin-top: 20px" >Domingo:</label>
						<input name="domingo" type="time" class="pure-input-rounded"  <?php echo isset($_POST['domingo']) ? "value='".$_POST['domingo']."'":""; ?> required >
						<input name="domingo2" type="time" class="pure-input-rounded"  <?php echo isset($_POST['domingo2']) ? "value='".$_POST['domingo2']."'":""; ?> required >

						<label for="feriados" style="margin-top: 20px" >Feriados:</label>
						<input name="feriados" type="text" class="pure-input-rounded"  <?php echo isset($_POST['feriados']) ? "value='".$_POST['feriados']."'":""; ?> required >

					</fieldset>

					<button type="submit" name="registo" class="pure-button pure-button-primary">Registar</button>

					<?php
					if(isset($_POST['registo'])){

						$horario=array(
							"segunda" => $_POST['segunda']." ".$_POST['segunda2'],
							"terca" => $_POST['terca']." ".$_POST['terca2'],
							"quarta" => $_POST['quarta']." ".$_POST['quarta2'],
							"quinta" => $_POST['quinta']." ".$_POST['quinta2'],
							"sexta" => $_POST['sexta']." ".$_POST['sexta2'],
							"sabado" => $_POST['sabado']." ".$_POST['sabado2'],
							"domingo" => $_POST['domingo']." ".$_POST['domingo2'],
							"feriados" => $_POST['feriados']
						);


						$nome=$_POST['nome'];
						$morada=$_POST['morada'];
						$localidade=$_POST['localidade'];
						$takeaway=$_POST['takeaway'];
						$tipo=$_POST['tipo'];
						$tipocomida=$_POST['tipocomida'];
						$tags=$_POST['tags'];
						$pequeno_almoco=$_POST['pequeno_almoco'];
						$brunch=$_POST['brunch'];
						$link_pagina=$_POST['link_pagina'];
						$telemovel=$_POST['telemovel'];
						$email=$_POST['email'];
						$preco_medio=$_POST['preco_medio'];
						$descricao=$_POST['descricao'];

						$target_dir = __DIR__."/"."img_rest/";
						$target_file_tmp1 = $target_dir. basename($_FILES["imagem1"]["name"]);
						$info=pathinfo($target_file_tmp1);
						$image=$target_file_tmp1;

						$horario=json_encode($horario);
						$curl=curl_init("http://engpro.dev/new/horario");
						curl_setopt($curl, CURLOPT_POST,1);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($curl, CURLOPT_POSTFIELDS,$horario);
						curl_exec($curl);


						$data=array(
							"nome" => $nome,
							"morada" => $morada,
							"localidade"=> $localidade,
							"img1" => $image,
							"takeaway" => $takeaway,
							"tipo" => $tipo,
							"tipocomida" => $tipocomida,
							"tags" => $tags,
							"pequeno_almoco" => $pequeno_almoco,
							"brunch" => $brunch,
							"link_pagina" => $link_pagina,
							"telemovel" => $telemovel,
							"email" => $email,
							"preco_medio" => $preco_medio,
							"descricao" => $descricao,
							"capacidade" => $_POST['capacidade'],
							"dinheiro" => $_POST['dinheiro'],
							"cheque" => $_POST['cheque'],
							"multibanco" => $_POST['multibanco']
						);
						$data=json_encode($data);
						$curl=curl_init("http://engpro.dev/new/restaurante");
						curl_setopt($curl, CURLOPT_POST,1);
						curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
						$response=curl_exec($curl);
						if(strcmp($response,"Ok")==0)
						{
							header("Location: restaurante_hub.php");
						}
						echo '<div id="erro" class="error">Algo correu mal !</div>';

					}

					?>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="footer">
	© 2017! Projecto Laboratório Pedro Costa Nº: 31179 & Paulo Bento Nº:33959 .
</div>
</div>
</body>
</html>
