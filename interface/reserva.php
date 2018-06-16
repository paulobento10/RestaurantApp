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
				<form class="pure-form pure-form-stacked" action="reserva.php" method="POST">
					<fieldset>
						<label for="username" style="margin-top: 20px" >Registar:</label>

						<input name="nome_utilizador" type="text" class="pure-input-rounded" placeholder="nome_utilizador" <?php echo isset($_POST['nome_utilizador']) ? "value='".$_POST['nome_utilizador']."'":""; ?> required >

						<input name="email_utilizador" type="text" class="pure-input-rounded" placeholder="email_utilizador" <?php echo isset($_POST['email_utilizador']) ? "value='".$_POST['email_utilizador']."'":""; ?> required >

						<input name="telemovel_utilizador" type="text" class="pure-input-rounded" placeholder="telemovel_utilizador" <?php echo isset($_POST['telemovel_utilizador']) ? "value='".$_POST['telemovel_utilizador']."'":""; ?> required >
					</fieldset>

					<button type="submit" name="registo" class="pure-button pure-button-primary">Registar</button>
					<button type="submit" name="editar" class="pure-button pure-button-primary">Editar</button>
					<button type="submit" name="remove" class="pure-button pure-button-primary">Remover</button>

					<?php
					if(isset($_POST['registo'])){
						$nome_utilizador=$_POST['nome_utilizador'];
						$email_utilizador=$_POST['email_utilizador'];
						$telemovel_utilizador=$_POST['telemovel_utilizador'];

						$data=array(
							"nome_utilizador" => $nome_utilizador,
							"email_utilizador" => $email_utilizador,
							"telemovel_utilizador" => $telemovel_utilizador
						);
						$data=json_encode($data);
						$curl=curl_init("http://engprows.dev/new/reserva");
						curl_setopt($curl, CURLOPT_POST,1);
						curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
						$response=curl_exec($curl);

						if(!$response){
							echo "<div> Error </div>";
						}
						echo "Reserva adicionada";

						//header("Location: login.php");
					}

					if(isset($_POST['editar'])){
						$nome_utilizador=$_POST['nome_utilizador'];
						$email_utilizador=$_POST['email_utilizador'];
						$telemovel_utilizador=$_POST['telemovel_utilizador'];


						//para o pdf
						//$_SESSION['username']=$username;
						//$_SESSION['email']=$email;

						$data=array(
							"nome_utilizador" => $nome_utilizador,
							"email_utilizador" => $email_utilizador,
							"telemovel_utilizador" => $telemovel_utilizador
						);
						$data=json_encode($data);
						$curl=curl_init("http://engprows.dev/reserva/edit/".$id);
						curl_setopt($curl, CURLOPT_POST,'PUT');
						curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
						$response=curl_exec($curl);

						if(!$response){
							echo "<div> Error </div>";
						}
						echo "Reserva Editada";

						//header("Location: login.php");
					}

					if(isset($_POST['remove'])){
						$nome_utilizador=$_POST['nome_utilizador'];
						$email_utilizador=$_POST['email_utilizador'];
						$telemovel_utilizador=$_POST['telemovel_utilizador'];


						//para o pdf
						//$_SESSION['username']=$username;
						//$_SESSION['email']=$email;

						$data=array(
							"nome_utilizador" => $nome_utilizador,
							"email_utilizador" => $email_utilizador,
							"telemovel_utilizador" => $telemovel_utilizador
						);
						$data=json_encode($data);
						$curl=curl_init("http://engprows.dev/reserva/del/".$id);
						curl_setopt($curl, CURLOPT_POST,'DELETE');
						curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
						$response=curl_exec($curl);

						if(!$response){
							echo "<div> Error </div>";
						}
						echo "Reserva removida";

						//header("Location: login.php");
					}

					?>
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
