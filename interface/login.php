<?php
session_start();
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
			<a class="pure-menu-heading" href="">Bem-vindo ao Login </a>
		</div>
	</div>
	<div class="content">
		<div class="pure-g">
			<div class="l-box-lrg pure-u-2 pure-u-md-2-5">
				<form class="pure-form pure-form-stacked" action="login.php" method="POST">
					<fieldset>
						<label for="username" style="margin-top: 20px" >Login:</label>

						<input name="username" type="text" class="pure-input-rounded" placeholder="Numero de indentificação" <?php echo isset($_POST['username']) ? "value='".$_POST['username']."'":""; ?> required >

						<input name="password" type="password" class="pure-input-rounded" placeholder="palavra-passe" required >
					</fieldset>

					<button type="submit" name="login" class="pure-button pure-button-primary">Login</button>

					<?php
					if(isset($_POST['login'])){

						$N_id=$_POST['username'];
						$password=$_POST['password'];


						$data=array(
							"N_id" => $N_id,
							"password" => $password,
						);
						$data=json_encode($data);
						$curl=curl_init("http://engpro.dev/login");
						curl_setopt($curl, CURLOPT_POST,1);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
						$response=curl_exec($curl);
						if(strcmp($response,"Ok")==0){
							$_SESSION['N_id']=$N_id;
							header("Location: restaurante_hub.php");
						}
						echo '<div id="erro" class="error">Algo correu mal !</div>';
					}
					?>
				</form>
				<a href="registar_dono.php" class="pure-button"> Registar </a>
			</div>
		</div>
	</div>
	<div class="footer">
		© 2017! Engenharia Software Pedro Costa Nº: 31179 & Paulo Bento Nº:33959 .
	</div>
</div>
</body>
</html>
