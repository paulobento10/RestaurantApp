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
			<a class="pure-menu-heading" href="">Bem-vindo! faça o seu registo </a>
		</div>
	</div>
	<div class="content">
		<div class="pure-g">
			<div class="l-box-lrg pure-u-2 pure-u-md-2-5">
				<form class="pure-form pure-form-stacked" action="register.php" method="POST">
					<fieldset>
						<label for="username" style="margin-top: 20px" >Registar:</label>

						<input name="nome" type="text" class="pure-input-rounded" placeholder="nome" <?php echo isset($_POST['nome']) ? "value='".$_POST['nome']."'":""; ?> required >

						<input name="username" type="text" class="pure-input-rounded" placeholder="username" <?php echo isset($_POST['username']) ? "value='".$_POST['username']."'":""; ?> required >

						<input name="password" type="password" class="pure-input-rounded" placeholder="Password" required>
						<input name="email" type="text" class="pure-input-rounded" placeholder="email" <?php echo isset($_POST['email']) ? "value='".$_POST['email']."'":""; ?> required >
						<input name="telemovel" type="text" class="pure-input-rounded" placeholder="telemovel" <?php echo isset($_POST['telemovel']) ? "value='".$_POST['telemovel']."'":""; ?> required >
					</fieldset>

					<button type="submit" name="registo" class="pure-button pure-button-primary">Registar</button>

					<?php
					if(isset($_POST['registo'])){
						$telemovel=$_POST['telemovel'];
						if(sizeof($telemovel)==9)
						{
							$nome=$_POST['nome'];
							$username=$_POST['username'];
							$password=password_hash($_POST['password'], PASSWORD_DEFAULT);
							$email=$_POST['email'];



							$data=array(
								"nome" => $nome,
								"username" => $username,
								"password" => $password,
								"email" => $email,
								"telemovel"=> $telemovel
							);
							$data=json_encode($data);
							$curl=curl_init("http://engprows.dev/user");
							curl_setopt($curl, CURLOPT_POST,1);
							curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
							$response=curl_exec($curl);
							if(strcmp($response,"Ok")==0)
							{
								header("Location: login.php");
							}
						}
						echo '<div class="error">Algo está errado!</div>';
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
